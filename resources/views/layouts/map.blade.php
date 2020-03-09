@extends('layouts.app')


@section('css')
    {{-- Datepicker --}}
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    <style>
        #to,
        #from {
            display: inline-block;
            width: 60px;
            border: none;
            border-bottom: 1px solid;
            text-align: center;
        }
        #to:hover,
        #from:hover {
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
            Object.keys(simplemaps_countrymap.mapdata.state_specific).forEach((governorateKey) => {
                delete simplemaps_countrymap.mapdata.state_specific[governorateKey].color;
                simplemaps_countrymap.mapdata.state_specific[governorateKey].description = "";
            });
        }

        function updateMap() {
            clearMap();

            let from = "01-" + fromDate.val();

            from = from.split("-");
            from.reverse();
            from = from.join("-");

            let to = "01-" + toDate.val();

            to = to.split("-");
            to.reverse();
            to = to.join("-");

            fetch(api + from + "/" + to, {headers: {"Content-Language": "{{ app()->getLocale() }}"}})
                .then((response) => response.json())
                .then((resJson) => {
                    resJson.forEach((governorate) => {
                        const state = simplemaps_countrymap.mapdata.state_specific[governorate.map_key];
                        state.color = rgbHeatMapValue(governorate.total, resJson[0].total);
                        state.name = "<h3>" + governorate.name + "</h3>";
                        if (governorate.total && governorate.total_kids) {
                            state.description = `
                                <h6>@lang('Total:') ${governorate.total.toLocaleString(locale)}</h6>
                                <h6>@lang('Beneficiaries:') ${governorate.total_kids.toLocaleString(locale)}</h6>
                            `;
                        }
                    });
                })
                .then(() => simplemaps_countrymap.load());
        }
    </script>
    {{-- Initiate datepicker --}}
    <script type="text/javascript">
        let fromDate;
        let toDate;

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
            }).datepicker('setDate', 'today')
              .on('changeDate', () => {
                  updateMap();
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
            }).datepicker('setDate', 'today')
              .on('changeDate', () => {
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
