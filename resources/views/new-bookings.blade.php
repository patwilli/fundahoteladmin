@extends('base')

@section('main-content')


<!-- Payment Modal -->
<div class="modal fade" id="CheckoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('addNewBooking')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">First Name</label>
                                <input type="text" class="form-control alphaonly" required name="fname">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control alphaonly" required name="lname">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="number" id="mobilenumber" class="form-control" required name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email adress</label>
                                <input type="email" required class="form-control" name="email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="">Choose Gender</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Male" id="male">
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" value="Female" id="female">
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Checkin</label>
                                <input type="date" class="form-control" required name="checkin">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Checkout</label>
                                <input type="date" required class="form-control" name="checkout">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3" id="special_div">
                        <label for="" class="col-form-label">Rooms</label>
                        <select name="room_id" id="" class="form-control">
                            @foreach($rooms as $room)
                            <option value="{{$room->id}}">{{$room->room_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Payment Modal -->


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form action="{{route('updateStatusBooking')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Reference:</label>
                        <input type="text" readonly="readonly" name="bookingref" class="form-control" id="bookingref">
                        <input type="hidden" name="bookingstatus" id="bookingstatus" />
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Date:</label>
                        <input type="date" name="opdate" class="form-control">
                    </div>
                    <div class="mb-3" id="special_div">
                        <label for="room-item" class="col-form-label">Room Item:</label>
                        <select name="room_item_id" id="room-item" class="form-control">

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Comment:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="upd_booking" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="overview-wrap">
                        <h2 class="title-1">Upcoming Bookings</h2>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="#" class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#CheckoutModal">Add New Booking</a>
                </div>
            </div>
            <br>
            <br>
            <div class="col-lg-12">
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th class="text-center">User Name</th>
                                <th class="text-center">User Phone</th>
                                <th class="text-center">Room Name</th>
                                <th class="text-center">Checkin</th>
                                <th class="text-center">Checkout</th>
                                <th class="text-center">Days</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Booked on</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($bookings)>0)
                            @foreach($bookings as $booking)
                            <tr>
                                <td class="text-center">
                                    @if($booking->user)
                                    {{$booking->user->fname}} {{$booking->user->lname}}
                                    @else
                                    User Deleted
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($booking->user)
                                    {{$booking->user->phone}}
                                    @else
                                    User Deleted
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($booking->room)
                                    {{$booking->room->room_name}}
                                    @else
                                    Room Deleted
                                    @endif
                                </td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($booking->checkin)->format('d-m-Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($booking->checkout)->format('d-m-Y') }}</td>
                                <td class="text-center"> {{ (\Carbon\Carbon::parse($booking->checkin)->diffInDays(\Carbon\Carbon::parse($booking->checkout)))+1 }}
                                </td>
                                <td class="text-center">{{$booking->price}}</td>
                                <td class="text-center">{{$booking->created_at->format('d-m-Y à H:i:s')}}</td>
                                @if($booking->bstatus=='Pending')
                                <td class="text-center">{{$booking->bstatus}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm " name="edit_admin" data-bs-value="{{$booking->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Confirmed">
                                        Confirmed
                                    </button>
                                </td>
                                @endif
                                @if($booking->bstatus=='Confirmed')
                                <td class="text-center">{{$booking->bstatus}}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-info btn-sm " name="edit_admin" data-bs-value="{{$booking->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Closed">
                                        Closed
                                    </button>
                                </td>
                                @endif
                                @if($booking->bstatus=='Closed')
                                <td class="text-center">{{$booking->bstatus}}</td>
                                <td></td>
                                @endif
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8" class="text-center">
                                    <h4>Rien pour le moment</h4>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var bstatus = button.data('bs-whatever');
        var modal = $(this);
        var roomItemSelect = modal.find('#room-item');
        var bookingRefInput = modal.find('#bookingref');

        bookingRefInput.val(button.data('bs-value')); // Pré-remplissage du champ bookingRef

        if (bstatus === 'Confirmed') {
            $.ajax({
                type: "GET",
                url: "/getRoomItems/" + button.data('bs-value'),
                success: function(data) {
                    roomItemSelect.empty();
                    data.roomItems.forEach(function(roomItem) {
                        roomItemSelect.append($('<option>', {
                            value: roomItem.id,
                            text: roomItem.number
                        }));
                    });
                    modal.find('#special_div').removeClass('d-none'); // Afficher la section spéciale
                }
            });
        } else {
            modal.find('#special_div').addClass('d-none'); // Masquer la section spéciale
        }
    });
</script>


@endsection