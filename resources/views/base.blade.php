<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

    <!-- Import des ressources SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="{{ route('dashboard') }}">
                            HEY {{Auth::guard('admins')->user()->name}}
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Admin Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('all-rooms') }}">
                                <i class="fas fa-bed"></i> All Rooms
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('indexRoomsItems') }}">
                                <i class="fas fa-bed"></i> Rooms Items
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('add-room-form') }}">
                                <i class="fas fa-plus-circle"></i> Add Rooms
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('all-client') }}">
                                <i class="fas fa-user"></i> Clients
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('indexOlderBookings') }}">
                                <i class="far fa-calendar-alt"></i> Older Bookings
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('indexNewBookings') }}">
                                <i class="far fa-calendar-plus"></i> New Bookings
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('indexInvoices') }}">
                                <i class="fas fa-file"></i> Invoices
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('indexManageAccounts') }}">
                                <i class="fas fa-users"></i> Manage Accounts
                            </a>
                        </li>
                    </ul>

                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="{{route('dashboard')}}">
                    HEY {{Auth::guard('admins')->user()->name}}
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="{{route('dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i>Admin Dashboard</a>
                        </li>
                        <li>
                            <a href="{{route('all-rooms')}}">
                                <i class="fas fa-bed"></i>All Rooms</a>
                        </li>
                        <li>
                            <a href="{{route('indexRoomsItems')}}">
                                <i class="fas fa-bed"></i>Rooms Items</a>
                        </li>
                        <li>
                            <a href="{{route('add-room-form')}}">
                                <i class="fas fa-plus-circle"></i>Add Rooms</a>
                        </li>
                        <li>
                            <a href="{{route('all-client')}}">
                                <i class="fas fa-user"></i>Clients</a>
                        </li>
                        <li>
                            <a href="{{route('indexOlderBookings')}}">
                                <i class="far fa-calendar-alt"></i>Older Bookings</a>
                        </li>
                        <li>
                            <a href="{{route('indexNewBookings')}}">
                                <i class="far fa-calendar-plus"></i>New Bookings</a>
                        </li>
                        <li>
                            <a href="{{route('indexInvoices')}}">
                                <i class="fas fa-file"></i>Invoices</a>
                        </li>
                        <li>
                            <a href="{{route('indexManageAccounts')}}">
                                <i class="fas fa-users"></i>Manage Accounts</a>
                        </li>
                    </ul>

                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <a href="#" class="btn btn-danger" id="logoutButton">
                                            <i class="zmdi zmdi-power"></i>&nbsp; Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            @yield('main-content')
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (session('success')) : ?>

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "<?php echo session('success'); ?>"
            });
        <?php
        endif; ?>

        <?php if ($errors->has('error')) : ?>

            const Toastt = Swal.mixin({
                toastt: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toastt) => {
                    toastt.onmouseenter = Swal.stopTimer;
                    toastt.onmouseleave = Swal.resumeTimer;
                }
            });
            Toastt.fire({
                icon: "danger",
                title: "<?php echo $errors->first('error '); ?>"
            });
        <?php
        endif; ?>
    </script>
    <script>
        $(document).ready(function() {
            $('#logoutButton').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Confirmation',
                    text: 'Êtes-vous sûr de vouloir vous déconnecter ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, déconnectez-moi !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirection vers la route de déconnexion
                        window.location.href = '/logout';
                    }
                });
            });
        });
    </script>

    @yield('footer-script')

</body>

</html>
<!-- end document-->