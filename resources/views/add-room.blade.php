@extends('base')

@section('main-content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>ADD ROOM</strong>
                        <small> Form</small>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(isset($room))
                    <form action="{{route('edit-room')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body card-block">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="hidden" value="{{$room->id}}" name='room_id'>
                                        <label for="cc-exp" class="control-label mb-1">Room Name</label>
                                        <input id="cc-exp" name="room_name" type="text" class="form-control cc-exp" value="{{$room->room_name}}" placeholder="" required>
                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="x_card_code" class="control-label mb-1">Total Room</label>
                                    <div class="input-group">
                                        <input id="x_card_code" name="noofrooms" type="number" class="form-control cc-cvc" value="{{$room->room_qty}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">No of Beds</label>
                                        <input id="cc-exp" name="noofbeds" type="number" class="form-control cc-exp" value="{{$room->no_of_beds}}" required>
                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="x_card_code" class="control-label mb-1">Rate (per Day/Night)</label>
                                    <div class="input-group">
                                        <input id="x_card_code" name="price" type="number" class="form-control cc-cvc" value="{{$room->price}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="summernote form-control" required name="description">{{$room->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Add Room Image</label>
                                        <input type="file" required class="form-control" value="{{$room->room_image}}" name="room_image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Show/Hide</label> <br>
                                        <label class="switch">
                                            <input type="checkbox" name="visibility" {{ $room->status == 1 ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                        <small class="help-text">Green=Shown, Red=Hidden</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <button type="submit" name="add_room_btn" class="btn btn-primary btn-block float-right">Update Room</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @else
                    <form action="{{route('add-room')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body card-block">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">Room Name</label>
                                        <input id="cc-exp" name="room_name" type="text" class="form-control cc-exp" value="" placeholder="" required>
                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="x_card_code" class="control-label mb-1">Total Room</label>
                                    <div class="input-group">
                                        <input id="x_card_code" name="noofrooms" type="number" class="form-control cc-cvc" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="cc-exp" class="control-label mb-1">No of Beds</label>
                                        <input id="cc-exp" name="noofbeds" type="number" class="form-control cc-exp" value="" required>
                                        <span class="help-block" data-valmsg-for="cc-exp" data-valmsg-replace="true"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="x_card_code" class="control-label mb-1">Rate (per Day/Night)</label>
                                    <div class="input-group">
                                        <input id="x_card_code" name="price" type="number" class="form-control cc-cvc" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="summernote form-control" required name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Add Room Image</label>
                                        <input type="file" required class="form-control" name="room_image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Show/Hide</label> <br>
                                        <label class="switch">
                                            <input type="checkbox" name="visibility">
                                            <span class="slider round"></span>
                                        </label>
                                        <small class="help-text">Green=Shown, Red=Hidden</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <button type="submit" name="add_room_btn" class="btn btn-primary btn-block float-right">Add Room</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection