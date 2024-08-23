<!DOCTYPE html>
<html lang="en" data-topbar-color="brand">

<!-- Mirrored from coderthemes.com/wb/minton/layouts/default/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Jul 2023 13:48:46 GMT -->

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />


    <!-- App favicon -->
    {{-- <link rel="shortcut icon" href="assets/images/favicon.ico"> --}}
    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

    {{-- <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrapButtons example5.min.css" rel="stylesheet" type="text/css" /> --}}
    <link href="assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

    <!-- Theme Config Js -->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="assets/js/config.js"></script>

</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">

                <ul class="list-unstyled topnav-menu float-end mb-0">

                    <li class="dropdown d-inline-block d-lg-none">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <i class="fe-search noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
                            <form class="p-3">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Search">
                            </form>
                        </div>
                    </li>

                    <li class="d-none d-md-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" id="light-dark-mode"
                            href="#">
                            <i class="fe-moon noti-icon"></i>
                        </a>
                    </li>


                    <li class="dropdown d-none d-lg-inline-block">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                            href="#">
                            <i class="fe-maximize noti-icon"></i>
                        </a>
                    </li>

                    <li class="dropdown d-none d-lg-inline-block topbar-dropdown">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <i class="fe-grid noti-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">

                            <div class="p-2">
                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/images/brands/github.png" alt="Github">
                                            <span>GitHub</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/images/brands/dribbble.png" alt="dribbble">
                                            <span>Dribbble</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/images/brands/slack.png" alt="slack">
                                            <span>Slack</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="row g-0">
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/images/brands/g-suite.png" alt="G Suite">
                                            <span>G Suite</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/images/brands/bitbucket.png" alt="bitbucket">
                                            <span>Bitbucket</span>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a class="dropdown-icon-item" href="#">
                                            <img src="assets/images/brands/dropbox.png" alt="dropbox">
                                            <span>Dropbox</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-bell noti-icon"></i>
                            <span class="badge bg-danger rounded-circle noti-icon-badge">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-end">
                                        <a href="#" class="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                                </h5>
                            </div>

                            <div class="noti-scroll" data-simplebar>


                                <!-- All-->
                                <a href="javascript:void(0);"
                                    class="dropdown-item text-center text-primary notify-item notify-all">
                                    View all
                                    <i class="fe-arrow-right"></i>
                                </a>

                            </div>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">

                        <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light"
                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                            aria-expanded="false">
                            <img src=" assets/user-logo.png" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ms-1">
                                {{ Auth::user()->name }}
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">

                            <!-- item-->
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link waves-effect waves-light" data-bs-toggle="offcanvas"
                            href="#theme-settings-offcanvas">
                            <i class="fe-settings noti-icon"></i>
                        </a>
                    </li>

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index-2.html" class="logo logo-dark text-center">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm-dark.png" alt="" height="24">
                            <!-- <span class="logo-lg-text-light">Minton</span> -->
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-dark.png" alt="" height="20">
                            <!-- <span class="logo-lg-text-light">M</span> -->
                        </span>
                    </a>

                    <a href="index-2.html" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="20">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-bs-toggle="collapse"
                            data-bs-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <!-- LOGO -->
            <div class="logo-box">

                <a href="/" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <span class="logo-lg-text-light">IMS</span>
                    </span>
                    <span class="logo-lg">

                        <span class="logo-lg-text-light">Smart Shop</span>
                    </span>
                </a>

                <a href="/" class="logo logo-light text-center">
                    <span class="logo-sm">
                        <span class="logo-lg-text-light">IMS</span>
                    </span>
                    <span class="logo-lg">

                        <span class="logo-lg-text-light">Smart Shop </span>
                    </span>
                </a>
            </div>

            <div class="h-100" data-simplebar>


                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul id="side-menu">

                        {{-- <li class="menu-title">Navigation</li> --}}

                        <li>
                            <a href="/dashboard" class="waves-effect">
                                <i class="fas fa-th"></i>
                                {{-- <span class="badge bg-success rounded-pill float-end">3</span> --}}
                                <span> Dashboard </span>
                            </a>

                        </li>

                        <li class="menu-title mt-2">Menu</li>
                        <li>
                            <a href="#purchase" data-bs-toggle="collapse" aria-expanded="false"
                                aria-controls="sidebarEcommerce">
                                <i class="fas fa-marker"></i>
                                <span class="badge bg-info float-end">1</span>
                                <span> Register </span>
                            </a>
                            <div class="collapse" id="purchase">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="warehouse">Location</a>
                                    </li>
                                    {{-- <li>
                                        <a href="shops">Shop</a>
                                    </li> --}}

                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="/items">
                                <i class="fas fa-barcode"></i>
                                <span> Items </span>
                            </a>
                        </li>

                        <li>
                            <a href="#sidebarEcommerce" data-bs-toggle="collapse" aria-expanded="false"
                                aria-controls="sidebarEcommerce">
                                <i class="fas fa-ambulance"></i>
                                <span class="badge bg-info float-end">2</span>
                                <span> Purchase </span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="purchase">Purchases</a>
                                    </li>
                                    <li>
                                        <a href="vendor">Vendors</a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#sales" data-bs-toggle="collapse" aria-expanded="false"
                                aria-controls="sidebarEcommerce">
                                <i class=" fas fa-shopping-cart"></i>
                                <span class="badge bg-info float-end">2</span>
                                <span> Sales </span>
                            </a>
                            <div class="collapse" id="sales">
                                <ul class="nav-second-level">
                                    {{-- <li>
                                        <a href="product-sales">Product Sales</a>
                                    </li> --}}
                                    <li>
                                        <a href="service-sales">Item Sales</a>
                                    </li>
                                    <li>
                                        <a href="customer">Customer</a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="transefer-item">
                                <i class=" fas fa-text-height"></i>
                                {{-- <span class="badge bg-info float-end">3</span> --}}
                                <span> Item Transfer </span>
                            </a>
                        </li>
                        <li>
                            <a href="salesApproved">
                                <i class=" fas fa-reply-all"></i>
                                {{-- <span class="badge bg-info float-end">3</span> --}}
                                <span> Sales Approved </span>
                            </a>
                        </li>
                        <li>
                            <a href="inventoryAdjustment">
                                <i class=" fas fa-reply-all"></i>
                                {{-- <span class="badge bg-info float-end">3</span> --}}
                                <span> Inventory Adjustment </span>
                            </a>
                        </li>


                        <li>
                            <a href="disposing">
                                <i class="fas fa-trash"></i>
                                <span> Disposing </span>
                            </a>
                        </li>

                        <li>
                            <a href="#report" data-bs-toggle="collapse" aria-expanded="false"
                                aria-controls="sidebarEcommerce">
                                <i class=" fas fa-chart-line"></i>
                                <span class="badge bg-info float-end">3</span>
                                <span> Reports </span>
                            </a>
                            <div class="collapse" id="report">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="sales-summary">Sales Summary</a>
                                    </li>
                                    <li>
                                        <a href="purchaseSummary">Purchase Summary</a>
                                    </li>
                                    <li>
                                        <a href="itemSummary">Item Summary</a>
                                    </li>
                                    <li>
                                        <a href="inventory-report">Inventory Report</a>
                                    </li>

                                </ul>
                            </div>
                        </li>


                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page text-black">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                </div> <!-- container -->

                @yield('content')

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; Design and Developed By <a href="#">SkyLink
                                Technologies</a>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end footer-links d-none d-sm-block">
                                <a href="javascript:void(0);">About Us</a>
                                <a href="javascript:void(0);">Help</a>
                                <a href="javascript:void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

    <!-- Sweet alert init js-->
    <script src="assets/js/pages/sweet-alerts.init.js"></script>

    <!-- Plugin js-->
    <script src="assets/libs/parsleyjs/parsley.min.js"></script>

    <!-- Validation init js-->
    <script src="assets/js/pages/form-validation.init.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>


    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script><!-- end row-->

    <!-- Plugins js -->
    <script src="assets/libs/moment/min/moment.min.js"></script>
    <script src="assets/libs/x-editable/bootstrap-editable/js/bootstrap-editable.min.js"></script>

    <!-- Init js-->
    <script src="assets/js/pages/form-xeditable.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.min.js"></script>



</body>

<!-- Mirrored from coderthemes.com/wb/minton/layouts/default/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Jul 2023 13:48:46 GMT -->

</html>
