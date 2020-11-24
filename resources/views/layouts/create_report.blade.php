@extends('layouts.form')

@section('css')
    @parent

    <link href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <style type="text/css" media="screen">
        #date-picker {
            cursor: pointer;
        }
    </style>

@endsection

@section('form-title', __('Add Report'))

{{-- Breadcrumb --}}
@section('additional-breadcrumb')
    <li class="breadcrumb-item"><a href="#">@lang('Add Report')</a></li>
@endsection


@section('form-content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </div>
    @endif

    <form id="spreadsheet-upload-form" action="@yield('form-action')" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-body">
            <h3 class="card-title">
                @yield('form-subtitle')
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        @yield('selectBox')
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="males_under_5">
                            @lang('Males Under 5')
                        </label>
                        <input name="males_under_5" id="males_under_5" type="number" required
                               class="form-control @error('males_under_5') is-invalid @enderror"
                               value="{{ old('males_under_5') }}">
                        @error('males_under_5')
                            <small class="form-control-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="males_from_5_to_15">
                            @lang('Males From 5 to 15')
                        </label>
                        <input name="males_from_5_to_15" id="males_from_5_to_15" type="number" requried
                               class="form-control @error('males_from_5_to_15') is-invalid @enderror"
                               value="{{ old('males_from_5_to_15') }}">
                        @error('males_from_5_to_15')
                            <small class="form-control-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="females_under_5">
                            @lang('Females Under 5')
                        </label>
                        <input name="females_under_5" id="females_under_5" type="number" required
                               class="form-control @error('females_under_5') is-invalid @enderror"
                               value="{{ old('females_under_5') }}">
                        @error('females_under_5')
                            <small class="form-control-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="females_from_5_to_15">
                            @lang('Females From 5 to 15')
                        </label>
                        <input name="females_from_5_to_15" id="females_from_5_to_15" type="number" requried
                               class="form-control @error('females_from_5_to_15') is-invalid @enderror"
                               value="{{ old('females_from_5_to_15') }}">
                        @error('females_from_5_to_15')
                            <small class="form-control-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="pregnancy_visits">
                            @lang('Pregnancy visits')
                        </label>
                        <input name="pregnancy_visits" id="pregnancy_visits" type="number" required
                               class="form-control @error('pregnancy_visits') is-invalid @enderror"
                               value="{{ old('pregnancy_visits') }}">
                        @error('pregnancy_visits')
                            <small class="form-control-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="endangered_pregnancies">
                            @lang('Endangered pregnancies')
                        </label>
                        <input name="endangered_pregnancies" id="endangered_pregnancies" type="number" requried
                               class="form-control @error('endangered_pregnancies') is-invalid @enderror"
                               value="{{ old('endangered_pregnancies') }}">
                        @error('endangered_pregnancies')
                            <small class="form-control-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="other_visits">
                            @lang('Other visits')
                        </label>
                        <input name="other_visits" id="other_visits" type="number" requried
                               class="form-control @error('other_visits') is-invalid @enderror"
                               value="{{ old('other_visits') }}">
                        @error('other_visits')
                            <small class="form-control-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="males_above_15_visits">
                            @lang('Males Above 15')
                        </label>
                        <input name="males_above_15_visits" id="males_above_15_visits" type="number" required
                               class="form-control @error('males_above_15_visits') is-invalid @enderror"
                               value="{{ old('males_above_15_visits') }}">
                        @error('males_above_15_visits')
                            <small class="form-control-feedback">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="row p-t-20">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">
                            @lang('Date:')
                        </label>
                        <input type="text" id="date-picker" class="form-control">
                        <input type="text" id="hidden-date-picker" name="date" hidden>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" id="submit-button" class="btn btn-success mx-auto d-block"> <i class="fa fa-check"></i> @lang('Submit')</button>
        </div>
    </form>

@endsection

@section('javascript')
    {{$errors}}
    @parent

    <script src="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        const datePicker = $('#date-picker');
        datePicker.datepicker({
            format: "mm/yyyy",
            startView: 1,
            minViewMode: 1,
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            disableTouchKeyboard: true
        });

        const date = new Date();
        const todaysDate = date.getMonth() + 1 + '/' + date.getFullYear();

        datePicker.datepicker('setDate', todaysDate);

        $('#spreadsheet-upload-form').submit(function(event) {
            event.preventDefault(); // This will prevent the default submit

            // Reformatting the date
            let insertedDate = datePicker.val();
            insertedDate = insertedDate.split('/');
            insertedDate = insertedDate[1] + '-' + insertedDate[0] + '-' + '01';

            // Updating the new formatted date into the hidden input
            document.querySelector('#hidden-date-picker').value = insertedDate;

            // Resuming form submission
            $(this).unbind('submit').submit(); // Continue the submission, unbind the event
        })

    </script>
@endsection
