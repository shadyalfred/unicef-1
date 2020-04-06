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
        #fini:hover,
        #ffin:hover {
            cursor: pointer;
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
    <li class="breadcrumb-item"><a href="#">@lang('Reports')</a></li>
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
                        @yield('report-page-title')
                    </h4>
                    <h6 class="card-subtitle">
                        @yield('report-page-subtitle')
                    </h6>
                    <div class="m-3">
                        <button id="print-table-btn" class="btn btn-primary">
                            @lang('Print')
                        </button>

                        <button id="export-table-btn" class="btn btn-primary">
                            @lang('Export')
                        </button>

                        <button id="popup-table-btn" class="btn btn-primary">
                            @lang('Show Table')
                        </button>
                    </div>

                    <div class="table-responsive m-t-40">
                        {{-- Date Range Inputs --}}
                        <div id="date-range-inputs" style="float: left">
                            <div>
                                <label for="fini">@lang('From:')</label>
                                <input type="text" id="fini" readonly>
                            </div>
                            <div>
                                <label for="ffin" style="margin-right: 19px">@lang('To:')</label>
                                <input type="text" id="ffin" readonly>
                            </div>
                        </div>

                        <table id="reports-table"
                            class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th rowspan="3">@lang('ID')</th>
                                    @yield('table-head')
                                    <th colspan="6">@lang('Kids under 15 years old')</th>
                                    <th rowspan="3">@lang('Total kids visits')</th>
                                    <th colspan="4">@lang('Females above 15 years old')</th>
                                    <th rowspan="3">@lang('Total kids and women visits')</th>
                                    <th rowspan="3">@lang('Total males above 15 years old visits')</th>
                                    <th rowspan="3">@lang('Total all visits')</th>
                                    <th rowspan="3">@lang('Date')</th>
                                </tr>
                                <tr>
                                    <th colspan="2">@lang('Males')</th>
                                    <th colspan="2">@lang('Females')</th>
                                    <th colspan="2">@lang('Total')</th>
                                    <th rowspan="2">@lang('Pregnancy visits')</th>
                                    <th rowspan="2">@lang('Endangered pregnancies')</th>
                                    <th rowspan="2">@lang('Other visits')</th>
                                    <th rowspan="2">@lang('Total visits')</th>
                                </tr>
                                <tr>
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th rowspan="3">@lang('ID')</th>
                                    @yield('table-foot')
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                    <th rowspan="3">@lang('Total kids visits')</th>
                                    <th rowspan="2">@lang('Pregnancy visits')</th>
                                    <th rowspan="2">@lang('Endangered pregnancies')</th>
                                    <th rowspan="2">@lang('Other visits')</th>
                                    <th rowspan="2">@lang('Total visits')</th>
                                    <th rowspan="3">@lang('Total kids and women visits')</th>
                                    <th rowspan="3">@lang('Total males above 15 years old visits')</th>
                                    <th rowspan="3">@lang('Total all visits')</th>
                                    <th rowspan="3">@lang('Date')</th>
                                </tr>
                                <tr>
                                    <th colspan="2">@lang('Males')</th>
                                    <th colspan="2">@lang('Females')</th>
                                    <th colspan="2">@lang('Total')</th>
                                </tr>
                                <tr>
                                    <th colspan="6">@lang('Kids under 15 years old')</th>
                                    <th colspan="4">@lang('Females above 15 years old')</th>
                                </tr>
                            </tfoot>
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
    <script type="text/javascript" src="{{ asset('assets/node_modules/datatables.net_plugins/range_dates.js') }}"></script>
    {{-- Export to Excel --}}
    <script type="text/javascript" src="{{ asset('assets/node_modules/sheetjs/xlsx.full.min.js') }}"></script>
    {{-- Charts --}}
    <script src="{{ asset('assets/node_modules/Chart.js/Chart.min.js') }}"></script>
    <!-- END - This is for export functionality only -->

    {{-- Declare function --}}
    <script type="text/javascript">
        function getPrintableTable(isExcel = false) {
            const customTable = document.createElement('table');
            customTable.setAttribute('id', 'reports-table');

            customTable.innerHTML = `
                <table id="reports-table"
                    class="display table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="3">@lang('ID')</th>
                            <th rowspan="3">@lang('Governorate')</th>
                            <th colspan="6">@lang('Kids under 15 years old')</th>
                            <th rowspan="3">@lang('Total kids visits')</th>
                            <th colspan="4">@lang('Females above 15 years old')</th>
                            <th rowspan="3">@lang('Total kids and women visits')</th>
                            <th rowspan="3">@lang('Total males above 15 years old visits')</th>
                            <th rowspan="3">@lang('Total all visits')</th>
                            <th rowspan="3">@lang('Date')</th>
                        </tr>
                        <tr>
                            <th colspan="2">@lang('Males')</th>
                            <th colspan="2">@lang('Females')</th>
                            <th colspan="2">@lang('Total')</th>
                            <th rowspan="2">@lang('Pregnancy visits')</th>
                            <th rowspan="2">@lang('Endangered pregnancies')</th>
                            <th rowspan="2">@lang('Other visits')</th>
                            <th rowspan="2">@lang('Total visits')</th>
                        </tr>
                        <tr>
                            <th>@lang('Under 5 years old')</th>
                            <th>@lang('From 5 to 15 years old')</th>
                            <th>@lang('Under 5 years old')</th>
                            <th>@lang('From 5 to 15 years old')</th>
                            <th>@lang('Under 5 years old')</th>
                            <th>@lang('From 5 to 15 years old')</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            `;

            if (isExcel) {
                for (let index = 0; index < table.rows().nodes().length; index++) {
                    let elementCopy = table.rows().nodes()[index].cloneNode(true);
                    customTable.getElementsByTagName('tbody')[0].appendChild(elementCopy);
                }
            }

            for (let index = 0; index < table.rows({page: 'current'}).nodes().length; index++) {
                let elementCopy = table.rows({page: 'current'}).nodes()[index].cloneNode(true);
                customTable.getElementsByTagName('tbody')[0].appendChild(elementCopy);
            }

            return customTable;
        }
    </script>

    {{-- Datatable and Datepicker --}}
    <script type="text/javascript">
        let table;
        $(document).ready(function() {
            // Initiate DataTable
            table = $('#reports-table').DataTable({
                ajax: {
                    url: "@yield('api-url')",
                    type: "GET",
                    beforeSend: (request) => {
                        request.setRequestHeader("Content-Language", "{{ app()->getLocale() }}");
                    }
                },
                columns: [
                    { data: "id" },
                    { data: "@yield('table-col')" },
                    { data: "males_under_5" },
                    { data: "males_from_5_to_15" },
                    { data: "females_under_5" },
                    { data: "females_from_5_to_15" },
                    { data: "total_under_5" },
                    { data: "total_from_5_to_15" },
                    { data: "total_kids_visits" },
                    { data: "pregnancy_visits" },
                    { data: "endangered_pregnancies" },
                    { data: "other_visits" },
                    { data: "total_women_visits" },
                    { data: "total_women_and_kids_visits" },
                    { data: "males_above_15_visits" },
                    { data: "total_visits" },
                    { data: "date" }
                ],
                columnDefs: [
                    {
                        targets: 16,
                        render: $.fn.dataTable.render.moment("YYYY-MM-DD", "MM-YYYY")
                    }
                ],
                order: [[ 16, "desc" ]],
                dom: 'Bfrtipl',
                scrollX: true,
                @if(app()->getLocale() === 'ar')
                    language: {
                        url: "{{ asset('assets/node_modules/datatables.net_plugins/Arabic.json') }}" // Arabic localization
                    },
                    fixedColumns: true // Use for RTL
                @endif
            });

            // Create datepickers inputs
            $('#reports-table_filter').ready(function () {
                $('.dataTables_filter').css({'text-align': 'none', 'float': 'none'});
                @if(app()->getLocale() === 'ar')
                    $('#ffin').prev().css({'margin-right': 0});
                @endif
                $('#date-range-inputs').appendTo('#reports-table_filter');

                // Initiating datepicker
                const startDate = $('#fini');
                startDate.datepicker({
                    format: "mm-yyyy",
                    startView: 1,
                    minViewMode: 1,
                    todayBtn: "linked",
                    autoclose: true,
                    todayHighlight: true,
                }).on('changeDate', (e) => table.draw() );
                startDate.datepicker('setDate', moment().startOf('year').format('MM-YYYY'));

                const endDate = $('#ffin');
                endDate.datepicker({
                    format: "mm-yyyy",
                    startView: 1,
                    minViewMode: 1,
                    todayBtn: "linked",
                    autoclose: true,
                    todayHighlight: true,
                }).on('changeDate', (e) => {
                        table.draw();
                    });
                endDate.datepicker('setDate', moment().format('MM-YYYY'));

                // Importing range_dates.js to sort table by date input
                endDate.ready(() => {
                    waitForElement('#ffin').then(() => {
                        $.getScript("{{ asset('assets/node_modules/datatables.net_plugins/range_dates.js') }}");
                    });
                });
            }).ready(() => table.draw());

            // Print button
            $('#print-table-btn').on('click', () => {
                const customTable = window.open();
                customTable.document.write(`
                    <div class="table-responsive m-t-40 dataTables_wrapper">
                        <table id="reports-table"
                            class="display table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="3">@lang('ID')</th>
                                    @yield('table-head')
                                    <th colspan="6">@lang('Kids under 15 years old')</th>
                                    <th rowspan="3">@lang('Total kids visits')</th>
                                    <th colspan="4">@lang('Females above 15 years old')</th>
                                    <th rowspan="3">@lang('Total kids and women visits')</th>
                                    <th rowspan="3">@lang('Total males above 15 years old visits')</th>
                                    <th rowspan="3">@lang('Total all visits')</th>
                                    <th rowspan="3">@lang('Date')</th>
                                </tr>
                                <tr>
                                    <th colspan="2">@lang('Males')</th>
                                    <th colspan="2">@lang('Females')</th>
                                    <th colspan="2">@lang('Total')</th>
                                    <th rowspan="2">@lang('Pregnancy visits')</th>
                                    <th rowspan="2">@lang('Endangered pregnancies')</th>
                                    <th rowspan="2">@lang('Other visits')</th>
                                    <th rowspan="2">@lang('Total visits')</th>
                                </tr>
                                <tr>
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                `);

                for (let index = 0; index < table.rows({page: 'current'}).nodes().length; index++) {
                    let elementCopy = table.rows({page: 'current'}).nodes()[index].cloneNode(true);
                    customTable.document.getElementsByTagName('tbody')[0].appendChild(elementCopy);
                }

                $("link, style").each(function() {
                    $(customTable.document.head)
                        .append($(this).clone())
                        .append(`
                            <style type="text/css" media="print">
                                @page { size: landscape; }
                            </style>
                        `);
                }).ready(() => {
                    customTable.focus();
                    $(customTable.document).ready(() => {
                        customTable.print();
                        customTable.close();
                    });
                });

            })

            // Export as .xlsx button
            $('#export-table-btn').on('click', () => {
                const wb = XLSX.utils.table_to_book(getPrintableTable(true), {sheet: "Sheet 1"});

                XLSX.writeFile(wb, 'report.xlsx');
            });

            // Popup table button
            $('#popup-table-btn').on('click', () => {
                const params = [
                    'toolbar=no',
                    'location=no',
                    'directories=no',
                    'menubar=no',
                    'titlebar=no',
                    'status=no',
                    'postwindow',
                    'fullscreen=yes',
                    'centerscreen=yes',
                    'personalbar=no'
                ].join(',');

                const customTable = window.open('', 'popup', params);
                customTable.document.write(`
                    <div class="table-responsive m-t-40 dataTables_wrapper">
                        <table id="reports-table"
                            class="display table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="3">@lang('ID')</th>
                                    @yield('table-head')
                                    <th colspan="6">@lang('Kids under 15 years old')</th>
                                    <th rowspan="3">@lang('Total kids visits')</th>
                                    <th colspan="4">@lang('Females above 15 years old')</th>
                                    <th rowspan="3">@lang('Total kids and women visits')</th>
                                    <th rowspan="3">@lang('Total males above 15 years old visits')</th>
                                    <th rowspan="3">@lang('Total all visits')</th>
                                    <th rowspan="3">@lang('Date')</th>
                                </tr>
                                <tr>
                                    <th colspan="2">@lang('Males')</th>
                                    <th colspan="2">@lang('Females')</th>
                                    <th colspan="2">@lang('Total')</th>
                                    <th rowspan="2">@lang('Pregnancy visits')</th>
                                    <th rowspan="2">@lang('Endangered pregnancies')</th>
                                    <th rowspan="2">@lang('Other visits')</th>
                                    <th rowspan="2">@lang('Total visits')</th>
                                </tr>
                                <tr>
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                    <th>@lang('Under 5 years old')</th>
                                    <th>@lang('From 5 to 15 years old')</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                `);

                for (let index = 0; index < table.rows({page: 'current'}).nodes().length; index++) {
                    let elementCopy = table.rows({page: 'current'}).nodes()[index].cloneNode(true);
                    customTable.document.getElementsByTagName('tbody')[0].appendChild(elementCopy);
                }

                $("link, style").each(function() {
                    $(customTable.document.head)
                        .append($(this).clone())
                })
            })
        });
    </script>
@endsection
