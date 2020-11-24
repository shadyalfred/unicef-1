@extends('layouts.report_index')

@section('page-title-breadcrumb', __('Edit Governorate Records'))
@section('pageTitle', __('Edit Governorate Records'))
@section('pageSubtitle', __('Edit Governorate Records'))

@section('firstColumn', __('Governorate'))

@section('tableData')
    @foreach($governorateReports as $governorateReport)
        <tr>
            <td>
                <div class="row">
                    <div class="col-6">
                        <a href="{{ route('reports.governorate.edit', $governorateReport->id) }}">
                            <i class="ti-pencil"></i>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="javascript:void()"
                           class="text-danger"
                           type="button"
                           data-record-id="{{ $governorateReport->id }}"
                           onclick="deleteRecord(this)">
                            <i class="ti-trash"></i>
                        </a>
                    </div>
                </div>
            </td>
            <td>
                {{ app()->getLocale() === 'en' ? $governorateReport->governorate->name_en  : $governorateReport->governorate->name_ar }}
            </td>
            <td>
                {{ $governorateReport->males_under_5 }}
            </td>
            <td>
                {{ $governorateReport->males_from_5_to_15 }}
            </td>
            <td>
                {{ $governorateReport->females_under_5 }}
            </td>
            <td>
                {{ $governorateReport->females_from_5_to_15 }}
            </td>
            <td>
                {{ $governorateReport->pregnancy_visits }}
            </td>
            <td>
                {{ $governorateReport->endangered_pregnancies }}
            </td>
            <td>
                {{ $governorateReport->other_visits }}
            </td>
            <td>
                {{ $governorateReport->males_above_15_visits }}
            </td>
            <td>
                {{ $governorateReport->date->format('m-Y') }}
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
            const deleteRecordURL = '{{ route('reports.governorate.destroy', '') }}';
            const deleteForm = document.querySelector('#deleteForm');

            const formAction = deleteRecordURL + '/' + anchorElement.dataset.recordId;

            deleteForm.action = formAction;

            if (confirm("@lang('Are you sure?')")) {
                deleteForm.submit();
            }
        }
    </script>
@endsection
