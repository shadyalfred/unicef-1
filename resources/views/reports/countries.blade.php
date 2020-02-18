@extends('layouts.report')


@section('report-page-title')
    @lang('Monthly Records')
@endsection

@section('report-page-subtitle')
    @lang('Monthly records for each nationality')
@endsection

@section('table-head')
    <th rowspan="3">@lang('Country')</th>
@endsection

@section('table-foot')
    <th rowspan="3">@lang('Country')</th>
@endsection

@section('api-url', route('getAllCountriesReports'))

@section('table-col', "country")

@section('table-head')
    <th rowspan="3">@lang('Country')</th>
@endsection