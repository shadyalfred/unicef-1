@extends('layouts.excel-form')

@section('page-title-breadcrumb', 'Import nationalities report')

@section('form-title')
    @lang('Upload spreadsheet of nationalities')
@endsection

@section('form-action', route('import.country.import'))

@section('form-subtitle')
    @lang('Monthly Report of nationalities')
@endsection