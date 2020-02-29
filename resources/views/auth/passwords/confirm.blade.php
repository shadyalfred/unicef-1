@extends('layouts.auth')

@section('form')
<form class="form-horizontal form-material text-center" id="loginform" method="POST" action="{{ route('password.confirm') }}">

    @csrf

    @component('components.logo')@endcomponent

    <div class="form-group m-t-40">
        <h5>@lang('Please confirm your password before continuing.')</h5>
        <div class="col-xs-12">
            <input id="password" name="password" class="form-control" type="password" required placeholder="@lang('register.password')" autofocus>
            @error('password')
                <div class="help-block">
                    <ul role="alert">
                        <li style="color: #e46a76;">{{ $message }}</li>
                    </ul>
                </div>
            @enderror
        </div>
    </div>

    <div class="form-group text-center m-t-20">
        <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">@lang('register.confirmPassword')</button>
        </div>
    </div>

    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif
</form>
@endsection
