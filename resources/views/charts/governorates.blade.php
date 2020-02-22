@extends('layouts.chart')

@section('page-title', __('Governorates Chart'))

@section('page-title-breadcrumb', __('Governorates Chart'))

@section('api1', route('getTotalsForGovernoratesPerEachMonth', ''))

@section('api2', route('getTotalGovernoratesMalesFemales', ''))