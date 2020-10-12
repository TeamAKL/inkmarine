<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <title>{{ config('app.name', 'INK Marine Co.,Ltd.') }}</title>
    <style>
       .left-nave,.right-nave a{
                color: #000000;
                font-weight: 600;
                text-decoration: none;
                text-transform: uppercase;
            }
        .content-page{
            margin: 50px 0 0 15%;
            text-align:center;
            /* background-image:url('images/ship1.jpg');
            background-size:cover; */

        }
        .module-title .title{
            margin-bottom: 50px;
            font-size:42px;
            color:#52b4e8;
        }
    
        .module-content p{
            font-size:20px;
            text-align:left;
            margin-left:45px;
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
    <nav>
        <div class="container">
            <div class="nav-container">
                <!-- Left Side NavBar -->
                <ul class="left-nave">
                    @guest
                    <li><a href="{{ url('/') }}">Home</a></li>
                    @else
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{url('/employer/create')}}">Create</a></li>
                    <li><a href="{{url('/company')}}">Companies</a></li>
                    <li><a href="{{url('/ship')}}">Ships</a></li>
                    <li><a href="{{url('/certificate')}}">Certificates</a></li>
                    @endguest
                </ul>
                <!-- End Left side Navbar -->

                <!-- Right Side NavBar -->
                <ul class="right-nave">
                    @guest
                    <li><a href="{{route('login')}}">Login</a></li>
                    <!-- <li><a href="{{route('register')}}">Register</a></li>  -->
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
            
        </div>
    </div>
</nav>

<div class="container content-page">
        <div class="module-title">
           <h2 class="title"><span>INK Marine Co.,Ltd. Crew Management Database System</span></h2>			
        </div>
        <div class="module-content">
            <div class="custom">
                <p>No.176/178, 2<sup>nd</sup> Floor, Botahtaung Pagoda Road (Middle Block), Botahtaung Township, Yangon, Myanmar.</p>
                <p>Email :info@inkmarinemyanmar.com, crewing@inkmarinemyanmar.com, ops@unimarineshipping.com </p>
                <p>Website : www.inkmarinemyanmar.com</p>
                <p>Skype : +959-259255539</p>
                <p>Office Tel : <!--+959-43040201,+951-299181+959-43183687-->+951 299 181, +959 430 40 201, +959 957 543 326</p>
                <p>HP : +959-259255539</p>
            </div>
        </div>
</div>
<!-- End Content Page -->

<!-- Footer -->
<footer>
    <p class="footer-text">&copy 2020 Team AKL</p>
</footer>



<!-- JavaScript -->
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>

    



<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    INK Marine
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html> -->
