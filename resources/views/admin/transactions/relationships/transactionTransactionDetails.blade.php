<div class="m-3">
    @can('transaction_detail_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.transaction-details.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.transactionDetail.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.transactionDetail.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-transactionTransactionDetails">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.transactionDetail.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.transactionDetail.fields.quantity') }}
                            </th>
                            <th>
                                {{ trans('cruds.transactionDetail.fields.transaction') }}
                            </th>
                            <th>
                                {{ trans('cruds.transaction.fields.date') }}
                            </th>
                            <th>
                                {{ trans('cruds.transactionDetail.fields.producto') }}
                            </th>
                            <th>
                                {{ trans('cruds.productsBase.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.transactionDetail.fields.product_stock') }}
                            </th>
                            <th>
                                {{ trans('cruds.transactionDetail.fields.productname') }}
                            </th>
                            <th>
                                {{ trans('cruds.product.fields.name') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactionDetails as $key => $transactionDetail)
                            <tr data-entry-id="{{ $transactionDetail->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $transactionDetail->id ?? '' }}
                                </td>
                                <td>
                                    {{ $transactionDetail->quantity ?? '' }}
                                </td>
                                <td>
                                    {{ $transactionDetail->transaction->name ?? '' }}
                                </td>
                                <td>
                                    {{ $transactionDetail->transaction->date ?? '' }}
                                </td>
                                <td>
                                    {{ $transactionDetail->producto->name ?? '' }}
                                </td>
                                <td>
                                    {{ $transactionDetail->producto->name ?? '' }}
                                </td>
                                <td>
                                    {{ $transactionDetail->product_stock ?? '' }}
                                </td>
                                <td>
                                    {{ $transactionDetail->productname->name ?? '' }}
                                </td>
                                <td>
                                    {{ $transactionDetail->productname->name ?? '' }}
                                </td>
                                <td>
                                    @can('transaction_detail_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.transaction-details.show', $transactionDetail->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('transaction_detail_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.transaction-details.edit', $transactionDetail->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('transaction_detail_delete')
                                        <form action="{{ route('admin.transaction-details.destroy', $transactionDetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('transaction_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transaction-details.massDestroy') }}",
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
  let table = $('.datatable-transactionTransactionDetails:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection