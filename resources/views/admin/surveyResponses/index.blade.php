@extends('layouts.admin')
@section('content')
@can('survey_response_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.survey-responses.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.surveyResponse.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.surveyResponse.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SurveyResponse">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.surveyResponse.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.surveyResponse.fields.response') }}
                        </th>
                        <th>
                            {{ trans('cruds.surveyResponse.fields.survey_detail') }}
                        </th>
                        <th>
                            {{ trans('cruds.surveyResponse.fields.survey') }}
                        </th>
                        <th>
                            {{ trans('cruds.surveyResponse.fields.responder') }}
                        </th>
                        <th>
                            {{ trans('cruds.surveyResponder.fields.last_names') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($surveyResponses as $key => $surveyResponse)
                        <tr data-entry-id="{{ $surveyResponse->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $surveyResponse->id ?? '' }}
                            </td>
                            <td>
                                {{ $surveyResponse->response ?? '' }}
                            </td>
                            <td>
                                {{ $surveyResponse->survey_detail ?? '' }}
                            </td>
                            <td>
                                {{ $surveyResponse->survey->name ?? '' }}
                            </td>
                            <td>
                                {{ $surveyResponse->responder->names ?? '' }}
                            </td>
                            <td>
                                {{ $surveyResponse->responder->last_names ?? '' }}
                            </td>
                            <td>
                                @can('survey_response_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.survey-responses.show', $surveyResponse->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('survey_response_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.survey-responses.edit', $surveyResponse->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('survey_response_delete')
                                    <form action="{{ route('admin.survey-responses.destroy', $surveyResponse->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('survey_response_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.survey-responses.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-SurveyResponse:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection