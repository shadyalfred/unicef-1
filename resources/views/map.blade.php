@extends('layouts.app')

@section('page-title', __('Map'))

@section('page-title-breadcrumb', __('Map'))

@section('css')
    {{-- Datepicker --}}
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <style>
        #year-input:hover {
            cursor: pointer;
        }
    </style>

@endsection

@section('content')
    {{-- Select year --}}
    <div class="row">
        <div class="col-lg-2 mx-auto text-center">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        @lang('Select year')
                    </h4>
                    <div>
                        <input type="text" id="year-input"
                            style="display: inline-block; width: 50px; border: none;
                                   border-bottom: 1px solid; text-align: center">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Map --}}
    <div class="row">
        <div class="col-12">
            <div class="p-lg-5">
                <div id="map"></div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    {{-- Import Simplemaps --}}
    <script type="text/javascript" src="{{ asset('assets/node_modules/simplemaps/mapdata.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/node_modules/simplemaps/country.min.js') }}"></script>
    {{-- Import Datepicker --}}
    <script type="text/javascript" src="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    {{-- Import waitForElement --}}
    <script type="text/javascript" src="{{ asset('assets/node_modules/waitForElement.js') }}"></script>
    {{-- Import rgb_heat_map --}}
    <script type="text/javascript" src="{{ asset('assets/node_modules/rgb_heat_map.min.js') }}"></script>
    {{-- States keys --}}
    <script type="text/javascript">
        // usage: governorateKey[governorate_id - 1]
        const governorateKey = [ 
            'EGY1533',
            'EGY1543',
            'EGY1538',
            'EGY1531',
            'EGY1539',
            'EGY1537',
            'EGY1535',
            'EGY1534',
            'EGY1547',
            'EGY1530',
            'EGY1532',
            'EGY1541',
            'EGY1544',
            'EGY1542',
            'EGY1545',
            'EGY1549',
            'EGY1548',
            'EGY1540',
            'EGY1556'
        ];
    </script>
    {{-- Map helper function --}}
    <script type="text/javascript">
        const api = "{{ route('map-api', '') }}/";

        function updateMap() {
            fetch(api + yearInput.val(), {headers: {"Content-Language": "{{ app()->getLocale() }}"}})
                .then((response) => response.json())
                .then((resJson) => {
                    resJson.forEach((governorate) => {
                        const state = simplemaps_countrymap.mapdata.state_specific[governorateKey[governorate.id - 1]];
                        state.color = rgbHeatMapValue(governorate.total, resJson[0].total);
                        state.name = "<h3>" + governorate.name + "</h3>";
                        state.description = "<h6>" + "@lang('Total:') " + governorate.total + "</h6>";
                    });
                })
                .then(() => simplemaps_countrymap.load());
        }
    </script>
    {{-- Initiate datepicker --}}
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
                updateMap();
            });
        });
    </script>

    {{-- Initiate Simplemaps --}}
    <script type="text/javascript">
        $(document).ready(() => {
            waitForElement('#map_holder').then((el) => {
                el.classList.add('mx-auto')
            });
            updateMap();
        });
    </script>
@endsection