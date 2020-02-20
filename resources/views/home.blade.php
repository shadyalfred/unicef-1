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