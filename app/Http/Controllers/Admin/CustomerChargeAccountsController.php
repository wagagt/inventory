<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCustomerChargeAccountRequest;
use App\Http\Requests\StoreCustomerChargeAccountRequest;
use App\Http\Requests\UpdateCustomerChargeAccountRequest;
use App\Models\CrmCustomer;
use App\Models\CustomerChargeAccount;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerChargeAccountsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('customer_charge_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerChargeAccounts = CustomerChargeAccount::with(['customer'])->get();

        return view('admin.customerChargeAccounts.index', compact('customerChargeAccounts'));
    }

    public function create()
    {
        abort_if(Gate::denies('customer_charge_account_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = CrmCustomer::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customerChargeAccounts.create', compact('customers'));
    }

    public function store(StoreCustomerChargeAccountRequest $request)
    {
        $customerChargeAccount = CustomerChargeAccount::create($request->all());

        return redirect()->route('admin.customer-charge-accounts.index');
    }

    public function edit(CustomerChargeAccount $customerChargeAccount)
    {
        abort_if(Gate::denies('customer_charge_account_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = CrmCustomer::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customerChargeAccount->load('customer');

        return view('admin.customerChargeAccounts.edit', compact('customers', 'customerChargeAccount'));
    }

    public function update(UpdateCustomerChargeAccountRequest $request, CustomerChargeAccount $customerChargeAccount)
    {
        $customerChargeAccount->update($request->all());

        return redirect()->route('admin.customer-charge-accounts.index');
    }

    public function show(CustomerChargeAccount $customerChargeAccount)
    {
        abort_if(Gate::denies('customer_charge_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerChargeAccount->load('customer');

        return view('admin.customerChargeAccounts.show', compact('customerChargeAccount'));
    }

    public function destroy(CustomerChargeAccount $customerChargeAccount)
    {
        abort_if(Gate::denies('customer_charge_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerChargeAccount->delete();

        return back();
    }

    public function massDestroy(MassDestroyCustomerChargeAccountRequest $request)
    {
        CustomerChargeAccount::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
