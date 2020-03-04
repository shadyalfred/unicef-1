@extends('layouts.app')

@section('page-title', __('Home'))

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
                        @lang('Welcome!')
                    </h4>
                    <p>
                        @lang('Please use the sidebar to navigate.')
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection