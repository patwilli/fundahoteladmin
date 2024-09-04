<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function indexDashboard()
    {
        $countRooms = Room::count();
        $countUsers = User::count();
        $countAdmins = Admin::count();

        $today = now()->toDateString();

        $countArrival = Booking::whereDate('checkin', $today)->count();
        $countDeparture = Booking::whereDate('checkout', $today)->count();

        return view('index', compact('countRooms', 'countUsers', 'countAdmins', 'countArrival', 'countDeparture'));
    }
}
