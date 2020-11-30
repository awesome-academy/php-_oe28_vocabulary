@extends('layouts.layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>{{ trans('details.details') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container balance">
        <div class="card">
            <div class="card-header">
                {{ trans('details.test') }}:
                <b>{{ $test['test'] }}</b>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">{{ trans('details.question') }}</th>
                            <th scope="col">{{ trans('details.word') }}</th>
                            <th scope="col">{{ trans('details.type') }}</th>
                            <th scope="col">{{ trans('details.answer') }}</th>
                            <th scope="col">{{ trans('details.result') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($test['words'] as $key => $word)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $word['word'] }}</td>
                                <td>
                                    @php 
                                        $type_id = $word['pivot']['type_id'];
                                    @endphp
                                    @if (Config::get('app.locale') == 'en')
                                        {{ config("config.$type_id") }}
                                    @else
                                        {{ config("config_vi.$type_id") }}
                                    @endif
                                </td>
                                <td>{{ $word['pivot']['answer'] }}</td>
                                <td>{{ $word['pivot']['is_true'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
