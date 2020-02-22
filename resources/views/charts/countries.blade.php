@extends('layouts.chart')

@section('page-title', __('Nationalities Chart'))

@section('page-title-breadcrumb', __('Nationalities Chart'))

@section('api1', route('getTotalsForNationalitiesPerEachMonth', ''))

@section('api2', route('getTotalNationalitiesMalesFemales', ''))

{{-- Chart 3 --}}
@section('api3', route('getTotalsForNationality', ''))

@section('chart-3-xkey', 'country')

@section('chart-3-title', __('Total for each nationality'))
{{-- End Chart 3 --}}