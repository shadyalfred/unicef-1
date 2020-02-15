@extends('layouts.auth')

@section('form')
<form class="form-horizontal form-material text-center" id="loginform" method="POST" action="{{ route('password.email') }}">
    @csrf

    <a href="{{ route('index') }}" class="db"><img src="{{ asset('assets/images/unicef_logo.png') }}" style="max-width: 100px" alt="Home" /></a>

    <div class="form-group m-t-40">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="form-group m-t-40">
        <div class="col-xs-12">
            <input id="email" name="email" class="form-control" type="email" required placeholder="@lang('register.email')" value="{{ old('email') }}" autofocus>
            @error('email')
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
            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">@lang('Send Password Reset Link')</button>
        </div>
    </div>
</form>
@endsection
