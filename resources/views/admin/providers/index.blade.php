@extends('layouts.admin')
@section('content')
@can('provider_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.providers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.provider.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.provider.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Provider">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.provider.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.provider.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.provider.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.provider.fields.zone') }}
                        </th>
                        <th>
                            {{ trans('cruds.provider.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.provider.fields.department') }}
                        </th>
                        <th>
                            {{ trans('cruds.provider.fields.contact_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.provider.fields.contact_email') }}
                        </th>
                        <th>
                            {{ trans('cruds.provider.fields.contact_phone') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($providers as $key => $provider)
                        <tr data-entry-id="{{ $provider->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $provider->id ?? '' }}
                            </td>
                            <td>
                                {{ $provider->name ?? '' }}
                            </td>
                            <td>
                                {{ $provider->address ?? '' }}
                            </td>
                            <td>
                                {{ $provider->zone ?? '' }}
                            </td>
                            <td>
                                {{ $provider->city ?? '' }}
                            </td>
                            <td>
                                {{ $provider->department ?? '' }}
                            </td>
                            <td>
                                {{ $provider->contact_name ?? '' }}
                            </td>
                            <td>
                                {{ $provider->contact_email ?? '' }}
                            </td>
                            <td>
                                {{ $provider->contact_phone ?? '' }}
                            </td>
                            <td>
                                @can('provider_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.providers.show', $provider->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('provider_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.providers.edit', $provider->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('provider_delete')
                                    <form action="{{ route('admin.providers.destroy', $provider->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('provider_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.providers.massDestroy') }}",
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
  let table = $('.datatable-Provider:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection