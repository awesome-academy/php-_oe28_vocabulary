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
<div class="editor">
    <div class="col-lg-4">
        @if (session('status') == trans('profile.update_successfully'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @elseif (session('status') == trans('profile.update_failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="blog_right_sidebar">
            <aside class="single_sidebar_widget newsletter_widget">
                <h4 class="widget_title">{{ trans('profile.editor') }}</h4>
                <form action="{{ route('users.update', Auth::id()) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>{{ trans('profile.name') }}</label>
                        <input type="text" class="form-control" value="{{ $user->name ?? '' }}" required name="name">
                    </div>
                    <button class="button rounded-0 primary-bg text-white w-100 btn_1" type="submit">{{ trans('profile.update')}}</button>
                </form>
            </aside>
        </div>
    </div>
</div>
@endsection
