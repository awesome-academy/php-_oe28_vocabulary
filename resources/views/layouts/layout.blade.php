<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Etrain</title>
    <link rel="icon" href="{{ asset('bower_components/etrain-template/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain-template/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain-template/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain-template/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain-template/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain-template/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain-template/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain-template/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain-template/css/style.css') }}">
</head>

<body>
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href=""> <img src="{{ asset('bower_components/etrain-template/img/logo.png') }}" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse main-menu-item justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="">{{ trans('home.home') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="">{{ trans('home.words') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="">{{ trans('home.tests') }}</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ trans('home.vers') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="">{{ trans('home.vi') }}</a>
                                        <a class="dropdown-item" href="">{{ trans('home.en') }}</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ trans('home.settings') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="">{{ trans('home.profile') }}</a>
                                        <a class="dropdown-item" href="">{{ trans('home.logout') }}</a>
                                    </div>
                                </li>
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
                        <a href=""> <img src="{{ asset('bower_components/etrain-template/img/logo.png') }}" alt=""> </a>
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
                                    <input type="text" class="form-control" placeholder='Enter email address' onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'">
                                    <div class="input-group-append">
                                        <button class="btn btn_1" type="button"><i class="ti-angle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="social_icon">
                            <a href=""> <i class="ti-facebook"></i> </a>
                            <a href=""> <i class="ti-twitter-alt"></i> </a>
                            <a href=""> <i class="ti-instagram"></i> </a>
                            <a href=""> <i class="ti-skype"></i> </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_2">
                        <h4>{{ trans('home.contact') }}</h4>
                        <div class="contact_info">
                            <p><span>{{ trans('home.addr') }}</span> {{ trans('home.hath') }}</p>
                            <p><span>{{ trans('home.phone') }}</span> {{ trans('home.number') }}</p>
                            <p><span>{{ trans('home.email_title') }}</span> {{ trans('home.email') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('bower_components/etrain-template/js/jquery-1.12.1.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-template/js/popper.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-template/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-template/js/swiper.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-template/js/masonry.pkgd.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-template/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-template/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-template/js/slick.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-template/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-template/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-template/js/custom.js') }}"></script>
</body>

</html>
