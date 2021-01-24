<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerChargeAccountRequest;
use App\Http\Requests\UpdateCustomerChargeAccountRequest;
use App\Http\Resources\Admin\CustomerChargeAccountResource;
use App\Models\CustomerChargeAccount;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerChargeAccountsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('customer_charge_account_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CustomerChargeAccountResource(CustomerChargeAccount::with(['customer'])->get());
    }

    public function store(StoreCustomerChargeAccountRequest $request)
    {
        $customerChargeAccount = CustomerChargeAccount::create($request->all());

        return (new CustomerChargeAccountResource($customerChargeAccount))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CustomerChargeAccount $customerChargeAccount)
    {
        abort_if(Gate::denies('customer_charge_account_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CustomerChargeAccountResource($customerChargeAccount->load(['customer']));
    }

    public function update(UpdateCustomerChargeAccountRequest $request, CustomerChargeAccount $customerChargeAccount)
    {
        $customerChargeAccount->update($request->all());

        return (new CustomerChargeAccountResource($customerChargeAccount))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CustomerChargeAccount $customerChargeAccount)
    {
        abort_if(Gate::denies('customer_charge_account_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerChargeAccount->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
