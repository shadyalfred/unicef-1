@extends('layouts.chart')

@section('page-title', __('Syrians Chart'))

@section('page-title-breadcrumb', __('Syrians Chart'))

{{-- Range Charts --}}
@section('range-api-1', route('getTotalsForRangeSyr', ['', '']))
@section('range-chart-1-xkey', 'governorate')

@section('range-api-2', route('getTotalKidsForRangeSyr', ['', '']))

{{-- Yearly Charts --}}
@section('api1', route('getTotalsForSyriansPerEachMonth', ''))

@section('api2', route('getTotalSyriansMalesFemales', ''))

{{-- Chart 3 --}}
@section('api3', route('getTotalsForSyrians', ''))

@section('chart-3-xkey', 'governorate')

@section('chart-3-title', __('Total for each governorate'))
{{-- End Chart 3 --}}
