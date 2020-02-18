@extends('layouts.report')

@section('page-title-breadcrumb', __('Governorates records'))

@section('report-page-title')
    @lang('Monthly Records')
@endsection

@section('report-page-subtitle')
    @lang('Monthly records for each governorate')
@endsection

@section('table-head')
    <th rowspan="3">@lang('Governorate')</th>
@endsection

@section('table-foot')
    <th rowspan="3">@lang('Governorate')</th>
@endsection


@section('api-url', route('getAllGovernoratesReports'))

@section('table-col', "governorate")

@section('table-head')
    <th rowspan="3">@lang('Governorate')</th>
@endsection