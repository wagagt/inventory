<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionTypeRequest;
use App\Http\Requests\StoreTransactionTypeRequest;
use App\Http\Requests\UpdateTransactionTypeRequest;
use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionPurchasesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transaction_purchases_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionPurchases = Transaction::where('Id', '=', 1);
        $transaction_statuses = TransactionStatus::get();
        $transaction_types = TransactionType::get();

        return view('admin.transactionsPurchases.index', compact('transactionPurchases', 'transaction_statuses', 'transaction_types'));
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.transactionTypes.create');
    }

    public function store(StoreTransactionTypeRequest $request)
    {
        $transactionType = TransactionType::create($request->all());

        return redirect()->route('admin.transaction-types.index');
    }

    public function edit(TransactionType $transactionType)
    {
        abort_if(Gate::denies('transaction_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.transactionTypes.edit', compact('transactionType'));
    }

    public function update(UpdateTransactionTypeRequest $request, TransactionType $transactionType)
    {
        $transactionType->update($request->all());

        return redirect()->route('admin.transaction-types.index');
    }

    public function show(TransactionType $transactionType)
    {
        abort_if(Gate::denies('transaction_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionType->load('typeTransactions');

        return view('admin.transactionTypes.show', compact('transactionType'));
    }

    public function destroy(TransactionType $transactionType)
    {
        abort_if(Gate::denies('transaction_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionTypeRequest $request)
    {
        TransactionType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
