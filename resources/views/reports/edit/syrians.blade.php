@extends('layouts.report_edit')

@section('page-title-breadcrumb', __('Edit Syrian Record'))

@section('form-action', route('reports.syrians.update', $report->id))

@section('form-subtitle', __('Edit Syrian Record'))

@section('selectBox')
    <label class="control-label">
        @lang('Governorate')
    </label>
    <select class="form-control custom-select @error('governorate_id') is_invalid @enderror"
            data-placeholder="@lang('Select a Governorate')"
            id="governorate_id"
            name="governorate_id"
            required>
        @foreach($governorates as $governorate)
            <option value="{{ $governorate->id }}" {{ $report->governorate->id === $governorate->id ? 'selected' : '' }}>
                {{ app()->getLocale() === 'en' ? $governorate->name_en : $governorate->name_ar }}
            </option>
        @endforeach
    </select>
    @error('governorate_id')
        <small class="form-control-feedback">
            {{ $message }}
        </small>
    @enderror
@endsection
