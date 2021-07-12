<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="locale", content="{{ str_replace('_', '-', app()->getLocale()) }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Browser tab Fav logo --}}
    <link rel="icon" type="image/png" href="/logo/400dpiLogo.png" sizes="32x32">
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/dashboard-custom.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

    {{-- Select2 --}}
    <link href="{{ asset('plugins/select2/select2-bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="/">@lang('dashboard.app-name')</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
            ><!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                        >
                            @lang('dashboard.logout')
                        </a>
                        <a class="dropdown-item" href="{{ route('dashboard.password.index') }}">
                            @lang('dashboard.change-password')
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">@lang('dashboard.dashboard')</div>
                            <a class="nav-link" href="{{ route('home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                @lang('dashboard.dashboard')
                            </a>
                            <a class="nav-link" href="{{ route('dashboard.users') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                @lang('dashboard.users.users')
                            </a>
                            <a class="nav-link" href="{{ route('dashboard.patients') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-hotel"></i></div>
                                @lang('dashboard.patients.patients')
                            </a>
                            <a class="nav-link" href="{{ route('dashboard.institutions') }}">
                                <div class="sb-nav-link-icon"><i class="fa fa-home"></i></div>
                                @lang('dashboard.institutions.institutions')
                            </a>
                            <a class="nav-link" href="{{ route('dashboard.subscriptions') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-subscript"></i></div>
                                @lang('dashboard.subscriptions.subscriptions')
                            </a>
                            <a class="nav-link" href="{{ route('dashboard.invoices') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                                @lang('dashboard.invoices.invoices')
                            </a>
                            <a class="nav-link" href="{{ route('dashboard.folders') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                @lang('dashboard.folders.folders')
                            </a>
                            <a class="nav-link" href="{{ route('dashboard.documents') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                @lang('dashboard.documents.documents')
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">@lang('dashboard.logged-in-as')</div>
                        {{ Auth::user()->name }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">@lang('dashboard.copyright')</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
</body>
</html>
