@extends('base')

@section('main-content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Older Bookings</h2>
                    </div>
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
                                <th class="text-center">Room Name</th>
                                <th class="text-center">Checkin</th>
                                <th class="text-center">Checkout</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Booked On</th>
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
                                    @if($booking->room)
                                    {{$booking->room->room_name}}
                                    @else
                                    Room Deleted
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($booking->checkin)->format('d-m-Y') }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($booking->checkout)->format('d-m-Y') }}
                                </td>
                                <td class="text-center">
                                    {{$booking->price}}
                                </td>
                                <td class="text-center">
                                    {{ $booking->created_at->format('d-m-Y à H:i:s') }}
                                </td>
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