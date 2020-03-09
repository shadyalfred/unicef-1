@extends('layouts.map')

@section('page-title', __('Map of Syrians in Egypt'))

@section('page-title-breadcrumb', __('Map of Syrians in Egypt'))

@section('map-api', route('syriansMapApi', ['', '']))
