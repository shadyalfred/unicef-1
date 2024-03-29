@extends('layouts.chart')

@section('page-title', __('Governorates Chart'))

@section('page-title-breadcrumb', __('Governorates Chart'))

{{-- Range Charts --}}
@section('range-api-1', route('getTotalsForRangeGov', ['', '']))
@section('range-chart-1-xkey', 'governorate')

@section('range-api-2', route('getTotalKidsForRangeGov', ['', '']))

{{-- Yearly Charts --}}
@section('api1', route('getTotalsForGovernoratesPerEachMonth', ''))

@section('api2', route('getTotalGovernoratesMalesFemales', ''))

{{-- Chart 3 --}}
@section('api3', route('getTotalsForGovernorate', ''))

@section('chart-3-xkey', 'governorate')

@section('chart-3-title', __('Total for each governorate'))
{{-- End Chart 3 --}}