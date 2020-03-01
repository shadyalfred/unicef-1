@extends('layouts.auth')

@section('form')
<form class="form-horizontal form-material text-center" id="loginform" method="POST" action="{{ route('verification.resend') }}">

    @csrf

    @component('components.logo')@endcomponent

    <div class="form-group text-center m-t-20">
        <div>
            <h5>{{ __('Verify Your Email Address') }}</h5>
        </div>

        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <div class="alert alert-warning">
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </div>
    </div>

    <div class="form-group text-center m-t-20">
        <p>
            {{ __('If you did not receive the email') }}
        </p>

        <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">{{ __('click here to request another') }}</button>
        </div>
    </div>
</form>
@endsection
