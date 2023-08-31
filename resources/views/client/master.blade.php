<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('AdminStyle/assets/images/favicon.jpg')}}">
    <title>Octant | Client | @yield('title')</title>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- This page CSS -->
    <!-- chartist CSS -->
    <link href="{{asset('AdminStyle/assets/node_modules/morrisjs/morris.css')}}" rel="stylesheet">
    <!--Toaster Popup message CSS -->
    {{--
    <link href="{{asset('AdminStyle/assets/node_modules/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    --}}
    <!-- Custom CSS -->
    <link href="{{asset('AdminStyle/realestate/dist/css/style.css')}}" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{asset('AdminStyle/realestate/dist/css/pages/dashboard1.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="skin-blue-dark fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    {{-- <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div> --}}
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{Route('dashboard')}}">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{asset('AdminStyle/assets/images/octant-logo.jpg')}}" alt="homepage"
                                class="dark-logo" height="40px" width="90%" />
                            <!-- Light Logo icon -->
                            <img src="{{asset('AdminStyle/assets/images/octant-logo.jpg')}}" alt="homepage"
                                class="light-logo" height="40px" width="90%" />
                        </b>
                        <!--End Logo icon -->
                        {{-- <span class="hidden-xs"><span class="font-bold">elite</span>realestate</span> --}}
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a
                                class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark"
                                href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        {{-- <li class="nav-item">
                            <form class="app-search d-none d-md-block d-lg-block">
                                <input type="text" class="form-control" placeholder="Search & enter">
                            </form>
                        </li> --}}
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- User Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown u-pro">
                            @if (session('image') == null)
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="{{asset('AdminStyle/assets/images/default_avatar.jpg')}}" alt="user" class="">
                                <span class="hidden-md-down">{{session('name')}} &nbsp;<i
                                        class="fa fa-angle-down"></i></span> </a>
                            @else
                            <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href=""
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                    src="{{URL::asset(session('image'))}}" alt="user" class=""> <span
                                    class="hidden-md-down">{{session('name')}} &nbsp;<i
                                        class="fa fa-angle-down"></i></span> </a>
                            @endif

                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <a href="{{Route('client.account.setting.view')}}" class="dropdown-item"><i
                                        class="ti-settings"></i> Setting</a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="{{Route('logout')}}" class="dropdown-item"><i class="fa fa-power-off"></i>
                                    Logout</a>
                                <!-- text-->
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End User Profile -->
                        <!-- ============================================================== -->
                        {{-- <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light"
                                href="javascript:void(0)"><i class="ti-settings"></i></a></li> --}}
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="waves-effect waves-dark" href="{{Route('client.loans')}}"><i
                                    class="ti-menu"></i><span class="hide-menu">Loan Details</span></a>
                        </li>

                        <li> <a class="waves-effect waves-dark" href="{{Route('client.account.setting.view')}}"><i
                                    class="ti-settings"></i><span class="hide-menu">Account Setting</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="{{Route('logout')}}"><i
                                    class="ti-power-off"></i><span class="hide-menu">Logout</span></a>
                        </li>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Session Content  -->
            <!-- ============================================================== -->
            <br>
            <div class="col-md-12">
                @yield('content')
            </div>

            <!-- ============================================================== -->
            <!-- End Session Content  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2021 Octant Pipeline
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('AdminStyle/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap popper Core JavaScript -->
    <script src="{{asset('AdminStyle/assets/node_modules/popper/popper.min.js')}}"></script>
    <script src="{{asset('AdminStyle/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('AdminStyle/realestate/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('AdminStyle/realestate/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('AdminStyle/realestate/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('AdminStyle/realestate/dist/js/custom.min.js')}}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="{{asset('AdminStyle/assets/node_modules/raphael/raphael-min.js')}}"></script>
    <script src="{{asset('AdminStyle/assets/node_modules/morrisjs/morris.min.js')}}"></script>
    <script src="{{asset('AdminStyle/assets/node_modules/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- Popup message jquery -->
    {{-- <script src="{{asset('AdminStyle/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script> --}}
    <!-- Chart JS -->
    <script src="{{asset('AdminStyle/realestate/dist/js/dashboard1.js')}}"></script>
    <!-- This is data table -->
    <script src="{{asset('AdminStyle/assets/node_modules/datatables/jquery.dataTables.min.js')}}"></script>

    @yield('custom_scripts')


</body>

</html>
