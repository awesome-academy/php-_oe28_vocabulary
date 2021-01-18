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
                                            {{ trans('mail.successfully') }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <h2>{{ trans('auth.login') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container balance">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ trans('mail.reset_pwd_successfully') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ trans('auth.login') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ trans('auth.email_label') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    {{ trans('auth.password_label') }}
                                </label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            {{ trans('auth.remember') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ trans('auth.login') }}
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ trans('auth.forgot_label') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="form-group row align-items-center">
                                <label class="col-md-4 col-form-label text-md-right">
                                    {{ trans('auth.or_login') }}
                                </label>
                                <div class="col-md-6">
                                    <hr class="flex-fill m-0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8 offset-md-4">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="">Github</label>
                                            <a href="{{ route('redirectToProvider', 'github') }}">
                                                <i class="fab fa-github myicon"></i>
                                            </a>
                                        </div>
                                        <div class="col-3">
                                            <label for="">Google</label>
                                            <i class="fab fa-google myicon icongg"></i>
                                        </div> 
                                        <div class="col-3">
                                            <label for="">Facebook</label>
                                            <a href="{{ route('redirectToProvider', 'facebook') }}">
                                                <i class="fab fa-facebook myicon iconfb"></i>
                                            </a>
                                        </div>
                                    </div>
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
