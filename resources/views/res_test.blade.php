@extends('layouts.layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>{{ trans('tests.tests') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="advance_feature learning_part">
        <div class="container">
            <div class="row align-items-sm-center align-items-xl-stretch">
                <div class="col-md-6 col-lg-6">
                    <div class="learning_member_text">
                        <h5>
                            {{ trans('tests.res') }} 
                            <b>"{{ $name }}"</b>
                        </h5>
                        <h2>{{ trans('tests.score')}} {{ $score }}/{{ $total }}</h2>
                        <div class="row">
                            <div class="col-sm-6 col-md-12 col-lg-6">
                                <div class="learning_member_text_iner">
                                    <a href="{{ route('tests.index') }}">
                                        <span class="ti-pencil-alt"></span>
                                    </a>
                                    <h4>{{ trans('tests.history') }}</h4>
                                    <p>{{ trans('tests.lorem') }}</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-12 col-lg-6">
                                <div class="learning_member_text_iner">
                                    <a href="{{ route('tests.create') }}"><span class="ti-stamp"></span></a>
                                    <h4>{{ trans('tests.new') }}</h4>
                                    <p>{{ trans('tests.lorem') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="learning_img">
                        <img src="{{ asset('bower_components/etrain_template/img/advance_feature_img.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
