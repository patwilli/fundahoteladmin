@extends('base')

@section('main-content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Clients</h2>
                    </div>
                </div>
                <br>
                <br>
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-striped table-earning">
                            <thead>
                                <tr>
                                    <th class="text-center">First Name</th>
                                    <th class="text-center">Last Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Statuts</th>
                                    <th class="text-center">Ban</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($clients)>0)
                                @foreach($clients as $client)
                                <tr>
                                    <td class="text-center">{{$client->fname}}</td>
                                    <td class="text-center">{{$client->lname}}</td>
                                    <td class="text-center">{{$client->phone}}</td>
                                    <td class="text-center">{{$client->gender}}</td>
                                    <td class="text-center">{{$client->email}}</td>
                                    @if($client->status != 0)
                                    <td class="text-center"><span class="badge bg-danger" style="color:white">Banned</span></td>
                                    <td class="text-center"><a href="{{route('unban-client', ['id' => $client->id])}}" class="btn btn-success">Unban</a></td>
                                    @else
                                    <td class="text-center"><span class="badge bg-success" style="color:white">Active</span></td>
                                    <td class="text-center"><a href="{{route('ban-client', ['id' => $client->id])}}" class="btn btn-danger">Ban</a></td>
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