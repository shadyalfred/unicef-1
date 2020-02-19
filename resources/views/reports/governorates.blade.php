@extends('layouts.report')

{{-- Page title --}}
@section('page-title-breadcrumb', __('Governorates records'))

{{-- Table --}}
{{-- Table title --}}
@section('report-page-title')
    @lang('Monthly Records')
@endsection

{{-- Table subtitle --}}
@section('report-page-subtitle')
    @lang('Monthly records for each governorate')
@endsection

{{-- Table header --}}
@section('table-head')
    <th rowspan="3">@lang('Governorate')</th>
@endsection

{{-- Table footer --}}
@section('table-foot')
    <th rowspan="3">@lang('Governorate')</th>
@endsection
{{-- End table --}}

{{-- Start charts --}}
{{-- First chart api --}}
@section('chart1-api', route('getTotalsForGovernoratesPerEachMonth', ''))
{{-- Second chart title --}}
@section('second-chart-title', __('Total per each governorate'))
{{-- End charts --}}


@section('table-col', "governorate")

@section('api-url', route('getAllGovernoratesReports'))

@section('table-head')
    <th rowspan="3">@lang('Governorate')</th>
@endsection