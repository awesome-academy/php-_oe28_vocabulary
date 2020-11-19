<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ trans('home.etrain') }}</title>
    <link rel="icon" href="{{ asset('bower_components/etrain_template/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain_template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain_template/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain_template/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain_template/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain_template/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain_template/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain_template/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain_template/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/components-font-awesome/css/all.css') }}">
    @yield('link')
</head>
<body>
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ asset('bower_components/etrain_template/img/logo.png') }}" 
                            alt="logo"> 
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" 
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                        aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse main-menu-item justify-content-end" 
                        id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ route('home') }}">
                                        {{ trans('home.home') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="">
                                        {{ trans('home.words') }}
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" 
                                    role="button" data-toggle="dropdown" aria-haspopup="true" 
                                    aria-expanded="false">
                                        {{ trans('home.tests') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="">
                                            {{ trans('home.your_tests') }}
                                        </a>
                                        <a class="dropdown-item" href="">
                                            {{ trans('home.history') }}
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" 
                                    role="button" data-toggle="dropdown" aria-haspopup="true" 
                                    aria-expanded="false">
                                        {{ trans('home.vers') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" 
                                        href="">
                                            {{ trans('home.vi') }}
                                        </a>
                                        <a class="dropdown-item" 
                                        href="">
                                            {{ trans('home.en') }}
                                        </a>
                                    </div>
                                </li>
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">
                                            {{ trans('auth.login') }}
                                        </a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">
                                                {{ trans('auth.register') }}
                                            </a>
                                        </li>
                                    @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" 
                                            role="button" data-toggle="dropdown" aria-haspopup="true" 
                                            aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" 
                                            aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" 
                                                href="{{ route('users.edit', Auth::id()) }}">
                                                    {{ trans('profile.profile') }}
                                                </a>
                                                <a class="dropdown-item logout" href="javascript:void(0)">
                                                    {{ trans('auth.logout') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" 
                                                method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                @endguest
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    @yield('content')
    <footer class="footer-area">
        <div class="container feature_part">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="single-footer-widget footer_1">
                        <a href=""> 
                            <img src="{{ asset('bower_components/etrain_template/img/logo.png') }}" alt=""> 
                        </a>
                        <p>{{ trans('home.but_1') }}</p>
                        <p>{{ trans('home.but_2') }}</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-4">
                    <div class="single-footer-widget footer_2">
                        <h4>{{ trans('home.new') }}</h4>
                        <p>{{ trans('home.stay') }}</p>
                        <form action="#">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder='Enter email address'>
                                    <div class="input-group-append">
                                        <button class="btn btn_1" type="button">
                                            <i class="ti-angle-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="social_icon">
                            <a href=""><i class="ti-facebook"></i></a>
                            <a href=""><i class="ti-twitter-alt"></i></a>
                            <a href=""><i class="ti-instagram"></i></a>
                            <a href=""><i class="ti-skype"></i></a>
                        </div>
                    </div>
                </div> 
                <div class="col-xl-3 col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_2">
                        <h4>{{ trans('home.contact') }}</h4>
                        <div class="contact_info">
                            <p><span>{{ trans('home.addr') }}</span>{{ trans('home.hath') }}</p>
                            <p><span>{{ trans('home.phone') }}</span>{{ trans('home.number') }}</p>
                            <p><span>{{ trans('home.email_title') }}</span>{{ trans('home.email') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('bower_components/etrain_template/js/jquery-1.12.1.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain_template/js/popper.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain_template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain_template/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('bower_components/etrain_template/js/swiper.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain_template/js/masonry.pkgd.js') }}"></script>
    <script src="{{ asset('bower_components/etrain_template/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain_template/js/slick.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain_template/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain_template/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain_template/js/custom.js') }}"></script>
    <script src="{{ asset('js/logout.js') }}"></script>
    <script src="{{ asset('js/add_input.js') }}"></script>
    <script src="{{ asset('js/speech.js') }}"></script>
    @yield('script')
</body>
</html>
