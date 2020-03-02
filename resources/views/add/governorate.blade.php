@extends('layouts.form')

@section('additional-breadcrumb')
    <li class="breadcrumb-item"><a href="#">Add</a></li>
@endsection

@section('page-title-breadcrumb', __('Governorate'))

@section('form-title')
    @lang('Add new governorate')
@endsection

@section('form-content')
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @lang('Governorate was NOT added!')
        </div>
    @endif

    <form action="{{ route('governorate.add.submit') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="row pt-3">
                <div class="col-md-6">
                    <div class="form-group @error('name_en') has-danger @enderror">
                        <label class="control-label">@lang('Name in English')</label>
                        <input type="text" id="name_en" name="name_en" class="form-control @error('name_en') form-control-danger @enderror" placeholder="Cairo" required value="{{ old('name_en') }}">
                        @error('name_en')
                            <small class="form-control-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group @error('name_ar') has-danger @enderror">
                        <label class="control-label">@lang('Name in Arabic')</label>
                        <input type="text" id="name_ar" name="name_ar" class="form-control @error('name_ar') form-control-danger @enderror" placeholder="القاهرة" required value="{{ old('name_ar') }}">
                        @error('name_ar')
                            <small class="form-control-feedback">
                                {{ $message }}
                            </small>
                            <br>
                        @enderror
                        <small class="form-control-feedback">
                            @lang("Please type the name exactly as it is typed in the excel sheet, paying attention to Alif Hamza, and Taa' Marboota")
                        </small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group @error('map_key') has-danger @enderror">
                        <label for="map-key" class="control-label">@lang('Map Key')</label>
                        <select id="map-key" name="map_key" class="form-control @error('map_key') form-control-danger @enderror custom-select" required>
                            @foreach ($mapKeys as $mapKey)
                                <option value="{{ $mapKey[0] }}" {{ old('map_key') === $mapKey[0] ? 'selected' : '' }}>{{ $mapKey[1] }}</option>
                            @endforeach
                        </select>
                        @error('map_key')
                            <small class="form-control-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                        <small class="form-control-feedback"> @lang("Choose the governorate's name") </small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
