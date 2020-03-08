@extends('layouts.app')

@section('page-title', __('home.home'))

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    {{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (is_null(auth()->user()->email_verified_at))
                        <div class="alert alert-warning">
                            @lang('Please verify your account by the message we sent to your email address.')
                        </div>
                    @endif
                    <h4 class="card-title">
                        @lang('home.welcome')
                    </h4>
                    <p>
                        @lang('home.message')
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
