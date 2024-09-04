@extends('base')

@section('main-content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Admin Dashboard</h2>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$countRooms}}</h2>
                                    <span>Total Rooms</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$countUsers}}</h2>
                                    <span>Total Users</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="text">
                                    <h2>{{$countAdmins}}</h2>
                                    <span>Total Admins</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ... -->
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fas fa-sign-out-alt"></i> <!-- Icône pour les départs -->
                                </div>
                                <div class="text">
                                    <h2>{{$countDeparture}}</h2>
                                    <span>Departure</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    <i class="fas fa-sign-in-alt"></i> <!-- Icône pour les arrivées -->
                                </div>
                                <div class="text">
                                    <h2>{{$countArrival}}</h2>
                                    <span>Arrival</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>All rights reserved @ 2021. Les Technologies AZANA : Bookings.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection