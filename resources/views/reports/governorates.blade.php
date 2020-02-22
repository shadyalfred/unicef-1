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

@section('table-col', "governorate")

@section('api-url', route('getAllGovernoratesReports'))
{{-- End table --}}