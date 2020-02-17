@extends('layouts.report')

@section('content')
    @parent
    <div id="main-wrapper">
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    @lang('Monthly Records')
                                </h4>
                                <h6 class="card-subtitle">
                                    @lang('Monthly records for each nationality')
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
                                                <th rowspan="3">@lang('Country')</th>
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
                                                <th rowspan="3">@lang('Country')</th>
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
            </div>
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

        <!-- Footer -->
        <!-- ============================================================== -->
        <footer class="footer">
            © 2019 Eliteadmin by themedesigner.in
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
@endsection


@section('javascript')
    @parent

    @section('api-url', route('getAllCountriesReports'))

    @section('table-col', "country")

    @section('table-head')
        <th rowspan="3">@lang('Country')</th>
    @endsection
@endsection
