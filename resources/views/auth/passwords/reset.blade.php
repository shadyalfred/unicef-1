@extends('layouts.auth')

@section('form')
<form class="form-horizontal form-material text-center" id="loginform" method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    @component('components.logo')@endcomponent

    <div class="form-group m-t-40">
        <div class="col-xs-12">
            <input id="email" name="email" class="form-control" type="email" required placeholder="@lang('register.email')" value="{{ $email ?? old('email') }}" autofocus>
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
            <input id="password" name="password" class="form-control" type="password" required placeholder="@lang('register.newPassword')">
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
           <input id="password-confirm" name="password_confirmation" class="form-control" type="password" required placeholder="@lang('register.newPassword')">
       </div>
   </div>

    <div class="form-group text-center m-t-20">
        <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">@lang('register.resetPassword')</button>
        </div>
    </div>
</form>
@endsection
