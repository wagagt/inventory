<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionStatusRequest;
use App\Http\Requests\StoreTransactionStatusRequest;
use App\Http\Requests\UpdateTransactionStatusRequest;
use App\Models\TransactionStatus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionStatusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transaction_status_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionStatuses = TransactionStatus::all();

        return view('admin.transactionStatuses.index', compact('transactionStatuses'));
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_status_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.transactionStatuses.create');
    }

    public function store(StoreTransactionStatusRequest $request)
    {
        $transactionStatus = TransactionStatus::create($request->all());

        return redirect()->route('admin.transaction-statuses.index');
    }

    public function edit(TransactionStatus $transactionStatus)
    {
        abort_if(Gate::denies('transaction_status_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.transactionStatuses.edit', compact('transactionStatus'));
    }

    public function update(UpdateTransactionStatusRequest $request, TransactionStatus $transactionStatus)
    {
        $transactionStatus->update($request->all());

        return redirect()->route('admin.transaction-statuses.index');
    }

    public function show(TransactionStatus $transactionStatus)
    {
        abort_if(Gate::denies('transaction_status_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionStatus->load('statusTransactions');

        return view('admin.transactionStatuses.show', compact('transactionStatus'));
    }

    public function destroy(TransactionStatus $transactionStatus)
    {
        abort_if(Gate::denies('transaction_status_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionStatus->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionStatusRequest $request)
    {
        TransactionStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
