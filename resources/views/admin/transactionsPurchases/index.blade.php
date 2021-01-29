@extends('layouts.admin')
@section('content')
@can('transaction_purchases_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.transaction-purchases.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.transactionPurchase.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transactionPurchase.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Transaction">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.transactionPurchase.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionPurchase.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionPurchase.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionPurchase.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionPurchase.fields.store_origin') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionPurchase.fields.store_destiny') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionPurchase.fields.customer') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionPurchase.fields.provider') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionPurchase.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.transactionPurchase.fields.type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($transaction_statuses as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($transaction_types as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactionPurchases as $key => $transaction)
                        <tr data-entry-id="{{ $transaction->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $transaction->id ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->date ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->amount ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->name ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->store_origin ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->store_destiny ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->customer ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->provider ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->status->name ?? '' }}
                            </td>
                            <td>
                                {{ $transaction->type->name ?? '' }}
                            </td>
                            <td>
                                @can('transaction_purchases_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.transaction-purchases.show', $transaction->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('transaction_purchases-edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.transaction-purchases.edit', $transaction->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('transaction_purchases_delete')
                                    <form action="{{ route('admin.transaction-purchases.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('transaction_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.transactions.massDestroy') }}",
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
  let table = $('.datatable-Transaction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection
