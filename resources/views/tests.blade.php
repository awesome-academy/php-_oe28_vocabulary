@extends('layouts.layout')
@section('link')
    <link href="{{ asset('bower_components/multiple-selecting/multiple-select.min.css') }}" rel="stylesheet">
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
            <div class="card-header">{{ trans('tests.create') }}</div>
            <div class="card-body">
                <div class="container">
                    <form action="{{ route('tests.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="inputAddress">{{ trans('tests.name') }}</label>
                            <input type="text" class="form-control" id="inputAddress" name="test" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-3">
                                <label for="">{{ trans('tests.choose_level') }}</label>
                                <select id="" class="form-control" name="level" required>
                                    <option selected disabled value="">{{ trans('tests.default') }}</option>
                                    <option>{{ trans('tests.level_1') }}</option>
                                    <option>{{ trans('tests.level_2') }}</option>
                                    <option>{{ trans('tests.level_3') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">{{ trans('tests.total_words') }}</label>
                                <select id="" class="form-control" name="total" required>
                                    <option selected disabled value="">{{ trans('tests.default') }}</option>
                                    <option>{{ trans('tests.total_1') }}</option>
                                    <option>{{ trans('tests.total_2') }}</option>
                                    <option>{{ trans('tests.total_3') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">{{ trans('tests.word_types') }}</label>
                                <select multiple="multiple" class="multiple-select" name="types[]" required>
                                    @foreach ($types as $type)
                                        <option>
                                            @if (Config::get('app.locale') == 'en')
                                                {{ config("config.$type->type_id") }}
                                            @else 
                                                {{ config("config_vi.$type->type_id") }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-3">
                                <label for="">{{ trans('tests.date') }}</label>
                                <select multiple="multiple" class="multiple-select" name="dates[]" required>
                                    @foreach ($dates as $date)
                                        @if (Config::get('app.locale') == 'vi')
                                            <option>
                                                {{ Carbon\Carbon::parse($date['created_at'])->format('d/m/Y') }} 
                                            </option>
                                        @else
                                            <option>
                                                {{ Carbon\Carbon::parse($date['created_at'])->format('m/d/Y') }} 
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="button button-contactForm btn_1">
                            {{ trans('tests.start') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('bower_components/multiple-selecting/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/multiple-selecting/multiple-select.min.js') }}"></script>
    <script src="{{ asset('bower_components/multiple-selecting/multipleSelect.js') }}"></script>
@endsection
