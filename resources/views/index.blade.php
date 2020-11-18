@extends('layouts.layout')

@section('content')

<section class="banner_part">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-xl-6">
                <div class="banner_text">
                    <div class="banner_text_iner">
                        <h5>{{ trans('home.every') }}</h5>
                        <h1>{{ trans('home.making') }}</h1>
                        <p>{{ trans('home.rep') }}</p>
                        <a href="" class="btn_1">{{ trans('home.view') }}</a>
                        <a href="" class="btn_2">{{ trans('home.get') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature_part">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xl-3 align-self-center">
                <div class="single_feature_text ">
                    <h2>{{ trans('home.awesome') }}<br>{{ trans('home.feature') }}</h2>
                    <p>{{ trans('home.set_1') }}</p>
                    <a href="" class="btn_1">{{ trans('home.read') }}</a>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="single_feature">
                    <div class="single_feature_part">
                        <span class="single_feature_icon"><i class="ti-layers"></i></span>
                        <h4>{{ trans('home.better') }}</h4>
                        <p>{{ trans('home.set_2') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="single_feature">
                    <div class="single_feature_part">
                        <span class="single_feature_icon"><i class="ti-new-window"></i></span>
                        <h4>{{ trans('home.qua') }}</h4>
                        <p>{{ trans('home.set_3') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="single_feature">
                    <div class="single_feature_part single_feature_part_2">
                        <span class="single_service_icon style_icon"><i class="ti-light-bulb"></i></span>
                        <h4>{{ trans('home.job') }}</h4>
                        <p>{{ trans('home.set_4') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial_part feature_part">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-5">
                <div class="section_tittle text-center">
                    <h2>{{ trans('home.happy') }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="textimonial_iner owl-carousel">
                    <div class="testimonial_slider">
                        <div class="row">
                            <div class="col-lg-8 col-xl-4 col-sm-8 align-self-center">
                                <div class="testimonial_slider_text">
                                    <p>{{ trans('home.happy_1') }}</p>
                                    <h4>{{ trans('home.happy_2') }}</h4>
                                    <h5>{{ trans('home.happy_3') }}</h5>
                                </div>
                            </div>
                            <div class="col-lg-4 col-xl-2 col-sm-4">
                                <div class="testimonial_slider_img">
                                    <img src="{{ asset('bower_components/etrain_template/img/testimonial_img_2.png') }}" alt="#">
                                </div>
                            </div>
                            <div class="col-xl-4 d-none d-xl-block">
                                <div class="testimonial_slider_text">
                                    <p>{{ trans('home.happy_1') }}</p>
                                    <h4>{{ trans('home.happy_2') }}</h4>
                                    <h5>{{ trans('home.happy_3') }}</h5>
                                </div>
                            </div>
                            <div class="col-xl-2 d-none d-xl-block">
                                <div class="testimonial_slider_img">
                                    <img src="{{ asset('bower_components/etrain_template/img/testimonial_img_2.png') }}" alt="#">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
