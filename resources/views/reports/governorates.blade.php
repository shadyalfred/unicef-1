@extends('layouts.report')

{{-- Page Title --}}
@section('page-title', __('Governorates Report'))

{{-- Page breadcrumb title --}}
@section('page-title-breadcrumb', __('Governorates Report'))

{{-- Table --}}
{{-- Table title --}}
@section('report-page-title')
    @lang('Monthly Records')
@endsection

{{-- Table subtitle --}}
@section('report-page-subtitle')
    @lang('Monthly Records for each governorate')
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