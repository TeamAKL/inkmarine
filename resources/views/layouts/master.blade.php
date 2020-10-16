<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <title>{{ config('app.name', 'INK Marine Co.,Ltd.') }}</title>
    <style>
        ul.left-nave li a,ul.right-nave li a{
            color: #000000;
            font-weight: 600;
            text-decoration: none;
            text-transform: uppercase;
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
        <div class="container">
            <div class="nav-container collapse navbar-collapse">
                <!-- Left Side NavBar -->
                <ul class="left-nave navbar-nav">
                    @guest
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/employer/create')}}">Create</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/company')}}">Companies</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/ship')}}">Ships</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{url('/certificate')}}">Certificates</a></li>
                    @endguest
                </ul>
                <!-- End Left side Navbar -->

                <!-- Right Side NavBar -->
                <ul class="right-nave navbar-nav">
                    @guest
                    <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Register</a></li> 
                    @else
                    <!-- <li>
                        <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li> -->
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
    <script>
    $(document).ready(function() {
	// jQuery code
    if ($(window).width() > 992) {
        $(window).scroll(function(){  
            if ($(this).scrollTop() > 40) {
                 $('.navbar').css('height', '70px');
                 
            }else{
                $('.navbar').css('height', 'auto');
            }   
        });
     } 
    });
   </script>
</body>
</html>
