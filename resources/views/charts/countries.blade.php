@extends('layouts.chart')

@section('page-title', __('Nationalities Chart'))

@section('page-title-breadcrumb', __('Nationalities Chart'))

@section('api1', route('getTotalsForNationalitiesPerEachMonth', ''))

@section('api2', route('getTotalNationalitiesMalesFemales', ''))