@extends('layouts.app')

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    {{-- Start Row --}}
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white">@yield('form-title')</h4>
            </div>
            <div class="card-body">
                @yield('form-content')
            </div>
        </div>
    </div>
    <!-- End Row -->
@endsection

@section('javascript')
    @parent
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/dist/js/pages/jasny-bootstrap.js') }}"></script>
    <script src="{{ asset('assets/dist/js/pages/validation.js') }}"></script>
    <script>
        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }(window, document, jQuery);
    </script>
@endsection