<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Master</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href='https://fonts.googleapis.com/css?family=Khmer' rel='stylesheet'>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href={{ asset('plugins/fontawesome-free/css/all.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('css/adminlte.min.css') }}>

    <link rel="stylesheet" href={{ asset('css/style_v.css') }}>




    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Add these script tags in the head or before the closing body tag -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    {{-- new --}}


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <style>
        body {
            font-family: "Khmer", sans-serif;
        }

        .error-message {
            color: red;
            font-size: 12px;
        }

        .table tbody td {
            vertical-align: middle;
        }

        /* img */
        .circle {
            border-radius: 50%;
            overflow: hidden;
            width: 150px;
            height: 150px;
            border: 1px solid rgba(62, 248, 53, 0.2);
            cursor: pointer;
        }

        .profile-pic {
            width: 100%;
            max-width: 150px;
            height: 100%;
            /* object-fit: cover; */
        }

        img {
            max-width: 100%;
            height: 100%;
            object-fit: cover;
        }

        tr td {
            padding-top: 2px !important;
            padding-bottom: 2px !important;
            margin: 0 !important;
        }

        .box-img {
            display: flex;
            justify-content: center;
            margin: 0;
            width: 100%;
            height: 100%;
        }

        .box-img img {
            height: 50px;
            width: 50px;
            object-fit: cover;
        }

        .box-img-attendance {
            display: flex;
            justify-content: start;
            margin: 0;
            width: 100%;
            height: 100%;
        }

        .box-img-attendance img {
            height: 200px;
            width: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->

        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="z-index:1">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">Products</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>

                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/roles" class="brand-link">
                <img src="{{ url('images/logo4.png') }}" alt="" width="100%">
                {{-- <img src="{{ url('images/logo3.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Chanborey Chea</span> --}}
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ url('images/logo5.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Internal audit unit</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/departments" class="nav-link">
                                        <i class='far fa-building nav-icon'></i>
                                        <p>នាយកដ្ឋាន</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/offices" class="nav-link">
                                        <i class="fas fa-house-user nav-icon"></i>
                                        <p>ការិយាល័យ</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/roles" class="nav-link">
                                        <i class="fa fa-tasks nav-icon"></i>
                                        <p>តួនាទី</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/users" class="nav-link">
                                        <i class="far fa-user nav-icon"></i>
                                        <p>មន្ត្រី</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/attendances" class="nav-link">
                                        <i class="far fa-clock nav-icon"></i>
                                        <p>វត្តមាន</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/admins/logout" class="nav-link">
                                <i class='fas fa-sign-out-alt' style="color: red"></i>
                                <p>
                                    ចាកចេញ
                                    {{-- <span class="right badge badge-danger">go</span> --}}
                                </p>

                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            {{-- <h1 class="m-0">Products</h1> --}}
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-12">

                            @yield('content')

                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        {{-- <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021.</strong> All rights reserved.
        </footer> --}}
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->


    <script>
        $(document).ready(function() {
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $(".file-upload").on('change', function() {
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
        });


        // ---------------------------Alert Auto--------------------------------------------
        // $('#success-alert, #error-alert').fadeIn('slow');

        // setTimeout(function() {

        //     $('#success-alert, #error-alert').fadeOut('slow');

        // }, 5000);
        // 5 seconds in milliseconds
        //  $('#success-alert, #error-alert').delay(3000).fadeIn('slow');

        // setTimeout(function() {
        //     $('#success-alert, #error-alert').delay(2000).fadeOut('slow');
        // }, 5000);
        // --------------------------------------border green and red -------------------------------------------
    </script>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>

</body>

</html>
