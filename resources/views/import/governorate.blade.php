@extends('layouts.excel-form')

@section('form-title')
    @lang('Upload spreadsheet of governorates')
@endsection


@section('form-action', route('import.governorate.import'))

@section('form-subtitle')
    @lang('Monthly Report of governorates')
@endsection
