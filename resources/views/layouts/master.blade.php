<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">

    <title>{{ config('app.name', 'INK Marine Co.,Ltd.') }}</title>
    <style>
        ul.left-nave li a,ul.right-nave li a{
            color: #000000;
            font-weight: 600;
            text-decoration: none;
            text-transform: uppercase;
            padding:5px 15px !important;
        }
        .navbar{
            z-index:1;
            background-color:#d0dae0;
        }
        .navbar-light .navbar-nav a.nav-link:hover{
            color:#000046;
            opacity: 1;
            /* background-color:#ffffff; */
        }
        .navbar-nav > .active{
            background:#6574cd;
        }
        .navbar-nav > .active >a{
            color:white !important;
        }
    </style>
</head>
<body>
    <!-- Main Header -->
    <header>
        <div class="container">
            <h3 class="logo">INK Marine Co.,Ltd.</h3>
        </div>
    </header>
    <!-- End Main Header -->
    <!-- Second Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container" id="main_nav">
            <div class="nav-container collapse navbar-collapse">
                <!-- Left Side NavBar -->
                <ul class="left-nave navbar-nav">
                    @guest
                    <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    @else
                    <li class="{{ (request()->is('home')||Request::is( 'detail/*')) ? 'active' : '' }}"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
                    @if(Auth::user()->role_id == 1)
                    <li class="{{ (request()->is('users')) ? 'active' : '' }}"><a class="nav-link" href="{{ url('/users') }}">Users</a></li>
                    @endif
                    <li class="{{ (request()->is('employer/create')) ? 'active' : '' }}"><a class="nav-link" href="{{url('/employer/create')}}">Create</a></li>
                    <li class="{{ (request()->is('company')) ? 'active' : '' }}"><a class="nav-link" href="{{url('/company')}}">Companies</a></li>
                    <li class="{{ (request()->is('ship')) ? 'active' : '' }}"><a class="nav-link" href="{{url('/ship')}}">Ships</a></li>
                    <li class="{{ (request()->is('certificate')) ? 'active' : '' }}"><a class="nav-link" href="{{url('/certificate')}}">Certificates</a></li>
                    @endguest
                </ul>
                <!-- End Left side Navbar -->

                <!-- Right Side NavBar -->
                <ul class="right-nave navbar-nav">
                    @guest
                    <li class="{{ (request()->is('login')) ? 'active' : '' }}"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Register</a></li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown"> {{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                    @endguest
                </ul>
                <!-- End Right Side Nav bar -->

            </div>
        </div>
    </nav>
    <!-- End Second Bar -->
    <!-- Content Page -->
    <div class="content-page">
        @yield('content')
    </div>
    <!-- End Content Page -->
    <!-- ===================================== -->
    <!-- ===================================== -->
    <!-- Footer -->
    <footer>
        <p class="footer-text">&copy 2020 Team AKL</p>
    </footer>
    <!-- End Fotter -->
    <!-- ===================================== -->

    <!-- JavaScript -->

    <script src="{{mix('js/app.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $(window).scroll(function(){
                if ($(this).scrollTop() > 40) {
                    $('.navbar').css('height', '70px');

                }else{
                    $('.navbar').css('height', 'auto');
                }
            });

            $("h5[data-toggle='collapse']").on("click", function() {
                $(".card-header").removeClass("bgColor");
                $(this).parent().addClass("bgColor");
            })

        });

    </script>
    @stack('scripts')
</body>
</html>
