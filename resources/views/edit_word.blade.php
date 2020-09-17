@extends('layouts.layout')

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

<section class="contact-section section_padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="contact-title">{{ trans('Edit Word') }}</h2>
            </div>
            <div class="col-lg-8">
                <form class="form-contact contact_form" action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="word" type="text" placeholder="{{ trans('word.enter_word') }}" value="{{ $word->word }}" required />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <select name="type" class="form-control" required>
                                   
                                    <option value="" selected disabled>{{ trans('word.choose_type') }}</option>
                                    <option>{{ trans('word.noun') }}</option>
                                    <option>{{ trans('word.pronoun') }}</option>
                                    <option>{{ trans('word.adjective') }}</option>
                                    <option>{{ trans('word.verb') }}</option>
                                    <option>{{ trans('word.adverb') }}</option>
                                    <option>{{ trans('word.preposition') }}</option>
                                    <option>{{ trans('word.conjunction') }}</option>
                                    <option>{{ trans('word.determiner') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input class="form-control" name="meaning" type="text" placeholder="{{ trans('word.enter_meaning') }}" value="{{ $word->meaning }}" required />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control w-100" name="note" cols="30" rows="9" placeholder="{{ trans('word.enter_note') }}">{{ $word->note }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <button type="submit" class="button button-contactForm btn_1">{{ trans('Update Word') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection