<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTransactionRequest;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\CrmCustomer;
use App\Models\Transaction;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use App\Models\Provider;
use App\Models\Store;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TransactionsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        $typeTransaction = $request->transaction;
        abort_if(Gate::denies('transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transactions = Transaction::with(['status', 'type'])->where('type_id', '=', $typeTransaction)->get();
        // dd($transactions);
        foreach ($transactions as $transaction) {
            if ($typeTransaction == 1) {
                $transaction->store_destiny = Store::where('id', $transaction->store_destiny)->select('name')->firstOrFail();
                $transaction->store_destiny = $transaction->store_destiny->name;
                $transaction->provider = Provider::where('id', $transaction->provider)->select('name')->first();
                $transaction->provider = $transaction->provider->name;
            }
            if ($typeTransaction == 2) {
                $transaction->customer = CrmCustomer::where('id', $transaction->customer)->select('first_name', 'last_name')->first();
                $transaction->customer = $transaction->customer->first_name . ' ' . $transaction->customer->last_name;
                $transaction->store_origin = Store::where('id', $transaction->store_origin)->select('name')->first();
                $transaction->store_origin = $transaction->store_origin->name;
            }
        }

        $transaction_statuses = TransactionStatus::get();

        $transaction_types = TransactionType::get();

        return view('admin.transactions.index', compact('transactions', 'transaction_statuses', 'transaction_types', 'typeTransaction'));
    }

    public function create(Request $request)
    {
        $transaction = $request->transaction;
        $transactionId = 0;

        if ($request->data) {
            $param = explode('-', $request->data);
            $transactionId = $param[0];
            $transaction = $param[1];
        }

        //return $transaction;

        abort_if(Gate::denies('transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = TransactionStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = TransactionType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $providers = Provider::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.transactions.create', compact('statuses', 'types', 'providers', 'stores', 'transaction', 'transactionId'));
    }

    public function store(StoreTransactionRequest $request)
    {
        $transaction = Transaction::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $transaction->id]);
        }

        return redirect()->route('admin.transactions.index');
    }

    public function edit(Transaction $transaction)
    {
        abort_if(Gate::denies('transaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $statuses = TransactionStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = TransactionType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $transaction->load('status', 'type');

        return view('admin.transactions.edit', compact('statuses', 'types', 'transaction'));
    }

    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        dd('test');
        $transaction->update($request->all());

        return redirect()->route('admin.transactions.index');
    }

    public function show(Transaction $transaction)
    {
        abort_if(Gate::denies('transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaction->load('status', 'type', 'transactionTransactionDetails');

        return view('admin.transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        abort_if(Gate::denies('transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $transaction->delete();

        return back();
    }

    public function massDestroy(MassDestroyTransactionRequest $request)
    {
        Transaction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('transaction_create') && Gate::denies('transaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Transaction();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
