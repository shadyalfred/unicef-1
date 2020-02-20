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

@section('page-title', __('Report'))

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
                    </div>

                    <div class="table-responsive m-t-40">
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

    {{-- Start charts --}}
    {{-- Select year --}}
    <div class="row">
        <div class="col-2 mx-auto text-center">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Select year')
                    </h4>
                    <div>
                        <input type="text" id="year-input-for-chart" style="display: inline-block;
                                                                            width: 50px;
                                                                            border: none;
                                                                            border-bottom: 1px solid;
                                                                            text-align: center">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row">
        {{-- Total per each month --}}
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Total per each month')
                    </h4>
                    <div>
                        <canvas id="chart-1" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total per each governorate/country --}}
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Total males and females')
                    </h4>

                   <div>
                        <canvas id="chart-2" height="150"></canvas>
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
    <script>
        function getPrintableTable() {
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
            for (let index = 0; index < table.rows({page: 'current'}).nodes().length; index++) {
                let elementCopy = table.rows({page: 'current'}).nodes()[index].cloneNode(true);
                customTable.getElementsByTagName('tbody')[0].appendChild(elementCopy);
            }
            
            return customTable;
        }

        // Chart Helper Functions
        function updateChart(chart, api) {
            while (chart.data.datasets[0].data.length > 0) {
                chart.data.datasets[0].data.pop();
            };

            fetch(api)
                .then((response) => response.json())
                .then((result) => chart.data.datasets[0].data.push(...result))
                .then(() => chart.update())
        }
    </script>

    {{-- Datatable and Datepicker --}}
    <script>
        let table;
        $(document).ready(function() {
        // -- Start Table --
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
                dom: 'Bfrtip',
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
                $('#reports-table_filter').append(`
                    <div style="float: left">
                        <div>
                            <label for="fini">@lang('From:')</label>
                            <input type="text" id="fini">
                        </div>
                        <div>
                            <label for="ffin" style="margin-right: 19px">@lang('To:')</label>
                            <input type="text" id="ffin">
                        </div>
                    </div>
                `);

                $('.dataTables_filter').css({'text-align': 'none'});

                $('.dataTables_filter').css({'float': 'none'});

                @if(app()->getLocale() === 'ar')
                    $('#ffin').prev().css({'margin-right': 0});
                @endif

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
                    $.getScript("{{ asset('assets/node_modules/datatables.net_plugins/range_dates.js') }}");
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

            $('#export-table-btn').on('click', () => {
                const wb = XLSX.utils.table_to_book(getPrintableTable(), {sheet: "Sheet 1"});

                XLSX.writeFile(wb, 'report.xlsx');
            })
        // -- End Table --

        // -- Start Chart --
            // Initiate datepicker
            const chartYearInput = $('#year-input-for-chart');
            chartYearInput.datepicker({
                format: "yyyy",
                startView: 2,
                minViewMode: 2,
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true,
            }).datepicker('setDate', 'today')
              .on('change', () => {
                    updateChart(chart1, chart1Api + chartYearInput.val());
                    updateChart(chart2, chart2Api + chartYearInput.val())
                });

            // Initiate Chart1
            @if (app()->getLocale() === 'ar')
                const months = moment().locale('ar').localeData().months();
            @else
                const months = moment.months();
            @endif


            const chart1 = new Chart(document.getElementById("chart-1"),
                {
                    "type": "line",
                    "data":
                        {
                            "labels": months,
                            "datasets":
                                [
                                    {
                                        "label": "@lang('Total per each month')",
                                        "data": [],
                                        "fill": true,
                                        "borderColor": "rgb(75, 192, 192)",
                                        "lineTension": 0.3
                                    }
                                ]
                        },
                    "options": {}
                }
            );
            const chart1Api = "@yield('chart1-api')/";
            updateChart(chart1, chart1Api + chartYearInput.val());

            // Initiate Chart2
            const chart2 = new Chart(document.getElementById("chart-2"),
                {
                    "type": "pie",
                    "data": {
                        "labels": ["@lang('Males')", "@lang('Females')"],
                        "datasets": [
                            {
                                "label": "@lang('Total of males and females')",
                                "data": [],
                                "backgroundColor": ["rgb(54, 162, 235)", "rgb(255, 99, 132)"]
                            }
                        ]
                    }
                }
            );
            const chart2Api = "@yield('chart2-api')/";
            updateChart(chart2, chart2Api + chartYearInput.val());
        // -- End Chart --
        });
    </script>
@endsection