<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionStatusRequest;
use App\Http\Requests\UpdateTransactionStatusRequest;
use App\Http\Resources\Admin\TransactionStatusResource;
use App\Models\TransactionStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionStatusApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transaction_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionStatusResource(TransactionStatus::all());
    }

    public function store(StoreTransactionStatusRequest $request)
    {
        $transactionStatus = TransactionStatus::create($request->all());

        return (new TransactionStatusResource($transactionStatus))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TransactionStatus $transactionStatus)
    {
        abort_if(Gate::denies('transaction_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TransactionStatusResource($transactionStatus);
    }

    public function update(UpdateTransactionStatusRequest $request, TransactionStatus $transactionStatus)
    {
        $transactionStatus->update($request->all());

        return (new TransactionStatusResource($transactionStatus))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TransactionStatus $transactionStatus)
    {
        abort_if(Gate::denies('transaction_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionStatus->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
