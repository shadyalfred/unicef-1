@extends('layouts.form')

@section('css')
@parent

<link href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection


@section('form-title')
Upload spreadsheet
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

<form id="spreadsheet-upload-form" action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-body">
        <h3 class="card-title">Monthly Report</h3>
        <hr>
        <div class="row p-t-20">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Choose a file:</label>
                    <input type="file" name="spreadsheet_file" class="form-control" required accept=".csv, .xls, .xlsx">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Date:</label>
                    <input type="text" id="date-picker" class="form-control">
                    <input type="text" id="hidden-date-picker" name="date" hidden>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button type="submit" id="submit-button" class="btn btn-success mx-auto d-block"> <i class="fa fa-check"></i> Submit</button>
    </div>
</form>
@endsection

@section('javascript')
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
        todayHighlight: true
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