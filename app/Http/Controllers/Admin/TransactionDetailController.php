<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionDetailRequest;
use App\Http\Requests\StoreTransactionDetailRequest;
use App\Http\Requests\UpdateTransactionDetailRequest;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionDetailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('transaction_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionDetails = TransactionDetail::with(['transaction', 'items'])->get();

        return view('admin.transactionDetails.index', compact('transactionDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactions = Transaction::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = Item::all()->pluck('serial_number', 'id');

        return view('admin.transactionDetails.create', compact('transactions', 'items'));
    }

    public function store(StoreTransactionDetailRequest $request)
    {
        $transactionDetail = TransactionDetail::create($request->all());
        $transactionDetail->items()->sync($request->input('items', []));

        return redirect()->route('admin.transaction-details.index');
    }

    public function edit(TransactionDetail $transactionDetail)
    {
        abort_if(Gate::denies('transaction_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactions = Transaction::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $items = Item::all()->pluck('serial_number', 'id');

        $transactionDetail->load('transaction', 'items');

        return view('admin.transactionDetails.edit', compact('transactions', 'items', 'transactionDetail'));
    }

    public function update(UpdateTransactionDetailRequest $request, TransactionDetail $transactionDetail)
    {
        $transactionDetail->update($request->all());
        $transactionDetail->items()->sync($request->input('items', []));

        return redirect()->route('admin.transaction-details.index');
    }

    public function show(TransactionDetail $transactionDetail)
    {
        abort_if(Gate::denies('transaction_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionDetail->load('transaction', 'items');

        return view('admin.transactionDetails.show', compact('transactionDetail'));
    }

    public function destroy(TransactionDetail $transactionDetail)
    {
        abort_if(Gate::denies('transaction_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionDetailRequest $request)
    {
        TransactionDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
