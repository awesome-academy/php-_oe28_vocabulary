@extends('layouts.layout')

@section('link')
<link rel="stylesheet" href="{{ asset('bower_components/components-font-awesome/css/all.css') }}">
@endsection

@section('content')
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner text-center">
                    <div class="breadcrumb_iner_item">
                        <h2>{{ trans('profile.profile') }}</h2>
                        <p>{{ trans('home.home') }}<span>/</span>{{ trans('profile.profile') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<a href="{{ route('words.create') }}" class="btn_1">New word</a>
<table class="table table-hover mytable">
    <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Word</th>
            <th scope="col">Type</th>
            <th scope="col">Meaning</th>
            <th scope="col">Note</th>
            <th scope="col">Sound</th>
            <th scope="col">Options</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($words as $index => $word)
        <tr>
            <th>{{ $words->firstItem() + $index }}</th>
            <td class='word'>{{ $word->word }}</td>
            <td>{{ $word->types }}</td>
            <td>{{ $word->meaning }}</td>
            <td>{{ $word->note }}</td>
            <td>
                <a href="#" class="speech"><i class="fas fa-volume-up"></i></a>
            </td>
            <td>
                <a href="{{ route('words.edit', $word->id) }}" class="genric-btn info-border radius">Edit</a>
                <a href="" class="genric-btn danger-border radius" data-toggle="modal" data-target="#exampleModalCenter">Delete</a>
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">
                                    {{ trans('confirm') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ trans('confirm_deleting') }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('close') }}</button>
                                <form action="{{ route('words.destroy', $word->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('yes') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
{{ $words->links() }}
@endsection

@section('script')
<script src="{{ asset('js/speech.js') }}"></script>
@endsection