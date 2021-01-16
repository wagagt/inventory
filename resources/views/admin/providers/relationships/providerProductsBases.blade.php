<div class="m-3">
    @can('products_base_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.products-bases.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.productsBase.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.productsBase.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-providerProductsBases">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.productsBase.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.productsBase.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.productsBase.fields.description') }}
                            </th>
                            <th>
                                {{ trans('cruds.productsBase.fields.stock') }}
                            </th>
                            <th>
                                {{ trans('cruds.productsBase.fields.min_stock') }}
                            </th>
                            <th>
                                {{ trans('cruds.productsBase.fields.max_stock') }}
                            </th>
                            <th>
                                {{ trans('cruds.productsBase.fields.category') }}
                            </th>
                            <th>
                                {{ trans('cruds.productsBase.fields.provider') }}
                            </th>
                            <th>
                                {{ trans('cruds.productsBase.fields.store') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productsBases as $key => $productsBase)
                            <tr data-entry-id="{{ $productsBase->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $productsBase->id ?? '' }}
                                </td>
                                <td>
                                    {{ $productsBase->name ?? '' }}
                                </td>
                                <td>
                                    {{ $productsBase->description ?? '' }}
                                </td>
                                <td>
                                    {{ $productsBase->stock ?? '' }}
                                </td>
                                <td>
                                    {{ $productsBase->min_stock ?? '' }}
                                </td>
                                <td>
                                    {{ $productsBase->max_stock ?? '' }}
                                </td>
                                <td>
                                    @foreach($productsBase->categories as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($productsBase->providers as $key => $item)
                                        <span class="badge badge-info">{{ $item->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $productsBase->store->name ?? '' }}
                                </td>
                                <td>
                                    @can('products_base_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.products-bases.show', $productsBase->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('products_base_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.products-bases.edit', $productsBase->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('products_base_delete')
                                        <form action="{{ route('admin.products-bases.destroy', $productsBase->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('products_base_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.products-bases.massDestroy') }}",
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
  let table = $('.datatable-providerProductsBases:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection