@extends('layouts.app')

@section('page-title-breadcrumb')
    @lang('Your Profile')
@endsection

@section('page-title', __('Your Profile'))

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 text-center">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <center class="m-t-30 m-b-30 mx-auto"> <img src="{{ asset('storage/' . $user->profile_picture) }}" class="img-circle" width="150" />
                        </center>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12"> <strong>@lang('Full Name')</strong>
                            <br>
                            <p class="text-muted">{{ $user->name }}</p>
                        </div>
                        <div class="col-lg-12"> <strong>@lang('Email')</strong>
                            <br>
                            <p class="text-muted">{{ $user->email }}</p>
                        </div>
                        @if ($user->isAdmin)
                            <div class="col-lg-12 text-success"> <strong>@lang('Admin')</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- End Column -->
    </div>
    <!-- Row -->
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
@endsection
