@extends('layouts.layout')
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
    <section class="contact-section section_padding">
        <div class="container">
            @if (session('message') == trans('words.add_successfully'))
                <div class="container balance">
                    <div class="alert alert-danger col-lg-8" role="alert">{{ session('message') }}</div>
                </div>
            @endif
            @if (session('message') == trans('words.err_types'))
                <div class="container balance">
                    <div class="alert alert-danger col-lg-8" role="alert">{{ session('message') }}</div>
                </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">{{ trans('words.new_word') }}</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="{{ route('words.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="word" type="text" 
                                    placeholder="{{ trans('words.enter_word') }}" required pattern=".*[^ ].*">
                                </div>
                            </div>
                        </div>
                        <div class="row block">
                            <div class="col-7">
                                <div class="form-group">
                                    <input class="form-control" name="meanings[]" id="name" type="text"
                                    placeholder="{{ trans('words.enter_meaning') }}" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <select name="types[]" class="form-control" required>
                                        <option selected disabled value=''>
                                            {{ trans('words.choose_type') }}
                                        </option>
                                        <option>{{ trans('words.noun') }}</option>
                                        <option>{{ trans('words.pronoun') }}</option>
                                        <option>{{ trans('words.adjective') }}</option>
                                        <option>{{ trans('words.verb') }}</option>
                                        <option>{{ trans('words.adverb') }}</option>
                                        <option>{{ trans('words.preposition') }}</option>
                                        <option>{{ trans('words.conjunction') }}</option>
                                        <option>{{ trans('words.determiner') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <a class="genric-btn danger-border large radius delete-btn" hidden>
                                        {{ trans('words.delete') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <a class="genric-btn info-border large radius" id="add-btn">
                                        {{ trans('words.more') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="note" type="text"
                                    placeholder="{{ trans('words.enter_note') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm btn_1">
                                {{ trans('words.add_word') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
