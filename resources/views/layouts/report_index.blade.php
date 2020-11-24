@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
    <style>
        table th {
            text-align: center;
            vertical-align: middle !important;
        }
        .page-item.active .page-link {
            background-color: #1cabe2;
            border-color: #1cabe2;
        }
        .dataTables_filter input {
            background-image: linear-gradient(#1cabe2, #1cabe2),linear-gradient(#e9ecef,#e9ecef) !important;
        }
        button.btn-outline-info:hover {
            color: #03a9f3;
            background-color: initial;
            border-color: #03a9f3;
        }
        .dataTables_length select:focus {
            background-image: linear-gradient(#1cabe2,#1cabe2),linear-gradient(#e9ecef,#e9ecef);
        }
        .page-link,
        .page-link:hover {
            color: #1cabe2;
        }
        #date:hover {
            cursor: pointer;
        }
        #reports-table_filter {
            display: flex !important;
            flex-direction: column;
        }
        #reports-table_filter>label:first-child {
            margin-left: 17px;
        }
        #date-range-inputs {
            text-align: left;
        }
    </style>

    {{-- Datatable RTL --}}
    @if(app()->getLocale() === 'ar')
        <style>
            div.dataTables_wrapper {
                direction: rtl;
            }
        </style>
    @endif

    {{-- Datepicker --}}
    <link href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

{{-- Breadcrumb --}}
@section('additional-breadcrumb')
    <li class="breadcrumb-item">
        <a href="#">@lang('Edit Reports')</a>
    </li>
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    {{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @yield('pageTitle')
                    </h4>
                    <h6 class="card-subtitle">
                        @yield('pageSubtitle')
                    </h6>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive m-t-40">
                        {{-- Date Range Inputs --}}
                        <div id="date-range-inputs" style="float: left">
                            <div>
                                <label for="date">@lang('Date:')</label>
                                <input type="text" id="date" readonly>
                            </div>
                        </div>

                        <table id="reports-table"
                            class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        @lang('Action')
                                    </th>
                                    <th>
                                        @yield('firstColumn')
                                    </th>
                                    <th>
                                        @lang('Males Under 5')
                                    </th>
                                    <th>
                                        @lang('Males From 5 to 15')
                                    </th>
                                    <th>
                                        @lang('Females Under 5')
                                    </th>
                                    <th>
                                        @lang('Females From 5 to 15')
                                    </th>
                                    <th>
                                        @lang('Pregnancy visits')
                                    </th>
                                    <th>
                                        @lang('Endangered pregnancies')
                                    </th>
                                    <th>
                                        @lang('Other visits')
                                    </th>
                                    <th>
                                        @lang('Males Above 15')
                                    </th>
                                    <th>
                                        @lang('Date')
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @yield('tableData')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Content -->
    <!-- ============================================================== -->
@endsection

@section('javascript')
    @parent

    {{-- Wait for element --}}
    <script type="text/javascript" src="{{ asset('assets/node_modules/waitForElement.js') }}"></script>
    {{-- Datepicker --}}
    <script type="text/javascript" src="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- This is data table -->
    <script type="text/javascript" src="{{ asset('assets/node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/node_modules/moment/moment-with-locales.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/node_modules/datatables.net_plugins/datetime.js') }}"></script>

    {{-- Datatable and Datepicker --}}
    <script type="text/javascript">
        let table;
        $(document).ready(function() {
            // Initiate DataTable
            table = $('#reports-table').DataTable({
                order: [],
                scrollX: true,
                @if(app()->getLocale() === 'ar')
                    language: {
                        url: "{{ asset('assets/node_modules/datatables.net_plugins/Arabic.json') }}" // Arabic localization
                    },
                    fixedColumns: true // Use for RTL
                @endif
            });

            setTimeout(() => {
                // Create datepickers inputs
                $('#reports-table_filter').ready(function () {
                    $('.dataTables_filter').css({'text-align': 'none', 'float': 'none'});
                    $('#date-range-inputs').appendTo('#reports-table_filter');

                    // Initiating datepicker
                    const startDate = $('#date');
                    startDate.datepicker({
                        format: "mm-yyyy",
                        startView: 1,
                        minViewMode: 1,
                        todayBtn: "linked",
                        autoclose: true,
                        todayHighlight: true,
                        clearBtn: true,
                    });
                    startDate.datepicker('setDate', moment().startOf('year').format('MM-YYYY'));
                    startDate.datepicker().on('changeDate', function(e) {
                        const date = e.format('mm-yyyy');
                        table.column(10).search(date).draw();
                    });
                }).ready(() => table.draw());
            }, 500);
        });
    </script>
@endsection
