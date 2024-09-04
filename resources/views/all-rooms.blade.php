@extends('base')

@section('main-content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">All Rooms</h2>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th class="text-center">Room Name</th>
                                    <th class="text-center">Total Rooms</th>
                                    <th class="text-center">No of Beds</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Statuts</th>
                                    <th class="text-center">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($rooms)>0)
                                @foreach($rooms as $room)
                                <tr>
                                    <td class="text-center">{{$room->room_name}}</td>
                                    <td class="text-center">{{$room->room_qty}}</td>
                                    <td class="text-center">{{$room->no_of_beds}}</td>
                                    <td class="text-center">{{$room->price}}</td>
                                    <td class="text-center"><img src="uploads/{{$room->room_image}}" alt="{{$room->room_image}}" width="50" height="50"></td>
                                    @if($room->status == 0)
                                    <td class="text-center">
                                        <span class="badge bg-success" style="color:white">Visible</span>
                                    </td>
                                    @else
                                    <td class="text-center">
                                        <span class="badge bg-danger" style="color:white">Hidden</span>
                                    </td>
                                    @endif
                                    <td class="text-center"><a href="{{route('edit-room-form', ['id' => $room->id])}}" class="btn btn-info">Edit</a></td>
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
</div>
@endsection