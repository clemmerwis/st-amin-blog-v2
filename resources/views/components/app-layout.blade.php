<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cinzel:400,700,900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
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
    </head>
    <body>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader">
                <a href="#"><img src="img/SchmollThoughtsRoseBehindx300.png" alt="Company Logo"></a>
            </div>
        </div>

        <!-- Humberger Menu Begin -->
        <div class="humberger-menu-overlay"></div>
        <div class="humberger-menu-wrapper">
            <div class="hw-logo">
                <a href="{{ route('home') }}"><img src="img/SchmollThoughtsRoseBehindx300.png" alt=""></a>
            </div>
            <div class="hw-menu mobile-menu">
                <ul>
                    <li class="active"><a href="{{ route('home') }}">Home</a><span><img src="./img/icons/Icon1_air.png" alt=""></span></li>
                    <li><a href="#">The Magazine <i class="fa fa-angle-down"></i></a>
                        <span><img src="./img/icons/Icon2_Earth.png" alt=""></span>
                        <ul class="dropdown">
                            <li><a href="./categories-list.html">Ghost Stories</a></li>
                            <li><a href="./categories-grid.html">Art Gallery</a></li>
                            <li><a href="./typography.html">Health & Wellness</a></li>
                            <li><a href="./details-post-default.html">Magick</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Stories of Mirrors</a><span><img src="./img/icons/Icon7_YinYang.png" alt=""></span></li>
                    <li><a href="#">Marketing <i class="fa fa-angle-down"></i></a>
                        <span><img src="./img/icons/Icon4_Water.png" alt=""></span>
                        <ul class="dropdown">
                            <li><a href="#">Reviews</a></li>
                            <li><a href="#">Features</a></li>
                            <li><a href="#">Where I shop</a></li>
                            <li><a href="#">Floreography</a></li>
                            <li><a href="#">Best Of</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('contact') }}">Contact </a><span><img src="./img/icons/Icon5_Triquetra.png" alt=""></span></li>
                </ul>
            </div>
            <div id="mobile-menu-wrap"></div>
            <div class="hw-copyright">
                Copyright © 2019 Colorlib Inc. All rights reserved
            </div>
            <div class="hw-social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
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
            <div class="ht-options">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-8">
                            <div class="ht-widget">
                                <ul>
                                    <li class="signup-switch signup-open"><i class="fa fa-sign-out"></i> Login / Creat Account</li>
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
                            <a href="{{ route('home') }}"><img src="img/SchmollThoughtsRoseBehindx300.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-options">
                <div class="container">
                    <div class="humberger-menu humberger-open">
                        <i class="fa fa-bars"></i>
                    </div>
                    <div class="nav-search search-switch">
                        <i class="fa fa-search"></i>
                    </div>
                    <div class="nav-menu">
                        <ul>
                            <li class="active home spin mainitem"><a href="{{ route('home') }}"><span>Home</span></a></li>
                            <li class="mega-menu spin mainitem"><a class="the-magazine" href="#"><span>The Magazine <i class="fa fa-angle-down"></i></span></a>
                                <div class="megamenu-wrapper">
                                    <ul class="mw-nav">
                                        <li><a href="#"><span>Ghost Stories</span></a></li>
                                        <li><a href="#"><span>Art Gallery</span></a></li>
                                        <li><a href="#"><span>Health & Wellness</span></a></li>
                                        <li><a href="#"><span>Magick</span></a></li>
                                    </ul>
                                    <div class="mw-post">
                                        <div class="mw-post-item">
                                            <div class="mw-pic">
                                                <img src="img/megamenu/mm-1.jpg" alt="">
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
                                                <img src="img/megamenu/mm-2.jpg" alt="">
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
                                                <img src="img/megamenu/mm-3.jpg" alt="">
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
                                                <img src="img/megamenu/mm-4.jpg" alt="">
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
                                                <img src="img/megamenu/mm-5.jpg" alt="">
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
                                                <img src="img/megamenu/mm-1.jpg" alt="">
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
                                                <img src="img/megamenu/mm-2.jpg" alt="">
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
                                                <img src="img/megamenu/mm-3.jpg" alt="">
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
                                                <img src="img/megamenu/mm-4.jpg" alt="">
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
                                                <img src="img/megamenu/mm-5.jpg" alt="">
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
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-about">
                            <div class="fa-logo">
                                <a href="{{ route('home') }}"><img src="img/SchmollThoughtsRoseBehindx300.png" alt=""></a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua lacus vel facilisis.</p>
                            <div class="fa-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="editor-choice">
                            <div class="section-title">
                                <h5>About Me</h5>
                            </div>
                            <div class="ec-item">
                                <div class="ec-text">
                                    <img src="img/trending/editor-1.jpg" alt="">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua lacus vel facilisis.</p>

                                    <p>Hendrerit gravida rutrum quisque non. Id donec ultrices tincidunt arcu non sodales neque sodales ut. Turpis cursus in hac habitasse platea dictumst.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="tags-cloud">
                            <div class="section-title">
                                <h5>Tags Cloud</h5>
                            </div>
                            <div class="tag-list">
                                <a href="#"><span>Gaming</span></a>
                                <a href="#"><span>Platform</span></a>
                                <a href="#"><span>Playstation</span></a>
                                <a href="#"><span>Hardware</span></a>
                                <a href="#"><span>Reviews</span></a>
                                <a href="#"><span>Simulation</span></a>
                                <a href="#"><span>Strategy</span></a>
                                <a href="#"><span>Scientific</span></a>
                                <a href="#"><span>References</span></a>
                                <a href="#"><span>Role-playing</span></a>
                                <a href="#"><span>Adventurea</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright-area">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="ca-text">
                                <p>
                                    Copyright &copy;
                                    <script>document.write(new Date().getFullYear());</script>
                                    All rights reserved | This template is made with
                                    <i class="fa fa-heart" aria-hidden="true"></i> by
                                    <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="ca-links">
                                <a href="#">About</a>
                                <a href="#">Subscribe</a>
                                <a href="#">Contact</a>
                                <a href="#">Support</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->

        <!-- Sign Up Section Begin -->
        <div class="signup-section">
            <div class="signup-close"><i class="fa fa-close"></i></div>
            <div class="signup-text">
                <div class="container">
                    <div class="signup-title">
                        <h2>Sign up</h2>
                        <p>Fill out the form below to recieve a free and confidential</p>
                    </div>
                    <form action="#" class="signup-form">
                        <div class="sf-input-list">
                            <input type="text" class="input-value" placeholder="User Name*">
                            <input type="text" class="input-value" placeholder="Password">
                            <input type="text" class="input-value" placeholder="Confirm Password">
                            <input type="text" class="input-value" placeholder="Email Address">
                            <input type="text" class="input-value" placeholder="Full Name">
                        </div>
                        <div class="radio-check">
                            <label for="rc-agree">I agree with the term & conditions
                                <input type="checkbox" id="rc-agree">
                                <span class="checkbox"></span>
                            </label>
                        </div>
                        <button type="submit"><span>REGISTER NOW</span></button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign Up Section End -->

        <!-- Search model Begin -->
        <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">+</div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div>
        <!-- Search model end -->

        <!-- Js Plugins -->
        <script src="{{ 'js/jquery-3.3.1.min.js' }}"></script>
        <script src="{{ 'js/bootstrap.min.js' }}"></script>
        <script src="{{ 'js/jquery.magnific-popup.min.js' }}"></script>
        <script src="{{ 'js/circle-progress.min.js' }}"></script>
        <script src="{{ 'js/jquery.barfiller.js' }}"></script>
        <script src="{{ 'js/jquery.slicknav.js' }}"></script>
        <script src="{{ 'js/owl.carousel.min.js' }}"></script>
        <script src="{{ 'js/main.js' }}"></script>
    </body>
</html>
