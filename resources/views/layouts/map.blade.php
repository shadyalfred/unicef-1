@extends('layouts.app')


@section('css')
    {{-- Datepicker --}}
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <style>
        #year-input:hover {
            cursor: pointer;
        }
    </style>

@endsection

{{-- Breadcrumb --}}
@section('additional-breadcrumb')
    <li class="breadcrumb-item"><a href="#">@lang('Maps')</a></li>
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
                        <input type="text" id="year-input" readonly
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
    {{-- Map helper function --}}
    <script type="text/javascript">
        const api = "@yield('map-api')/";
        @if (app()->getLocale() === 'ar')
            const locale = 'ar-EG';
        @else
            const locale = 'en-US'
        @endif

        function clearMap() {
            Object.keys( simplemaps_countrymap.mapdata.state_specific).forEach((governorateKey) => {
                delete simplemaps_countrymap.mapdata.state_specific[governorateKey].color;
                simplemaps_countrymap.mapdata.state_specific[governorateKey].description = "";
            });
        }

        function updateMap() {
            clearMap();

            fetch(api + yearInput.val(), {headers: {"Content-Language": "{{ app()->getLocale() }}"}})
                .then((response) => response.json())
                .then((resJson) => {
                    resJson.forEach((governorate) => {
                        const state = simplemaps_countrymap.mapdata.state_specific[governorate.map_key];
                        state.color = rgbHeatMapValue(governorate.total, resJson[0].total);
                        state.name = "<h3>" + governorate.name + "</h3>";
                        if (governorate.total && governorate.total_kids) {
                            state.description = `
                                <h6>@lang('Total:') ${Number(governorate.total).toLocaleString(locale)}</h6>
                                <h6>@lang('Beneficiaries:') ${Number(governorate.total_kids).toLocaleString(locale)}</h6>
                            `;
                        }
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
