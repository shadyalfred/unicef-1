@extends('layouts.report')

{{-- Page Title --}}
@section('page-title', __('Syrians Report'))

{{-- Page breadcrumb title --}}
@section('page-title-breadcrumb', __('Syrians Report'))

{{-- Table --}}
{{-- Table title --}}
@section('report-page-title')
    @lang('Monthly Records')
@endsection

{{-- Table subtitle --}}
@section('report-page-subtitle')
    @lang('Monthly Records of Syrians in Egypt per each governorate')
@endsection

{{-- Table header --}}
@section('table-head')
    <th rowspan="3">@lang('Governorate')</th>
@endsection

{{-- Table footer --}}
@section('table-foot')
    <th rowspan="3">@lang('Governorate')</th>
@endsection

@section('table-col', "governorate")

@section('api-url', route('getAllSyriansReports'))
{{-- End table --}}