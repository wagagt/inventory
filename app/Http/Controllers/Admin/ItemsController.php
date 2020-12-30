<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyItemRequest;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use App\Models\ProductsBase;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = Item::with(['product'])->get();

        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        abort_if(Gate::denies('item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsBase::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.items.create', compact('products'));
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->all());

        return redirect()->route('admin.items.index');
    }

    public function edit(Item $item)
    {
        abort_if(Gate::denies('item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = ProductsBase::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $item->load('product');

        return view('admin.items.edit', compact('products', 'item'));
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        $item->update($request->all());

        return redirect()->route('admin.items.index');
    }

    public function show(Item $item)
    {
        abort_if(Gate::denies('item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $item->load('product', 'itemTransactionDetails');

        return view('admin.items.show', compact('item'));
    }

    public function destroy(Item $item)
    {
        abort_if(Gate::denies('item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $item->delete();

        return back();
    }

    public function massDestroy(MassDestroyItemRequest $request)
    {
        Item::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
