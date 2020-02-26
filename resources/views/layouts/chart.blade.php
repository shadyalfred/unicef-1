@extends('layouts.app')

@section('css')
    {{-- Datepicker --}}
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    {{-- Morris CSS --}}
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">

    <style>
        #year-input:hover {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
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
                        <input type="text" id="year-input" readonly
                            style="display: inline-block;
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
    @parent

    {{-- Moment with locales --}}
    <script type="text/javascript" src="{{ asset('assets/node_modules/moment/moment-with-locales.min.js') }}"></script>

    {{-- Datepicker --}}
    <script type="text/javascript" src="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <!--Morris JavaScript -->
    <script type="text/javascript" src="{{ asset('assets/node_modules/raphael/raphael-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/node_modules/morrisjs/morris.js') }}"></script>

    {{-- Initiate year datepicker --}}
    <script type="text/javascript">
        let yearInput;
        $(document).ready(() => {
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
        const api1 = "@yield('api1')/"
        const api2 = "@yield('api2')/";
        const api3 = "@yield('api3')/"

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

    {{-- Initiate charts --}}
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
