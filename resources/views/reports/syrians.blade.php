@extends('layouts.report')

{{-- Page breadcrumb title --}}
@section('page-title-breadcrumb', __('Syrians records'))

{{-- Table --}}
{{-- Table title --}}
@section('report-page-title')
    @lang('Monthly Records of Syrians')
@endsection

{{-- Table subtitle --}}
@section('report-page-subtitle')
    @lang('Monthly records of Syrians in Egypt')
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