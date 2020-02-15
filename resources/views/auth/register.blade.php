@extends('layouts.auth')

@section('form')
<form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('register') }}">
    @csrf

    <div class="text-center">
        <a href="{{ route('index') }}" class="db"><img src="{{ asset('assets/images/unicef_logo.png') }}" style="max-width: 100px" alt="Home" /></a>
    </div>
    <h3 class="box-title m-t-40 m-b-0">@lang('register.registerNow')</h3><small>@lang('register.createYourAccount')</small>

    <div class="form-group m-t-20">
        <div class="col-xs-12">
            <input id="name" name="name" class="form-control" type="text" required placeholder="@lang('register.name')" value="{{ old('name') }}" autofocus>
            @error('name')
                <div class="help-block">
                    <ul role="alert">
                        <li style="color: #e46a76;">{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group ">
        <div class="col-xs-12">
            <input id="email" name="email" class="form-control" type="email" required placeholder="@lang('register.email')" value="{{ old('email') }}">
            @error('email')
                <div class="help-block">
                    <ul role="alert">
                        <li style="color: #e46a76;">{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group ">
        <div class="col-xs-12">
            <input id="password" name="password" class="form-control" type="password" required placeholder="@lang('register.password')">
            @error('password')
                <div class="help-block">
                    <ul role="alert">
                        <li style="color: #e46a76;">{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-12">
            <input id="password-confirm" name="password_confirmation" class="form-control" type="password" required="" placeholder="@lang('register.confirmPassword')">
        </div>
    </div>

    <div class="form-group text-center m-t-20">
        <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">@lang('register.signup')</button>
        </div>
    </div>

    <div class="form-group m-b-0">
        <div class="col-sm-12 text-center">
            <p>@lang('register.alreadyHaveAnAccount') <a href="{{ route('login') }}" class="text-info m-l-5"><b>@lang('register.login')</b></a></p>
        </div>
    </div>
</form>
@endsection
