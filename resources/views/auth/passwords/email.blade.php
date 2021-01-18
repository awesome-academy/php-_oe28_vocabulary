@extends('layouts.layout')
@section('content')
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            @if (session('status'))
                                <div class="mail-notify" aria-live="polite" aria-atomic="true">
                                    <div class="toast">
                                        <div class="toast-header">
                                            <strong class="mr-auto">{{ trans('mail.reset') }}</strong>
                                            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="toast-body">
                                            {{ trans('mail.failed') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <h2>{{ trans('mail.reset') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container balance">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ trans('auth.reset_label') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resetPasswordLink') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ trans('auth.email_label') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('auth.send_label') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@if (session('status'))
    @section('script')
        <script src="{{ asset('js/mail_notify.js') }}"></script>
    @endsection
@endif
