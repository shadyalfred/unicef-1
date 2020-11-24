@extends('layouts.report_index')

@section('page-title-breadcrumb', __('Edit Syrians Records'))
@section('pageTitle', __('Edit Syrians Records'))
@section('pageSubtitle', __('Edit Syrians Records'))

@section('firstColumn', __('Governorate'))

@section('tableData')
    @foreach($syriansReports as $syriansReport)
        <tr>
            <td>
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('reports.syrians.edit', $syriansReport->id) }}">
                            <i class="ti-pencil"></i>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="javascript:void()"
                           class="text-danger"
                           type="button"
                           data-record-id="{{ $syriansReport->id }}"
                           onclick="deleteRecord(this)">
                            <i class="ti-trash"></i>
                        </a>
                    </div>
                </div>
            </td>
            <td>
                {{ app()->getLocale() === 'en' ? $syriansReport->governorate->name_en  : $syriansReport->governorate->name_ar }}
            </td>
            <td>
                {{ $syriansReport->males_under_5 }}
            </td>
            <td>
                {{ $syriansReport->males_from_5_to_15 }}
            </td>
            <td>
                {{ $syriansReport->females_under_5 }}
            </td>
            <td>
                {{ $syriansReport->females_from_5_to_15 }}
            </td>
            <td>
                {{ $syriansReport->pregnancy_visits }}
            </td>
            <td>
                {{ $syriansReport->endangered_pregnancies }}
            </td>
            <td>
                {{ $syriansReport->other_visits }}
            </td>
            <td>
                {{ $syriansReport->males_above_15_visits }}
            </td>
            <td>
                {{ $syriansReport->date->format('m-Y') }}
            </td>
        </tr>
    @endforeach
@endsection

@section('javascript')
    @parent
    <form id="deleteForm" method="POST">
        @csrf
        @method('delete')
    </form>

    <script type="text/javascript">
        function deleteRecord(anchorElement) {
            const deleteRecordURL = '{{ route('reports.syrians.destroy', '') }}';
            const deleteForm = document.querySelector('#deleteForm');

            const formAction = deleteRecordURL + '/' + anchorElement.dataset.recordId;

            deleteForm.action = formAction;

            if (confirm("@lang('Are you sure?')")) {
                deleteForm.submit();
            }
        }
    </script>
@endsection
