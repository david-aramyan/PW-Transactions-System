<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Parrot Wings</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">
    <!-- MDBootstrap Datatables  -->
    <link href="{{asset('css/addons/datatables.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{asset('js/mdb.min.js')}}" defer></script>
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="{{asset('js/addons/datatables.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</head>
<body>

<!--Main Navigation-->
<header>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark primary-color fixed-top">

        <div class="container">

            <!-- Navbar brand -->
            <a class="navbar-brand" href="/">Parrot Wings</a>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="basicExampleNav">

                <!-- Links -->
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item @if(Request::is('login')) active @endif">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item @if(Request::is('register')) active @endif">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <span class="nav-link">{{ Auth::user()->balance }} PW</span>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="true">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                                @if(Auth::user()->role->name == "Admin")
                                    <a class="dropdown-item waves-effect waves-light" href="{{ route('admin.users') }}">Users</a>
                                    <a class="dropdown-item waves-effect waves-light" href="{{ route('admin.transactions') }}">Transactions</a>
                                @endif
                                    <a class="dropdown-item waves-effect waves-light" href="{{ route('newTransaction') }}">New Transaction</a>
                                    <a class="dropdown-item waves-effect waves-light" href="{{ route('history') }}">My Transactions History</a>
                                <a class="dropdown-item waves-effect waves-light" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
                <!-- Links -->

            </div>
            <!-- Collapsible content -->

        </div>

    </nav>
    <!--/.Navbar-->
</header>
<!--Main Navigation-->

<!--Main layout-->
<main>

    @if(session('message'))
        <div class="container">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        </div>
    @endif
    @yield('content')
</main>
<!--Main layout-->

<!--Footer-->
<footer>

</footer>
<!--Footer-->
@yield('scripts')
</body>
</html>
