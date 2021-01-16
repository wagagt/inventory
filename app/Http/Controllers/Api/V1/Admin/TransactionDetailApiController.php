<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionDetailRequest;
use App\Http\Requests\UpdateTransactionDetailRequest;
use App\Http\Resources\Admin\TransactionDetailResource;
use App\Models\TransactionDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionDetailApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transaction_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionDetailResource(TransactionDetail::with(['transaction', 'items'])->get());
    }

    public function store(StoreTransactionDetailRequest $request)
    {
        $transactionDetail = TransactionDetail::create($request->all());
        $transactionDetail->items()->sync($request->input('items', []));

        return (new TransactionDetailResource($transactionDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TransactionDetail $transactionDetail)
    {
        abort_if(Gate::denies('transaction_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionDetailResource($transactionDetail->load(['transaction', 'items']));
    }

    public function update(UpdateTransactionDetailRequest $request, TransactionDetail $transactionDetail)
    {
        $transactionDetail->update($request->all());
        $transactionDetail->items()->sync($request->input('items', []));

        return (new TransactionDetailResource($transactionDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TransactionDetail $transactionDetail)
    {
        abort_if(Gate::denies('transaction_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
