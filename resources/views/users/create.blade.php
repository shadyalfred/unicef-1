@extends('layouts.form')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/dist/css/pages/floating-label.css') }}" type="text/css" media="screen" />
    <link rel="stylesheet" href="{{ asset('assets/dist/css/custom.css') }}" type="text/css" media="screen" />
@append

@section('additional-breadcrumb')
    <li class="breadcrumb-item"><a href="#">@lang('Add')</a></li>
@endsection

@section('page-title-breadcrumb', __('User'))

@section('form-title')
    @lang('Add new user')
@endsection

@section('form-content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @lang('User was NOT added.')
        </div>
    @endif

    <form action="{{ route('user.store') }}" method="POST" class="floating-labels m-t-40">
        @csrf

        <div class="form-group m-b-40 @error('name') has-error @enderror">
            <input type="text" name="name" class="form-control" id="name" required value="{{ old('name') }}">
            <span class="bar"></span>
            <label for="name">@lang('register.name')</label>
            <div class="help-block"></div>

            @error('name')
                <small class="form-control-feedback">
                    {{ $message }}
                </small>
                <br>
            @enderror
        </div>

        <div class="form-group m-b-40 @error('email') has-error @enderror">
            <input type="email" name="email" class="form-control" id="email" required value="{{ old('email') }}">
            <span class="bar"></span>
            <label for="email">@lang('register.email')</label>
            <div class="help-block"></div>

            @error('email')
                <small class="form-control-feedback">
                    {{ $message }}
                </small>
                <br>
            @enderror
        </div>

        <div class="form-group m-b-40 @error('password') has-error @enderror">
            <input type="password" name="password" class="form-control" id="password" minlength="8" required>
            <span class="bar"></span>
            <label for="password">@lang('register.password')</label>
            <div class="help-block"></div>

            @error('password')
                <small class="form-control-feedback">
                    {{ $message }}
                </small>
                <br>
            @enderror
        </div>

        <div class="form-group m-b-40 @error('password_confirmation') has-error @enderror">
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" minlength="8" required data-validation-match-match="password">
            <span class="bar"></span>
            <label for="password_confirmation">@lang('register.confirmPassword')</label>
            <div class="help-block"></div>

            @error('password_confirmation')
                <small class="form-control-feedback">
                    {{ $message }}
                </small>
                <br>
            @enderror
        </div>

        <div class="form-group m-b-40">
            <button class="btn btn-primary" type="submit"><i class="fas fa-plus"></i> @lang('Add')</button>
        </div>
    </form>
@endsection
