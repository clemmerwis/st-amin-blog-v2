<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="icon" href="{{ asset('/img/hero/owlx400.png') }}" type="image/x-icon">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cinzel:400,700,900&display=swap" rel="stylesheet">

        <!-- App Styles -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/barfiller.css') }}">
        <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/rockville.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>
            .page-item.active {
                border-bottom: 2px solid;
            }
        </style>
    </head>
    <body>
        <!-- Page Preloder -->
        {{-- <div id="preloder">
            <div class="loader">
                <a href="#"><img src="img/logos/schmoll-thoughts-rose-behind-x300.png" alt="Company Logo"></a>
            </div>
        </div> --}}

        <!-- Humberger Menu Begin -->
        <div class="humberger-menu-overlay"></div>
        {{-- @include('partials.nav-mobil-magazine') --}}
        <div class="humberger-menu-wrapper">
            <div class="hw-logo">
                <a href="{{ route('home') }}"><img src="{{ asset('/img/logos/schmoll-thoughts-rose-behind-x300.png') }}" alt=""></a>
            </div>
            <div class="hw-menu mobile-menu">
                <ul>
                    <li class="active"><a href="{{ route('home') }}">Home</a><span><img src="{{ asset('img/icons/icon1-air.png') }}" alt=""></span></li>
                    <li><a href="#">Stories of Mirrors</a><span><img src="{{ asset('img/icons/icon7-yinyang.png') }}" alt=""></span></li>
                    <li><a href="{{ route('author') }}">The Author</a><span><img src="{{ asset('img/icons/icon5-triquetra.png') }}" alt=""></span></li>
                    <li><a href="{{ route('contact') }}">contact</a><span><img src="{{ asset('img/icons/icon4-water.png') }}" alt=""></span></li>
                </ul>
            </div>
            <div id="mobile-menu-wrap"></div>
            <div class="hw-copyright">
                Copyright © 2019 Colorlib Inc. All rights reserved
            </div>
            <div class="hw-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-youtube-play"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </div>
            <div class="hw-insta-media">
                <div class="section-title">
                    <h5>Instagram</h5>
                </div>
                <div class="insta-pic">
                    <img src="img/instagram/ip-1.jpg" alt="">
                    <img src="img/instagram/ip-2.jpg" alt="">
                    <img src="img/instagram/ip-3.jpg" alt="">
                    <img src="img/instagram/ip-4.jpg" alt="">
                </div>
            </div>
        </div>
        <!-- Humberger Menu End -->

        <!-- Header Section Begin -->
        <header class="header-section">
            <div class="topbar ht-options">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-8">
                            <div class="ht-widget">
                                <ul>
                                    @guest
                                        <li class="signup-switch-login signup-login-open">
                                            <a class="nav-link" href="#">
                                                <i class="fa fa-sign-out ml-3"></i>Login
                                            </a>
                                        </li>
                                        <li class="signup-switch signup-open">
                                            <a class="nav-link" href="#">Create Account</a>
                                        </li>
                                    @else
                                        <li>
                                            Hello {{ auth()->user()->name }} !
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.posts.index') }}">
                                                @if (auth()->user()->is_admin == 1)
                                                    Dashboard
                                                @else
                                                    My Profile
                                                @endif
                                            </a>
                                        </li>
                                        <li>
                                            <a  href="#"
                                                onclick="event.preventDefault();
                                                document.getElementById('logoutForm').submit();">
                                                Logout<i class="fa fa-sign-out"></i>
                                            </a>
                                        </li>

                                        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    @endguest
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4">
                            <div class="ht-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-vimeo"></i></a>
                                <a href="mailto:erica@schmollthoughts.com"><i class="fa fa-envelope-o"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="logo">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a href="{{ route('home') }}"><img src="{{ asset('img/logos/schmoll-thoughts-rose-behind-x300.png') }}" alt="Logo"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="siteNav" class="nav-options">
                <div class="container">
                    <div class="humberger-menu humberger-open">
                        <i class="fa fa-bars"></i>
                    </div>
                    {{-- <div class="nav-search search-switch">
                        <i class="fa fa-search"></i>
                    </div> --}}
                    <div class="nav-menu">
                        {{-- @include('partials.nav-magazine') --}}
                        <ul>
                            <li class="active home spin mainitem"><a href="{{ route('home') }}"><span>Home</span></a></li>
                            <li class="stories-of-mirrors spin mainitem"><a href="{{ route('posts.index', ['category' => 'stories-of-mirrors']) }}"><span>Stories of Mirrors</span></a></li>
                            <li class="contact spin mainitem"><a href="{{ route('author') }}"><span>The Author</span></a></li>
                            <li class="spin mainitem"><a class="marketing" href="{{ route('contact') }}"><span>Contact</span></a></li>
                        </ul>
                        {{-- <ul>
                            <li class="active home spin mainitem"><a href="{{ route('home') }}"><span>Home</span></a></li>
                            <li class="mega-menu spin mainitem"><a class="the-magazine" href="#"><span>The Magazine <i class="fa fa-angle-down"></i></span></a>
                                <div class="megamenu-wrapper">
                                    <ul class="mw-nav">
                                        <li><a href="{{ route('posts.index') }}"><span>All Latest Articles</span></a></li>
                                        <li><a href="#"><span>Ghost Stories</span></a></li>
                                        <li><a href="#"><span>Art Gallery</span></a></li>
                                        <li><a href="#"><span>Health & Wellness</span></a></li>
                                        <li><a href="#"><span>Magick</span></a></li>
                                    </ul>
                                    <div class="mw-post">
                                        <div class="mw-post-item">
                                            <div class="mw-pic">
                                                <img src="{{ asset('img/megamenu/mm-1.jpg') }}" alt="">
                                            </div>
                                            <div class="mw-text">
                                                <h6><a href="#">A Monster Prom poster got hijacked for a Papa Roach
                                                        concert...</a></h6>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mw-post-item">
                                            <div class="mw-pic">
                                                <img src="{{ asset('img/megamenu/mm-2.jpg') }}" alt="">
                                            </div>
                                            <div class="mw-text">
                                                <h6><a href="#">A new Borderlands 3 trailer introduces Moze and her...</a>
                                                </h6>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mw-post-item">
                                            <div class="mw-pic">
                                                <img src="{{ asset('img/megamenu/mm-3.jpg') }}" alt="">
                                            </div>
                                            <div class="mw-text">
                                                <h6><a href="#">Teamfight Tactics is in chaos after today's patch...</a>
                                                </h6>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mw-post-item">
                                            <div class="mw-pic">
                                                <img src="{{ asset('img/megamenu/mm-4.jpg') }}" alt="">
                                            </div>
                                            <div class="mw-text">
                                                <h6><a href="#">Borderlands 2 dev explains why there's mysterious
                                                        boxes...</a></h6>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mw-post-item">
                                            <div class="mw-pic">
                                                <img src="{{ asset('img/megamenu/mm-5.jpg') }}" alt="">
                                            </div>
                                            <div class="mw-text">
                                                <h6><a href="#">Capcom asks select fans to test new Resident Evil game</a>
                                                </h6>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="stories-of-mirrors spin mainitem"><a href="#"><span>Stories of Mirrors</span></a></li>
                            <li class="mega-menu spin mainitem"><a class="marketing" href="#"><span>Marketing <i class="fa fa-angle-down"></i></span></a>
                                <div class="megamenu-wrapper">
                                    <ul class="mw-nav">
                                        <li><a href="#"><span>Reviews</span></a></li>
                                        <li><a href="#"><span>Features</span></a></li>
                                        <li><a href="#"><span>Where I Shop</span></a></li>
                                        <li><a href="#"><span>Floreography</span></a></li>
                                        <li><a href="#"><span>Best Of</span></a></li>
                                    </ul>
                                    <div class="mw-post">
                                        <div class="mw-post-item">
                                            <div class="mw-pic">
                                                <img src="{{ asset('img/megamenu/mm-1.jpg') }}" alt="">
                                            </div>
                                            <div class="mw-text">
                                                <h6><a href="#">A Monster Prom poster got hijacked for a Papa Roach
                                                        concert...</a></h6>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mw-post-item">
                                            <div class="mw-pic">
                                                <img src="{{ asset('img/megamenu/mm-2.jpg') }}" alt="">
                                            </div>
                                            <div class="mw-text">
                                                <h6><a href="#">A new Borderlands 3 trailer introduces Moze and her...</a>
                                                </h6>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mw-post-item">
                                            <div class="mw-pic">
                                                <img src="{{ asset('img/megamenu/mm-3.jpg') }}" alt="">
                                            </div>
                                            <div class="mw-text">
                                                <h6><a href="#">Teamfight Tactics is in chaos after today's patch...</a>
                                                </h6>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mw-post-item">
                                            <div class="mw-pic">
                                                <img src="{{ asset('img/megamenu/mm-4.jpg') }}" alt="">
                                            </div>
                                            <div class="mw-text">
                                                <h6><a href="#">Borderlands 2 dev explains why there's mysterious
                                                        boxes...</a></h6>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mw-post-item">
                                            <div class="mw-pic">
                                                <img src="{{ asset('img/megamenu/mm-5.jpg') }}" alt="">
                                            </div>
                                            <div class="mw-text">
                                                <h6><a href="#">Capcom asks select fans to test new Resident Evil game</a>
                                                </h6>
                                                <ul>
                                                    <li><i class="fa fa-clock-o"></i> Aug 01, 2019</li>
                                                    <li><i class="fa fa-comment-o"></i> 12</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="contact spin mainitem"><a href="{{ route('contact') }}"><span>Contact</span></a></li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </header>
        <!-- Header End -->

        <main>
            {{ $slot }}
        </main>

        <!-- Footer Section Begin -->
        <footer class="footer-section">
            <div class="container">
                <div class="row justify-center">
                    <div class="col-auto">
                        <div class="footer-about">
                            <div class="fa-logo">
                                <a href="{{ route('author') }}"><img src="/img/logos/schmoll-thoughts-rose-behind-x300.png" alt=""></a>
                            </div>
                            <div class="d-flex justify-center fa-social fa-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-area">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-center ca-text">
                                <p>
                                    Copyright &copy;
                                    <script>document.write(new Date().getFullYear());</script>
                                    All rights reserved |
                                    <a href="{{ route('author') }}">Schmoll Thoughts Productions</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <!-- Register Section Begin -->
        <div class="signup-section">
            <div class="signup-close"><i class="fa fa-close"></i></div>
            <div class="signup-text">
                <div class="container">
                    @if (session('register_error'))
                        <div id="failedRegisterMessage" class="alert alert-danger">
                            {{ session('register_error') }}
                        </div>
                    @endif
                    <div class="signup-title">
                        <h2>Register</h2>
                    </div>
                    <form method="POST" action="{{ route('register') }}" class="signup-form">
                        @csrf
                        <div class="sf-input-list">
                            <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                            <input name="name" type="text" class="input-value" autofocus placeholder="Enter Name" value="{{ old('name') }}">

                            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                            <input name="email" type="text" class="input-value" placeholder="Enter Email Address" value="{{ old('email') }}">

                            <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                            <input name="password" type="password" class="input-value" placeholder="Enter Password">

                            <span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
                            <input name="password_confirmation" type="password" class="input-value" placeholder="Repeat Password">
                        </div>
                        <button type="submit"><span>REGISTER NOW</span></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Register Section End -->

        <!-- Login Begin -->
        <div class="signup-section-login">
            <div class="signup-login-close"><i class="fa fa-close"></i></div>
            <div class="signup-text">
                <div class="container">
                    @if (session('login_error'))
                        <div id="failedLoginMessage" class="alert alert-danger">
                            {{ session('login_error') }}
                        </div>
                    @elseif (session('not_user'))
                        <div id="failedLoginMessage" class="alert alert-danger">
                            {{ session('not_user') }}
                        </div>
                    @elseif (session('not_admin'))
                        <div id="failedLoginMessage" class="alert alert-danger">
                            {{ session('not_admin') }}
                        </div>
                    @endif
                    <div class="signup-title">
                        <h2>Login</h2>
                    </div>
                    <form method="POST" action="{{ route('login') }}" autocomplete="off" class="login-form">
                        @csrf
                        <div class="sf-input-list">
                            <input id="userEmail" type="email" class="input-value" name="email" required autofocus placeholder="Email Address" value="{{ old('email') }}">
                            <span class="text-danger">@error('email'){{ $message }}@enderror</span>

                            <input id="userPassword" type="password" class="input-value" name="password" required data-eye placeholder="Password" value="{{ old('password') }}">
                            <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                        </div>
                        <div class="form-check mb-4">
                            <input name="remember" type="checkbox" class="form-check-input" id="remember">
                            <label for="remember" class="form-check-label text-white">Remember Me</label>
                        </div>
                        <button id="loginBtn" type="submit"><span>Login Now</span></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Login Section End -->

        <!-- Search model Begin -->
        {{-- <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">+</div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div> --}}
        <!-- Search model end -->

        <!-- Js Plugins -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('js/circle-progress.min.js') }}"></script>
        <script src="{{ asset('js/jquery.barfiller.js') }}"></script>
        <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>
