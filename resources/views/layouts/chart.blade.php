@extends('layouts.app')

@section('css')
    {{-- Datepicker --}}
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    {{-- Morris CSS --}}
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">

    <style>
        #to,
        #from,
        #year-input {
            display: inline-block;
            width: 60px;
            border: none;
            border-bottom: 1px solid;
            text-align: center;
        }
        #to:hover,
        #from:hover,
        #year-input:hover {
            cursor: pointer;
        }
    </style>
@endsection

{{-- Breadcrumb --}}
@section('additional-breadcrumb')
    <li class="breadcrumb-item"><a href="#">@lang('Charts')</a></li>
@endsection

@section('content')
    {{-- From - To Charts --}}
    <div class="row">
        <div class="col-lg-12">
            <h4 class="bg-info text-white p-3 text-center">@lang('Date Range Charts')</h4>
        </div>
    </div>
    {{-- Input --}}
    <div class="row">
        {{-- From Input --}}
        <div class="col-lg-2 text-center ml-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('From')
                    </h4>
                    <input type="text" id="from" readonly>
                </div>
            </div>
        </div>
        {{-- To Input --}}
        <div class="col-lg-2 text-center mr-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('To')
                    </h4>
                    <input type="text" id="to" readonly>
                </div>
            </div>
        </div>
    </div>
    {{-- Charts --}}
    {{-- Totals Chart For Date Range --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Total')
                    </h4>
                    <div id="range-chart-1"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Total Beneficiaries')
                    </h4>
                    <div id="range-chart-2"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Yearly Totals Charts --}}
    <div class="row">
        <div class="col-lg-12">
            <h4 class="bg-info text-white p-3 text-center">@lang('Yearly Totals Charts')</h4>
        </div>
    </div>
    {{-- Start charts --}}
    {{-- Select year --}}
    <div class="row">
        <div class="col-lg-2 mx-auto text-center">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Select year')
                    </h4>
                    <div>
                        <input type="text" id="year-input" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row">
        {{-- Total per each month --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Total per each month')
                    </h4>
                    <div id="chart-1"></div>
                </div>
            </div>
        </div>

        {{-- Total per each governorate/country --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Total males and females')
                    </h4>
                    <div id="chart-2"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @yield('chart-3-title')
                    </h4>
                    <div id="chart-3"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    {{-- Moment with locales --}}
    <script type="text/javascript" src="{{ asset('assets/node_modules/moment/moment-with-locales.min.js') }}"></script>

    {{-- Datepicker --}}
    <script type="text/javascript" src="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/node_modules/bootstrap-datepicker/locales/ar.js') }}" charset="UTF-8"></script>

    <!--Morris JavaScript -->
    <script type="text/javascript" src="{{ asset('assets/node_modules/raphael/raphael-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/node_modules/morrisjs/morris.js') }}"></script>

    {{-- Format Date Helper Function --}}
    <script type="text/javascript">
        function formatDate(date) {
            return moment(date, "MM-YYYY").format("YYYY-MM-01");
        }
    </script>

    {{-- Initiate year datepicker --}}
    <script type="text/javascript">
        let fromDate;
        let yearInput;

        $(document).ready(() => {
            fromDate = $('#from');
            fromDate.datepicker({
                format: "mm-yyyy",
                startView: 1,
                minViewMode: 1,
                maxViewMode: 3,
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true,
                orientation: "bottom"
            }).datepicker('setDate', 'today');
            fromDate.on('changeDate', () => {
                updateRangeChart1();
                updateRangeChart2();
            });

            toDate = $('#to');
            toDate.datepicker({
                format: "mm-yyyy",
                startView: 1,
                minViewMode: 1,
                maxViewMode: 3,
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true,
                orientation: "bottom"
            }).datepicker('setDate', 'today');
            toDate.on('changeDate', () => {
                updateRangeChart1();
                updateRangeChart2();
            });

            updateRangeChart1();
            updateRangeChart2();

            yearInput = $('#year-input');
            yearInput.datepicker({
                format: "yyyy",
                startView: 2,
                minViewMode: 2,
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true,
            }).datepicker('setDate', 'today');
            yearInput.on('changeDate', () => {
                updateChart1();
                updateChart2();
                updateChart3();
            });
        });
    </script>

    {{-- Chart Helper functions --}}
    <script type="text/javascript">
        // Range Charts
        const rangeApi1 = "@yield('range-api-1')/";
        const rangeApi2 = "@yield('range-api-2')/";

        function updateRangeChart1() {
            if (fromDate.val() && toDate.val()) {
                const api = rangeApi1 + formatDate(fromDate.val()) + "/" + formatDate(toDate.val());
                fetch(api, {headers: {"Content-Language": "{{ app()->getLocale() }}"}})
                    .then((response) => response.json())
                    .then((data) => rangeChart1.setData(data));
            }
        }

        function updateRangeChart2() {
            if (fromDate.val() && toDate.val()) {
                const api = rangeApi2 + formatDate(fromDate.val()) + "/" + formatDate(toDate.val());
                fetch(api, {headers: {"Content-Language": "{{ app()->getLocale() }}"}})
                    .then((response) => response.json())
                    .then((data) => rangeChart2.setData(data));
            }
        }

        // Yearly Charts
        const api1 = "@yield('api1')/";
        const api2 = "@yield('api2')/";
        const api3 = "@yield('api3')/";

        @if (app()->getLocale() === 'ar')
            const months = moment().locale('ar').localeData().months();
        @else
            const months = moment.months()
        @endif

        function updateChart1() {
            fetch(api1 + yearInput.val())
                .then((response) => response.json())
                .then((totals) => {
                    const data = [];

                    for (let i = 0; i < totals.length; i++) {
                        const total = totals[i];
                        const month = months[i];

                        data.push({month: month, total: total})
                    }

                    chart1.setData(data);
                });
        }

        function updateChart2() {
            fetch(api2 + yearInput.val())
                .then((response) => response.json())
                .then((totals) => {
                    chart2.setData([
                        {label: "@lang('Males')", value: totals[0]},
                        {label: "@lang('Females')", value: totals[1]}
                    ]);
                });
        }

        function updateChart3() {
            fetch(api3 + yearInput.val(), {headers: {"Content-Language": "{{ app()->getLocale() }}"}})
                .then((response) => response.json())
                .then((data) => chart3.setData(data));
        }
    </script>

    {{-- From - To Charts --}}
    <script type="text/javascript">
        let rangeChart1;
        let rangeChart2;

        $(document).ready(() => {
            rangeChart1 = Morris.Bar(
                {
                    element: 'range-chart-1',
                    data: [{governorate: null, total: null, males: null, females: null}],
                    xkey: "@yield('range-chart-1-xkey')",
                    ykeys: ['total', 'males', 'females'],
                    labels: ["@lang('Total')", "@lang('Males')", "@lang('Females')"],
                    barColors: ['#55ce63', '#40c4ff', '#ff8398'],
                    hideHover: 'auto',
                    gridLineColor: '#eef0f2',
                    resize: true
                }
            )

            rangeChart2 = Morris.Bar(
                {
                    element: 'range-chart-2',
                    data: [{governorate: null, total: null, males: null, females: null}],
                    xkey: "@yield('range-chart-1-xkey')",
                    ykeys: ['total', 'males', 'females'],
                    labels: ["@lang('Total')", "@lang('Males')", "@lang('Females')"],
                    barColors: ['#55ce63', '#40c4ff', '#ff8398'],
                    hideHover: 'auto',
                    gridLineColor: '#eef0f2',
                    resize: true
                }
            )
        });
    </script>

    {{-- Initiate yearly charts --}}
    <script type="text/javascript">
        let chart1;
        let chart2;
        let chart3;

        $(document).ready(() => {
            chart1 = Morris.Bar(
                {
                    element: 'chart-1',
                    data: [{month: "", total: 0}],
                    xkey: 'month',
                    ykeys: ['total'],
                    labels: ["@lang('Total')"],
                    barColors: ['#55ce63'],
                    hideHover: 'auto',
                    gridLineColor: '#eef0f2',
                    resize: true
                }
            );
            chart2 = Morris.Donut(
                {
                    element: 'chart-2',
                    data: [{label: "", value: ""}],
                    resize: true,
                    colors: ['#40c4ff', '#ff8398']
                }
            );
            chart3 = Morris.Bar(
                {
                    element: 'chart-3',
                    data: [{governorate: null, total: null, males: null, females: null}],
                    xkey: "@yield('chart-3-xkey')",
                    ykeys: ['total', 'males', 'females'],
                    labels: ["@lang('Total')", "@lang('Males')", "@lang('Females')"],
                    barColors: ['#55ce63', '#40c4ff', '#ff8398'],
                    hideHover: 'auto',
                    gridLineColor: '#eef0f2',
                    resize: true
                }
            );

            updateChart1();
            updateChart2();
            updateChart3();
        });
    </script>
@endsection
