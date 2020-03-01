@extends('layouts.report')

{{-- Page Title --}}
@section('page-title', __('Nationalities Report'))

{{-- Page breadcrumb title --}}
@section('page-title-breadcrumb', __('Nationalities Report'))

{{-- Table --}}
{{-- Table title --}}
@section('report-page-title')
    @lang('Monthly Records')
@endsection

{{-- Table subtitle --}}
@section('report-page-subtitle')
    @lang('Monthly Records for each nationality')
@endsection

{{-- Table header --}}
@section('table-head')
    <th rowspan="3">@lang('Country')</th>
@endsection

{{-- Table footer --}}
@section('table-foot')
    <th rowspan="3">@lang('Country')</th>
@endsection

@section('api-url', route('getAllCountriesReports'))

@section('table-col', "country")
{{-- End table --}}