@extends('base')

@section('main-content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Rooms Items</h2>
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
                                    <th class="text-center">Number</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($roomItems)>0)
                                @foreach($roomItems as $roomItem)
                                <tr>
                                    <td class="text-center">
                                        @if($roomItem->room->room_name)
                                        {{$roomItem->room->room_name}}
                                        @else
                                        Room Deleted
                                        @endif
                                    </td>
                                    <td class="text-center">{{$roomItem->number}}</td>
                                    @if($roomItem->status === 'A')
                                    <td class="text-center">
                                        <span class="badge bg-success" style="color:white">Libre</span>
                                    </td>
                                    @endif
                                    @if($roomItem->status === 'U')
                                    <td class="text-center">
                                        <span class="badge bg-danger" style="color:white">Occupée</span>
                                    </td>
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
</div>
@endsection