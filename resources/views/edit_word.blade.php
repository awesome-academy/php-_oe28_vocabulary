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
    @if (session('message') == trans('words.update_failed'))
        <div class="container">
            <div class="alert alert-danger" role="alert">{{ session('message') }}</div>
        </div>
    @endif
    <section class="contact-section section_padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">{{ trans('words.edit_word') }}</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="{{ route('words.update', $word->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="text" name="oldTypeId" value="{{ $type }}" hidden>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="word" type="text" placeholder="{{ trans('words.enter_word') }}" value="{{$word->word}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row block">
                            <div class="col-7">
                                <div class="form-group">
                                    <input class="form-control" name="meaning" id="name" type="text" placeholder="{{ trans('words.enter_meaning') }}" value="{{$meaning}}" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <select name="type" class="form-control" required>
                                        @for($i=1; $i<=8; $i++) 
                                            @php
                                                if ( app()->getLocale() == 'en')
                                                    $typeWord = config("config.$i"); 
                                                else     
                                                    $typeWord = config("config_vi.$i"); 
                                            @endphp
                                            <?php echo '<option'; ?> 
                                            @if ($typeWord === $type) 
                                                selected 
                                            @endif 
                                            @foreach ($allTypes as $typeCheck) 
                                                @php 
                                                    $otherType = $typeCheck['id']; 
                                                @endphp 
                                                @if (($typeWord === config("config.$otherType")) && ($typeWord !== $type) && (Config::get('app.locale') == 'en')) 
                                                    <?php echo 'disabled' ?> 
                                                @endif 
                                                @if (($typeWord === config("config_vi.$otherType")) && ($typeWord !== $type) && (Config::get('app.locale') == 'vi')) 
                                                    <?php echo 'disabled' ?> 
                                                @endif 
                                            @endforeach
                                            >{{ $typeWord }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="note" type="text" placeholder="{{ trans('words.enter_note') }}" value="{{ $word->note }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            @if (!$checkWord)
                                <button type="submit" class="button button-contactForm btn_1">
                                    {{ trans('words.update_word') }}
                                </button>
                            @else
                                <button type="button" class="button button-contactForm btn_1" data-toggle="modal" data-target="#exampleModalCenter">
                                    {{ trans('words.update_word') }}
                                </button>
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                {{ trans('words.confirm_updating') }}
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('words.index') }}">
                                                    <button type="button" class="btn btn-secondary"> 
                                                        {{ trans('words.back') }}
                                                    </button>
                                                </a>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ trans('words.yes') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
