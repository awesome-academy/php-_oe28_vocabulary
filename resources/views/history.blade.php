@extends('layouts.layout')
@section('link')
    <link rel="stylesheet" href="{{ asset('bower_components/etrain-datatables/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/etrain-datatables/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>{{ trans('tests.history') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (session('message'))
        <div class="container balance">
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        </div>
    @endif
    <div class="container balance">
        <div class="card">
            <div class="card-header">{{ trans('history.history') }}</div>
            <div class="card-body">
                <div class="container">
                    <table id="words-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">{{ trans('history.date') }}</th>
                                <th scope="col">{{ trans('history.test') }}</th>
                                <th scope="col">{{ trans('history.level') }}</th>
                                <th scope="col">{{ trans('history.score') }}</th>
                                <th scope="col">{{ trans('history.options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tests as $test)
                                <tr>
                                    @if (Config::get('app.locale') == 'en')
                                        <td>
                                            {{ Carbon\Carbon::parse($test['created_at'])->format('m/d/Y') }}
                                        </td>
                                    @else
                                        <td>
                                            {{ Carbon\Carbon::parse($test['created_at'])->format('d/m/Y') }}
                                        </td>
                                    @endif
                                    <td>{{ $test['test'] }}</td>
                                    <td>{{ $test['option_level'] }}</td>
                                    <td>{{ $test['score'] }}/{{ $test['total'] }}</td>
                                    <td>
                                        <a href="{{ route('tests.edit', $test['id']) }}" class="genric-btn primary-border radius">
                                            {{ trans('history.details') }}
                                        </a>
                                        <a href="" class="genric-btn danger-border radius" data-toggle="modal" data-target="#exampleModalCenter{{ $test['id'] }}">
                                            {{ trans('history.delete') }}
                                        </a>
                                        <form action="{{ route('tests.destroy', $test['id']) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal fade" id="exampleModalCenter{{ $test['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                                {{ trans('history.confirm') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ trans('history.confirm_deleting') }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> 
                                                                {{ trans('history.close') }}
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">
                                                                {{ trans('history.yes') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('bower_components/etrain-datatables/js/jquery-3.5.1.js') }}"></script>
     <script src="{{ asset('bower_components/etrain-datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/etrain-datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
