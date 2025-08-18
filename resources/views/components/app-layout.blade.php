<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="icon" href="{{ asset('/img/hero/owlx400.png') }}" type="image/x-icon">

        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @isset($active)
            @if($active == 'home')
                <x-meta-tags
                    title="Stories of Mirrors - Home"
                    description="Discover Stories of Mirrors, a captivating blend of a book and a magazine, offering a unique collection of reflective narratives, insightful articles, and visual storytelling. Immerse yourself in thought-provoking stories that mirror the complexities of life, culture, and self-discovery. Explore our pages for a rich reading experience that combines the depth of a book with the dynamic format of a magazine. Whether you’re a literature enthusiast or seeking inspiration, Stories of Mirrors is your gateway to profound insights and engaging content."
                    author="schmollthoughts.com"
                    keywords="stories of mirrors book, witchcraft, supernatural, ghost stories"

                    ogTitle="Stories of Mirrors - Home"
                    ogDescription="Discover Stories of Mirrors, a captivating blend of a book and a magazine, offering a unique collection of reflective narratives, insightful articles, and visual storytelling. Immerse yourself in thought-provoking stories that mirror the complexities of life, culture, and self-discovery. Explore our pages for a rich reading experience that combines the depth of a book with the dynamic format of a magazine. Whether you’re a literature enthusiast or seeking inspiration, Stories of Mirrors is your gateway to profound insights and engaging content."
                    ogUrl="{{ url('/') }}"
                    ogImage="{{ asset('img/stories-of-mirrors/ssGirlHouseLogo.jpg') }}"
                    ogType="website"
                   
                    twitterTitle="Stories of Mirrors | Author: Erica Schmoll"
                    twitterDescription="Discover Stories of Mirrors, a captivating blend of a book and a magazine, offering a unique collection of reflective narratives, insightful articles, and visual storytelling. Immerse yourself in thought-provoking stories that mirror the complexities of life, culture, and self-discovery. Explore our pages for a rich reading experience that combines the depth of a book with the dynamic format of a magazine. Whether you’re a literature enthusiast or seeking inspiration, Stories of Mirrors is your gateway to profound insights and engaging content."
                    twitterImage="{{ asset('img/stories-of-mirrors/ssGirlHouseLogo.jpg') }}"
                />
            @elseif($active == 'SoM')
                <x-meta-tags
                    title="Stories of Mirrors - All Chapters"
                    description="Read Stories of Mirrors - Chapter Selection"
                    author="schmollthoughts.com"
                    keywords="stories of mirrors book, witchcraft, supernatural, ghost stories"

                    ogTitle="Stories of Mirrors - All Chapters"
                    ogDescription="Read Stories of Mirrors - Chapter Selection"
                    ogUrl="{{ url('/posts?category=stories-of-mirrors') }}"
                    ogImage="{{ asset('img/stories-of-mirrors/ssGirlHouseLogo.jpg') }}"
                    ogType="website"
                 
                    twitterTitle="Stories of Mirrors | Author: Erica Schmoll"
                    twitterDescription="Read Stories of Mirrors"
                    twitterImage="{{ asset('img/stories-of-mirrors/ssGirlHouseLogo.jpg') }}"
                />
            @elseif($active == 'magazine')
                <x-meta-tags
                    title="Stories of Mirrors | Witch Magazine of Wellness & Healing"
                    description="Explore the latest edition of Stories of Mirrors Magazine"
                    author="schmollthoughts.com"
                    keywords="stories of mirrors magazine, witchcraft, supernatural, ghost stories, healing & wellness"

                    ogTitle="Stories of Mirrors | Witch Magazine of Wellness & Healing"
                    ogDescription="Explore the latest edition of Stories of Mirrors Magazine"
                    ogUrl="{{ url('/posts') }}"
                    ogImage="{{ asset('img/stories-of-mirrors/ssGirlHouseLogo.jpg') }}"
                    ogType="website"

                    twitterTitle="Stories of Mirrors | Witch Magazine of Wellness & Healing"
                    twitterDescription="Explore the latest edition of Stories of Mirrors Magazine"
                    twitterImage="{{ asset('img/stories-of-mirrors/ssGirlHouseLogo.jpg') }}"
                />
            @endif
        @else
            @stack('seoMeta')
        @endisset

        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
        <div class="humberger-menu-wrapper">
            <div class="hw-logo">
                <a href="{{ route('home') }}"><img src="{{ asset('/img/logos/schmoll-thoughts-rose-behind-x300.png') }}" alt=""></a>
            </div>
            <div class="hw-menu mobile-menu">
                <ul>
                    <li class="active"><a href="{{ route('home') }}">Home</a><span><img src="{{ asset('img/icons/icon1-air.png') }}" alt=""></span></li>
                    <li><a href="{{ route('posts.index', ['category' => 'stories-of-mirrors']) }}">Stories of Mirrors</a><span><img src="{{ asset('img/icons/icon7-yinyang.png') }}" alt=""></span></li>
                    @include('partials.nav-mobile-magazine')
                    <li><a href="{{ route('author') }}">The Author</a><span><img src="{{ asset('img/icons/icon5-triquetra.png') }}" alt=""></span></li>
                    <li><a href="{{ route('posts.featured') }}">Witch's Picks</a><span><img src="{{ asset('img/icons/icon6-ankh.png') }}" alt=""></span></li>
                    <li><a href="{{ route('contact') }}">Contact</a><span><img src="{{ asset('img/icons/icon4-water.png') }}" alt=""></span></li>
                </ul>
            </div>
            <div id="mobile-menu-wrap"></div>
            <div class="hw-copyright">
                Copyright &copy;
                <script>document.write(new Date().getFullYear());</script>
                All Rights Reserved |
                <a class="about-page-link" href="{{ route('author') }}">Schmoll Thoughts Productions</a>
            </div>
            <div class="hw-social">
                <a href="https://www.facebook.com/stories.of.mirrors/" target="_blank" aria-label="Share on Facebook" rel="noopener noreferrer" class="px-2 py-1">
                    <i class="fa fa-facebook"></i>
                    <span class="sr-only">Facebook</span>
                </a>
                <a href="https://www.instagram.com/storiesofmirrors/" target="_blank" aria-label="Visit our Instagram" rel="noopener noreferrer" class="px-2 py-1">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    <span class="sr-only">Instagram</span>
                </a>
                <a href="https://x.com/SchmollThoughts" target="_blank" aria-label="Follow us on X (formerly Twitter)" rel="noopener noreferrer" class="px-2 py-1">
                    <i class="fa fa-twitter"></i>
                    <span class="sr-only">X</span>
                </a>
                <a href="mailto:erica@storiesofmirrors.com" class="px-2 py-1">
                    <i class="fa fa-envelope-o"></i>
                </a>
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
                                    @auth
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
                                    @endauth
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-4">
                            <div class="ht-social">
                                <h6 style="display: inline-block; color: white;" class="mr-4">Follow Us: </h6>
                                <a href="https://www.facebook.com/stories.of.mirrors/" target="_blank" aria-label="Share on Facebook" rel="noopener noreferrer" class="px-2 py-1">
                                    <i class="fa fa-facebook"></i>
                                    <span class="sr-only">Facebook</span>
                                </a>
                                <a href="https://www.instagram.com/storiesofmirrors/" target="_blank" aria-label="Visit our Instagram" rel="noopener noreferrer" class="px-2 py-1">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                    <span class="sr-only">Instagram</span>
                                </a>
                                <a href="https://x.com/SchmollThoughts" target="_blank" aria-label="Follow us on X (formerly Twitter)" rel="noopener noreferrer" class="px-2 py-1">
                                    <i class="fa fa-twitter"></i>
                                    <span class="sr-only">X</span>
                                </a>
                                <a href="mailto:erica@storiesofmirrors.com" class="px-2 py-1">
                                    <i class="fa fa-envelope-o"></i>
                                </a>
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
                        <ul>
                            <li class="{{ request()->routeIs('home') ? 'active' : '' }} home spin mainitem">
                                <a href="{{ route('home') }}"><span>Home</span></a>
                            </li>
                            <li class="{{ request()->is('posts*') && request()->get('category') === 'stories-of-mirrors' ? 'active' : '' }} stories-of-mirrors spin mainitem">
                                <a href="{{ route('posts.index', ['category' => 'stories-of-mirrors']) }}"><span>Stories of Mirrors</span></a>
                            </li>
                            @include('partials.nav-magazine')
                            <li class="{{ request()->routeIs('author') ? 'active' : '' }} contact spin mainitem">
                                <a href="{{ route('author') }}"><span>The Author</span></a>
                            </li>
                            <li class="{{ request()->routeIs('posts.featured') ? 'active' : '' }} witchs-picks mainitem">
                                <a href="{{ route('posts.featured') }}"><span>Witch's Picks</span></a>
                            </li>
                            <li class="{{ request()->routeIs('contact') ? 'active' : '' }} spin mainitem">
                                <a class="marketing" href="{{ route('contact') }}"><span>Contact</span></a>
                            </li>
                        </ul>
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
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="footer-about">
                            <div class="fa-logo">
                                <a href="{{ route('author') }}"><img src="/img/logos/schmoll-thoughts-rose-behind-x300.png" alt=""></a>
                            </div>
                            <div class="d-flex justify-content-center fa-social fa-social">
                                <a href="https://www.facebook.com/stories.of.mirrors/" target="_blank" aria-label="Share on Facebook" rel="noopener noreferrer" class="px-2">
                                    <i class="fa fa-facebook"></i>
                                    <span class="sr-only">Facebook</span>
                                </a>
                                <a href="https://www.instagram.com/storiesofmirrors/" target="_blank" aria-label="Visit our Instagram" rel="noopener noreferrer" class="px-2">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                    <span class="sr-only">Instagram</span>
                                </a>
                                <a href="https://x.com/SchmollThoughts" target="_blank" aria-label="Follow us on X (formerly Twitter)" rel="noopener noreferrer" class="px-2">
                                    <i class="fa fa-twitter"></i>
                                    <span class="sr-only">X</span>
                                </a>
                                <a href="mailto:erica@storiesofmirrors.com" class="px-2">
                                    <i class="fa fa-envelope-o"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-area">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-center ca-text">
                                <p>
                                    Copyright &copy;
                                    <script>document.write(new Date().getFullYear());</script>
                                    All Rights Reserved |
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
        {{-- <div class="signup-section">
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
        </div> --}}
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
