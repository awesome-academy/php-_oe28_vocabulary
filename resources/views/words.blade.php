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
                            <h2>{{ trans('words.words') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container balance">
        <div class="card">
            <div class="card-header">{{ trans('words.new_word') }}</div>
            <div class="card-body">
                <a href="{{ route('words.create') }}" class="genric-btn info radius add-word">
                    {{ trans('words.add_word') }}
                </a>
            </div>
        </div>
    </div>
    <div class="container balance">
        <div class="card">
            <div class="card-header">{{ trans('words.import_label') }}</div>
            <div class="card-body ">
                <div class="col">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="import" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                        <input type="submit" value="{{ trans('words.import') }}">
                        <a href="" class="genric-btn info radius add-word">
                            {{ trans('words.export') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (session('message') == trans('words.delete_failed'))
        <div class="container">
            <div class="alert alert-danger" role="alert">{{ session('message') }}</div>
        </div>
    @elseif (session('message') == trans('words.check_word'))
        <div class="container">
            <div class="alert alert-warning" role="alert">{{ session('message') }}</div>
        </div>
    @elseif (session('message'))
        <div class="container">
            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
        </div>
    @endif
    <div class="container balance">
        <div class="card">
            <div class="card-header">{{ trans('words.repo') }}</div>
            <div class="card-body">
                <div class="container">
                    <table id="example" class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ trans('words.word') }}</th>
                                <th scope="col">{{ trans('words.type') }}</th>
                                <th scope="col">{{ trans('words.meaning') }}</th>
                                <th scope="col">{{ trans('words.note') }}</th>
                                <th scope="col">{{ trans('words.sound') }}</th>
                                <th scope="col">{{ trans('words.options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($words as $word)
                                @foreach ($word->types as $key => $type)
                                    <tr>
                                        <td class="word">{{ $word->word }}</td>
                                        <td>
                                            @if ( app()->getLocale() == 'en')
                                                {{ config("config.$type->id") }}
                                            @else     
                                                {{ config("config_vi.$type->id") }}
                                            @endif
                                        </td>
                                        <td>{{ $type->pivot->meaning }}</td>
                                        <td>{{ $word->note }}</td>
                                        <td>
                                            <a href="javascript:void(0)" class="speech">
                                                <i class="fas fa-volume-up"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('editWord', ['wordId' => $word->id, 'typeId' => $type->pivot->type_id]) }}" class="genric-btn success-border radius">
                                                {{ trans('words.edit') }}
                                            </a>
                                            <a href="" class="genric-btn danger-border radius" data-toggle="modal" data-target="#exampleModalCenter{{ $word->id }}{{ $type->pivot->type_id }}">
                                                {{ trans('words.delete') }}
                                            </a>
                                            <form action="{{ route('deleteWord', ['wordId' => $word->id, 'typeId' => $type->pivot->type_id]) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <div class="modal fade" id="exampleModalCenter{{ $word->id }}{{ $type->pivot->type_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                                    {{ trans('words.confirm') }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{ trans('words.confirm_deleting') }}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> 
                                                                    {{ trans('words.close') }}
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ trans('words.yes') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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
    <script src="{{ asset('bower_components/datatables-rowsgroup/datatables.rowsgroup.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
@endsection
