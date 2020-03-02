@extends('layouts.chart')

@section('page-title', __('Nationalities Chart'))

@section('page-title-breadcrumb', __('Nationalities Chart'))

{{-- Range Charts --}}
@section('range-api-1', route('getTotalsForRangeNat', ['', '']))
@section('range-chart-1-xkey', 'country')

@section('range-api-2', route('getTotalKidsForRangeNat', ['', '']))

{{-- Yearly Charts --}}
@section('api1', route('getTotalsForNationalitiesPerEachMonth', ''))

@section('api2', route('getTotalNationalitiesMalesFemales', ''))

{{-- Chart 3 --}}
@section('api3', route('getTotalsForNationality', ''))

@section('chart-3-xkey', 'country')

@section('chart-3-title', __('Total for each nationality'))
{{-- End Chart 3 --}}