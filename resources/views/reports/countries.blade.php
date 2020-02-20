@extends('layouts.report')

{{-- Page title --}}
@section('page-title-breadcrumb', __('Nationalities records'))

{{-- Table --}}
{{-- Table title --}}
@section('report-page-title')
    @lang('Monthly Records')
@endsection

{{-- Table subtitle --}}
@section('report-page-subtitle')
    @lang('Monthly records for each nationality')
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

{{-- Start charts --}}
{{-- First chart api --}}
@section('chart1-api', route('getTotalsForNationalitiesPerEachMonth', ''))
{{-- Second chart api --}}
@section('chart2-api', route('getTotalNationalitiesMalesFemales', ''))
{{-- End charts --}}