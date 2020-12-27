<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTransactionDetailRequest;
use App\Http\Requests\StoreTransactionDetailRequest;
use App\Http\Requests\UpdateTransactionDetailRequest;
use App\Models\Product;
use App\Models\ProductsBase;
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

        $transactionDetails = TransactionDetail::with(['transaction', 'producto', 'productname'])->get();

        return view('admin.transactionDetails.index', compact('transactionDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('transaction_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactions = Transaction::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productos = ProductsBase::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productnames = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactionDetails.create', compact('transactions', 'productos', 'productnames'));
    }

    public function store(StoreTransactionDetailRequest $request)
    {
        $transactionDetail = TransactionDetail::create($request->all());

        return redirect()->route('admin.transaction-details.index');
    }

    public function edit(TransactionDetail $transactionDetail)
    {
        abort_if(Gate::denies('transaction_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactions = Transaction::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productos = ProductsBase::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productnames = Product::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transactionDetail->load('transaction', 'producto', 'productname');

        return view('admin.transactionDetails.edit', compact('transactions', 'productos', 'productnames', 'transactionDetail'));
    }

    public function update(UpdateTransactionDetailRequest $request, TransactionDetail $transactionDetail)
    {
        $transactionDetail->update($request->all());

        return redirect()->route('admin.transaction-details.index');
    }

    public function show(TransactionDetail $transactionDetail)
    {
        abort_if(Gate::denies('transaction_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactionDetail->load('transaction', 'producto', 'productname');

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
