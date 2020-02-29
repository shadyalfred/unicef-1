@extends('layouts.auth')

@section('form')
<form class="form-horizontal form-material text-center" id="loginform" method="POST" action="{{ route('login') }}">
    @csrf

    @component('components.logo')@endcomponent

    <div class="form-group m-t-40">
        <div class="col-xs-12">
            <input id="email" name="email" class="form-control" type="email" required="" placeholder="@lang('login.email')" value="{{ old('email') }}" autofocus>
            @error('email')
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
            <input id="password" name="password" class="form-control" type="password" required placeholder="@lang('login.password')">
            @error('password')
                <div class="help-block">
                    <ul role="alert">
                        <li style="color: #e46a76;">{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <div class="col-md-12">
            <div class="d-flex no-block align-items-center">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="remember">@lang('login.rememberMe')</label>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('password.request') }}" id="to-recover" class="text-muted"><i class="fas fa-lock m-r-5"></i>@lang('login.forgotPassword')</a>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group text-center m-t-20">
        <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">@lang('login.login')</button>
        </div>
    </div>

    <div class="form-group m-b-0">
        <div class="col-sm-12 text-center">
            @lang('login.haveNoAccount') <a href="{{ route('register') }}" class="text-primary m-l-5"><b>@lang('login.signup')</b></a>
        </div>
    </div>
</form>
@endsection
