@extends('layouts.app')

@section('css')
    {{-- Datepicker --}}
    <link href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    {{-- Morris CSS --}}
    <link href="{{ asset('assets/node_modules/morrisjs/morris.css') }}" rel="stylesheet">

    <style>
        #year-input:hover {
            cursor: pointer;
        }
    </style>
@endsection

@section('page-title', __('Chart')) {{-- Make custom title for each page --}}

@section('content')
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
                        <input type="text" id="year-input" style="display: inline-block;
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
@endsection

@section('javascript')
    @parent

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
                updateChart2();
            });
        });
    </script>

    {{-- Chart Helper functions --}}
    <script type="text/javascript">
        const api2 = "@yield('api2')/";

        function updateChart2() {
            fetch(api2 + yearInput.val())
                .then((response) => response.json())
                .then((totals) => {
                    chart2.setData([
                        {label: "@lang('Males')", value: totals[0]},
                        {label: "@lang('Females')", value: totals[1]}
                    ])
                });
        }
    </script>

    {{-- Initiate charts --}}
    <script type="text/javascript">
        let chart2;
        $(document).ready(() => {
            chart2 = Morris.Donut(
                {
                    element: 'chart-2',
                    data: [{label: "", value: ""}],
                    resize: true,
                    colors: ['#40c4ff', '#ff8398']
                }
            );
            updateChart2()
        });
    </script>
@endsection