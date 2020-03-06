<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/unicef_logo.png') }}">

    <title>@yield('title', 'UNICEF Egypt')</title>

    {{-- Custom CSS --}}
    <link href="{{ asset('assets/dist/css/style.min.css') }}" type="text/css" rel="stylesheet">
    <!-- Styles -->
    @yield('css')
</head>
<body class="@yield('body-class', 'skin-default fixed-layout')">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">@yield('title', 'UNICEF Egypt')</p>
        </div>
    </div>
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
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('assets/images/unicef_logo.png') }}" style="height: 40px" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                            <img src="{{ asset('assets/images/unicef_logo.png') }}" style="height: 40px" alt="homepage" class="light-logo" />
                        </b>
                        <!-- End Logo icon -->

                        <!-- Logo text -->
                        <span style="margin-left: 13px;">
                            <!-- dark Logo text -->
                            <img src="{{ asset('assets/images/unicef_logo_text.png') }}" style="height: 40px" alt="homepage" class="dark-logo" />
                            <!-- Light Logo text -->
                            <img src="{{ asset('assets/images/unicef_logo_text.png') }}" style="height: 40px" class="light-logo" alt="homepage" />
                        </span>
                        <!-- End Logo text -->
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
                        <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        {{-- Switch Locale --}}
                        <li class="nav-item right-side-toggle">
                            <a class="nav-link waves-effect waves-light" href="{{ route('switchLocale') }}" data-toggle="tooltip" title="@lang('Switch Language')">
                                <i class="fas fa-language"
                                   style="font-size: 1.8rem; vertical-align: middle"></i>
                            </a>
                        </li>
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
                <!-- User Profile-->
                <div class="user-profile">
                    <div class="user-pro-body">
                        <div><img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="user-img" class="img-circle"></div>
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
                            <div class="dropdown-menu animated flipInY">
                                <!-- text-->
                                <a href="{{ route('user.show', auth()->user()->id) }}" class="dropdown-item"><i class="ti-user"></i> @lang('My Profile')</a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="{{ route('user.edit', auth()->user()->id) }}" class="dropdown-item"><i class="ti-settings"></i> @lang('Account Setting')</a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- Log out -->
                                <a href="javascript:void(0)" onclick="document.getElementById('log-out-form').submit()" class="dropdown-item"><i class="fa fa-power-off"></i> @lang('Logout')</a>
                                <form id="log-out-form" action="{{ route('logout') }}" method="post">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-table-large"></i><span class="hide-menu">Reports</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('reports.syrians') }}">@lang('Syrians')</a></li>
                                <li><a href="{{ route('reports.governorates') }}">@lang('Governorates')</a></li>
                                <li><a href="{{ route('reports.countries') }}">@lang('Nationalities')</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="far fa-chart-bar"></i><span class="hide-menu">@lang('Charts')</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('charts.syrians') }}">@lang('Syrians')</a></li>
                                <li><a href="{{ route('charts.governorates') }}">@lang('Governorates')</a></li>
                                <li><a href="{{ route('charts.countries') }}">@lang('Nationalities')</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-login"></i><span class="hide-menu">@lang('Import')</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('import.governorate.form') }}">@lang('Governorates')</a></li>
                                <li><a href="{{ route('import.country.form') }}">@lang('Nationalities')</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-map-alt"></i><span class="hide-menu">@lang('Maps')</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('map.syrians') }}">@lang('Syrians')</a></li>
                                <li><a href="{{ route('map.allNationalities') }}">@lang('All Nationalities')</a></li>
                            </ul>
                        </li>

                        <li> <a class="waves-effect waves-dark" href="{{ route('governorate.add.showForm') }}" aria-expanded="false"><i class="fas fa-plus-square"></i><span class="hide-menu">@lang('Add Governorate')</span></a></li>

                        <li> <a class="waves-effect waves-dark" href="{{ url('translations') }}" aria-expanded="false"><i class="mdi mdi-google-translate"></i><span class="hide-menu">@lang('Translations')</span></a></li>
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
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h4 class="text-themecolor">@yield('page-title')</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                @yield('additional-breadcrumb')
                                @if (Route::currentRouteName() !== 'home')
                                    <li class="breadcrumb-item active">@yield('page-title-breadcrumb')</li>
                                @endif
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

                @yield('content')

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2019 Eliteadmin by themedesigner.in
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- Scripts -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script type="text/javascript" src="{{ asset('assets/node_modules/jquery/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script type="text/javascript" src="{{ asset('assets/node_modules/popper/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/node_modules/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script type="text/javascript" src="{{ asset('assets/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <!--Wave Effects -->
    <script type="text/javascript" src="{{ asset('assets/dist/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script type="text/javascript" src="{{ asset('assets/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript" src="{{ asset('assets/dist/js/custom.min.js') }}"></script>
    @yield('javascript')
</body>
</html>
