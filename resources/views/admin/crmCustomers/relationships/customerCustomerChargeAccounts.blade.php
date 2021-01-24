<div class="m-3">
    @can('customer_charge_account_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.customer-charge-accounts.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.customerChargeAccount.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.customerChargeAccount.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-customerCustomerChargeAccounts">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.customerChargeAccount.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.customerChargeAccount.fields.date') }}
                            </th>
                            <th>
                                {{ trans('cruds.customerChargeAccount.fields.payment_type') }}
                            </th>
                            <th>
                                {{ trans('cruds.customerChargeAccount.fields.amount') }}
                            </th>
                            <th>
                                {{ trans('cruds.customerChargeAccount.fields.doc_no') }}
                            </th>
                            <th>
                                {{ trans('cruds.customerChargeAccount.fields.exchage_currency') }}
                            </th>
                            <th>
                                {{ trans('cruds.customerChargeAccount.fields.customer') }}
                            </th>
                            <th>
                                {{ trans('cruds.crmCustomer.fields.last_name') }}
                            </th>
                            <th>
                                {{ trans('cruds.customerChargeAccount.fields.currency') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customerChargeAccounts as $key => $customerChargeAccount)
                            <tr data-entry-id="{{ $customerChargeAccount->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $customerChargeAccount->id ?? '' }}
                                </td>
                                <td>
                                    {{ $customerChargeAccount->date ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\CustomerChargeAccount::PAYMENT_TYPE_SELECT[$customerChargeAccount->payment_type] ?? '' }}
                                </td>
                                <td>
                                    {{ $customerChargeAccount->amount ?? '' }}
                                </td>
                                <td>
                                    {{ $customerChargeAccount->doc_no ?? '' }}
                                </td>
                                <td>
                                    {{ $customerChargeAccount->exchage_currency ?? '' }}
                                </td>
                                <td>
                                    {{ $customerChargeAccount->customer->first_name ?? '' }}
                                </td>
                                <td>
                                    {{ $customerChargeAccount->customer->last_name ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\CustomerChargeAccount::CURRENCY_SELECT[$customerChargeAccount->currency] ?? '' }}
                                </td>
                                <td>
                                    @can('customer_charge_account_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.customer-charge-accounts.show', $customerChargeAccount->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('customer_charge_account_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.customer-charge-accounts.edit', $customerChargeAccount->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('customer_charge_account_delete')
                                        <form action="{{ route('admin.customer-charge-accounts.destroy', $customerChargeAccount->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('customer_charge_account_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.customer-charge-accounts.massDestroy') }}",
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
  let table = $('.datatable-customerCustomerChargeAccounts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection