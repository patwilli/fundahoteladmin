<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Room;
use App\Models\RoomItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;
use LDAP\Result;

class RoomsController extends Controller
{
    public function indexAddRoom()
    {
        return view('add-room');
    }

    public function indexAddRoom1($id)
    {
        $room = Room::find($id);
        return view('add-room', compact('room'));
    }

    public function addRoom(Request $request)
    {
        $validatedData = $request->validate([
            'room_name' => 'required',
            'noofrooms' => 'required',
            'noofbeds' => 'required',
            'price' => 'required',
            'description' => 'required',
            'room_image' => 'required',
        ], [
            'room_name.required' => 'Le nom de la chambre est requis.',
            'noofrooms.required' => 'Le nombre de chambres est requis.',
            'noofbeds.required' => 'Le nombre de lits est requis.',
            'price.required' => 'Le prix est requis.',
            'description.required' => 'La description est requise.',
            'room_image.required' => 'L\'image de la chambre est requise.',
        ]);

        $roomId = Str::uuid();

        $room = new Room();
        $room->id = $roomId;
        $room->room_name = $validatedData['room_name'];
        $room->room_qty = $validatedData['noofrooms'];
        $room->no_of_beds = $validatedData['noofbeds'];
        $room->price = $validatedData['price'];
        $room->description = $validatedData['description'];
        if ($request->visibility == true) {
            $room->status = 1;
        } else {
            $room->status = 0;
        }
        // Enregistrement de l'image
        $image = $request->file('room_image');
        $imageName = $roomId . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);
        $room->room_image = $imageName;

        // Enregistrement du modèle
        $room->save();

        return redirect()->route('all-rooms')->with('success', 'Room added successfully');
    }

    public function editRoom(Request $request)
    {
        $validatedData = $request->validate([
            'room_name' => 'required',
            'noofrooms' => 'required',
            'noofbeds' => 'required',
            'price' => 'required',
            'description' => 'required',
            'room_image' => 'required',
        ], [
            'room_name.required' => 'Le nom de la chambre est requis.',
            'noofrooms.required' => 'Le nombre de chambres est requis.',
            'noofbeds.required' => 'Le nombre de lits est requis.',
            'price.required' => 'Le prix est requis.',
            'description.required' => 'La description est requise.',
            'room_image.required' => 'L\'image de la chambre est requise.',
        ]);

        $room = Room::find($request->room_id);

        if (!$room) {
            return redirect()->route('all-rooms')->with('error', 'Chambre non trouvée');
        }

        $room->room_name = $validatedData['room_name'];
        $room->room_qty = $validatedData['noofrooms'];
        $room->no_of_beds = $validatedData['noofbeds'];
        $room->price = $validatedData['price'];
        $room->description = $validatedData['description'];
        if ($request->visibility == true) {
            $room->status = 1;
        } else {
            $room->status = 0;
        }

        // Vérification si une nouvelle image est téléchargée
        if ($request->hasFile('room_image')) {
            $image = $request->file('room_image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $room->room_image = $imageName;
        }

        $room->save();

        return redirect()->route('all-rooms')->with('success', 'Chambre mise à jour avec succès');
    }

    public function indexAllRooms()
    {
        $rooms = Room::all();
        return view('all-rooms', compact('rooms'));
    }

    public function indexRoomsItems()
    {
        $roomItems = RoomItem::all();
        return view('all-room-items', compact('roomItems'));
    }

    public function indexInvoices()
    {
        $invoices = Invoice::all();
        return view('invoices', compact('invoices'));
    }

    public function indexNewBookings()
    {
        $today = now()->format('Y-m-d');
        $bookings = Booking::where('checkin', '>=', $today)
            ->with('room')
            ->get();
        $rooms = Room::all();
        return view('new-bookings', compact('bookings', 'rooms'));
    }

    public function indexOlderBookings()
    {
        $today = now()->format('Y-m-d');
        $bookings = Booking::where('checkout', '<', $today)
            ->get();
        return view('older-bookings', compact('bookings'));
    }

    public function getRoomItems($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $roomItems = RoomItem::where('room_id', $booking->room_id)
            ->where('status', 'A')
            ->get();
        return response()->json([
            'roomItems' => $roomItems
        ]);
    }

    public function updateStatusBooking(Request $request)
    {
        if (isset($request->room_item_id)) {
            $bookingRef = $request->input('bookingref');
            $roomItemId = $request->input('room_item_id');
            $booking = Booking::find($bookingRef);
            $booking->bstatus = 'Confirmed';
            $booking->room_item_id = $roomItemId;
            $booking->save();
            $room_item_id = RoomItem::find($roomItemId);
            $room_item_id->status = 'U';
            $room_item_id->save();
            return redirect()->back()->with('success', 'Réservation mise à jour !');
        } else {
            $admin = Auth::guard('admins')->user()->id;
            $bookingRef = $request->input('bookingref');
            $booking = Booking::find($bookingRef);
            $user_id = $booking->user_id;
            $room_item_id = $booking->room_item_id;
            $price = $booking->price;
            $booking->bstatus = 'Closed';
            $booking->save();

            $roomItems = RoomItem::find($room_item_id);
            $roomItems->status = 'A';
            $roomItems->save();
            $invoice = new Invoice();
            $invoice->id = Str::uuid();
            $invoice->booking_id = $bookingRef;
            $invoice->user_id = $user_id;
            $invoice->inv_amount = $price;
            $invoice->inv_status = 'Pending';
            $invoice->admin_id = $admin;
            $invoice->save();
            return redirect()->route('indexInvoices')->with('success', 'Réservation fermée.');
        }
    }

    public function addNewBooking(Request $request)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'gender' => 'required|in:Male,Female',
            'checkin' => 'required|date',
            'checkout' => 'required|date',
            'room_id' => 'required',
        ]);

        $user = User::create([
            'id' => Str::uuid(),
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => bcrypt('password'),
            'status' => 0,
        ]);

        $recupId = User::where('email', $request->email)->pluck('id');

        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        // Convertir les chaînes de date en objets Carbon
        $checkinDate = Carbon::createFromFormat('Y-m-d', $checkin);
        $checkoutDate = Carbon::createFromFormat('Y-m-d', $checkout);
        // Calculer la différence de jours
        $no_of_days = ($checkoutDate->diffInDays($checkinDate)) + 1;
        $room_id = $request->input('room_id');
        $room = Room::find($room_id);
        $total_price = $room->price * $no_of_days;

        $booking = Booking::create([
            'id' => Str::uuid(),
            'room_id' => $request->room_id,
            'user_id' => $recupId[0],
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'price' => $total_price,
            'payment_mode' => "Cash",
            'booking_status' => 0,
            'room_item_id' => 0,
        ]);
        return redirect()->back();
    }

    public function updatePaidInvoice($id)
    {
        $invoice = Invoice::find($id);
        $invoice->inv_status = 'Paid';
        $invoice->save();
        return redirect()->back()->with('success', 'Status mis à jour.');
    }

    public function updateClosedInvoice($id)
    {
        $invoice = Invoice::find($id);
        $invoiceDetails = InvoiceDetail::where('invoice_id', $id)->get();
        $invoice->inv_status = 'Closed';
        $invoice->save();

        $data = [
            'invoice' => $invoice,
            'invoiceDetails' => $invoiceDetails
        ];

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        $html = view('invoice-pdf', $data)->render();

        $dompdf->loadHtml($html);

        $dompdf->render();

        return $dompdf->stream('invoice.pdf');

        return redirect()->back()->with('success', 'Status mis à jour.');
    }

    public function invoiceEdit(Request $request)
    {
        try {
            $libelle = $request->input('libelle');
            $pu = $request->input('pu');
            $qte = $request->input('qte');
            $invoiceId = $request->input('invoice_id');

            $invoiceDetail = new InvoiceDetail();
            $invoiceDetail->invoice_id = $invoiceId;
            $invoiceDetail->libelle = $libelle;
            $invoiceDetail->pu = $pu;
            $invoiceDetail->qte = $qte;
            $invoiceDetail->save();
            return response()->json(['success' => true, 'message' => 'Invoice item added successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
