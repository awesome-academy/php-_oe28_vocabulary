@extends('layouts.layout')
@section('link')
    <link href="{{ asset('bower_components/otp-inputs/tailwind.min.css') }}" rel="stylesheet">
@endsection
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
    <div class="container balance">
        <div class="card">
            <h5 class="card-header text-center test-timeout" data-test-timeout="{{ $test['timeout'] }}">
                {{ trans('tests.tests') }}: 
                <b>{{ $test['test'] }}</b>
            </h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-10"></div>
                    <div class="col-sm-2">
                        <b id="demo" class="text-center countdown"></b>
                    </div>
                </div>
                <form action="{{ route('tests.update', $test['id']) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @foreach ($test['words'] as $key => $word)
                            <div class="col-sm-5 bottom-distance">
                                <div class="card">
                                    <div class="card-header">
                                        {{ trans('tests.question') }} {{ $key + 1 }}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ trans('tests.require') }}</h5>
                                        <h5 class="card-title">{{ trans('tests.hint') }}</h5>
                                        <input type="text" name="keys[]" hidden value="{{ $word['word'] }}" class="word">
                                        <input type="text" name="wordIds[]" hidden value="{{ $word['id'] }}">
                                        <input type="text" name="typeIds[]" hidden value="{{ $word['pivot']['type_id'] }}">
                                        @if ($test['option_level'] != 3)
                                            <p class="card-text">
                                                {{ trans('tests.type') }}
                                                @php
                                                    $typeId = $word['pivot']['type_id'];
                                                @endphp
                                                @if (Config::get('app.locale') == 'en')
                                                    {{ config("config.$typeId") }}
                                                @else
                                                    {{ config("config_vi.$typeId") }}
                                                @endif
                                            </p>
                                            @foreach ($word['types'] as $type)
                                                @if ($typeId == $type['id'])
                                                    <p class="card-text">
                                                        {{ trans('tests.meaning') }}
                                                        {{ $type['pivot']['meaning'] }}
                                                    </p>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if ($test['option_level'] != 2)
                                            <p class="card-text">
                                                {{ trans('tests.pronunciation') }}
                                                <a href="javascript:void(0)" class="read">
                                                    <i class="fas fa-volume-up"></i>
                                                </a>
                                            </p>
                                        @endif
                                        <br>
                                        <h5 class="card-title">{{ trans('tests.answer') }}</h5>
                                        <div class="mb-6 text-center">
                                            <div id="otp" class="flex justify-center ">
                                                @for ($index = 0; $index < strlen($word['word']); $index++) 
                                                    <input name="answers[{{ $key }}][{{ $index }}]" class="input-otp m-2 text-center form-control form-control-solid rounded focus:border-blue-400 focus:shadow-outline " type="text" maxlength="1" tabindex="{{ $index + 1 }}">
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <button type="submit" class="button btn_1 button-contactForm" id="myCheck">
                            {{ trans('tests.submit') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/read.js') }}"></script>
    <script src="{{ asset('js/countdown.js') }}"></script>
    <script src="{{ asset('bower_components/otp-inputs/otp-inputs.js') }}"></script>
@endsection
