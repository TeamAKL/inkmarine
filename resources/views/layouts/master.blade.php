<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <!-- =========================================== -->
    <!-- Main Header -->
    <header>
        <div class="container">
            <h3 class="logo">Ink Marine</h3>
        </div>
    </header>
    <!-- End Main Header -->
    <!-- =========================================== -->
    <!-- =========================================== -->
    <!-- Second Nav Bar -->
    <nav>
        <div class="container">
            <div class="nav-container">
                <!-- Left Side NavBar -->
                <!-- ========================== -->
                <ul class="left-nave">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{url('/employer/create')}}">Create</a></li>
                </ul>
                <!-- End Left side Navbar -->
                <!-- =================================== -->

                <!-- Right Side NavBar -->
                <!-- ================================== -->
                <ul class="right-nave">
                    @guest
                    <li><a href="{{route('login')}}">Login</a></li>
                    <li><a href="{{route('register')}}">Register</a></li>
                    @else
                    <li>
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
                </li>
                @endguest
            </ul>
            <!-- End Right Side Nav bar -->
            <!-- ================================== -->
        </div>
    </div>
</nav>
<!-- End Second Bar -->
<!-- ====================================== -->
<!-- ====================================== -->
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
<!-- ========================================= -->
<script src="{{mix("js/app.js")}}"></script>
</body>
</html>
