<?php

namespace App\Http\Livewire;

use App\Models\CrmCustomer;
use App\Models\Item;
use App\Models\ItemTransactionDetail;
use App\Models\Product;
use Livewire\Component;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use App\Models\Provider;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class InvoiceCreate extends Component
{
    public $invoiceProducts = [];
    public $allProducts = [];
    public $taxes = 20;
    public $date;
    public $amount;
    public $description;
    public $store_origin_id;
    public $store_destiny_id;
    public $customer_id;
    public $provider_id;
    public $type_id;
    public $status_id;
    public $invoiceSaved = false;
    public $transactionId;
    public $action = 1;


    public function mount($data)
    {
        $this->allProducts = Product::all();
        $this->type_id = $data->type;
        $this->transactionId = $data->transactionId;
        if ($this->transactionId > 0) {
            $this->action = 2;
            $currentTransaction = Transaction::find($this->transactionId);
            $this->date = $currentTransaction->date;
            $this->description = $currentTransaction->description;
            $this->amount = $currentTransaction->amount;
            $this->provider_id = $currentTransaction->provider;
            $this->store_destiny_id = $currentTransaction->store_destiny;
            $this->customer_id = $currentTransaction->customer;
            $this->store_origin_id = $currentTransaction->store_origin;
            // $this->date = $currentTransaction->date;
            $currentDetails = TransactionDetail::Where('transaction_id', '=', $this->transactionId)->get();
            $index = 0;
            // dd($currentDetails);
            foreach ($currentDetails as $detail) {
                $currentItem = Item::Where('transaction_detail', '=', $detail->id)->firstOrFail();
                // dd($currentItem);
                $currentProduct = Product::Where('id', '=', $currentItem->product_id)->Select('id', 'name', 'description', 'price')->firstOrFail();
                // dd($currentProduct);
                $this->invoiceProducts[$index]['product_id'] = $currentProduct->id;
                $this->invoiceProducts[$index]['quantity'] = $detail->quantity;
                $this->invoiceProducts[$index]['product_name'] = $currentProduct->name;
                $this->invoiceProducts[$index]['product_price'] = $currentProduct->price;
                $this->invoiceProducts[$index]['is_saved'] = true;
                $index++;
            }


            // foreach ($currentDetail as $product) {

            // }

        }
    }

    public function render()
    {
        $total = 0;

        $statuses = TransactionStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = TransactionType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $providers = Provider::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = CrmCustomer::all()->pluck('full_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        foreach ($this->invoiceProducts as $invoiceProduct) {
            if ($invoiceProduct['is_saved'] && $invoiceProduct['product_price'] && $invoiceProduct['quantity']) {
                $total += $invoiceProduct['product_price'] * $invoiceProduct['quantity'];
            }
        }

        $this->amount = $total;

        return view('livewire.invoice-create', [
            'subtotal' => $total,
            'total' => $total,
            'amount' => $this->amount,
            'description' => $this->description,
            'statuses' => $statuses,
            'types' => $types,
            'providers' => $providers,
            'stores' => $stores,
            'customers' => $customers
            // 'total' => $total * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100)
        ]);
    }

    public function addProduct()
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct) {
            if (!$invoiceProduct['is_saved']) {
                $this->addError('invoiceProducts.' . $key, 'This line must be saved before creating a new one.');
                return;
            }
        }

        $this->invoiceProducts[] = [
            'product_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'product_name' => '',
            'product_price' => 0
        ];

        $this->invoiceSaved = false;
    }

    public function editProduct($index)
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct) {
            if (!$invoiceProduct['is_saved']) {
                $this->addError('invoiceProducts.' . $key, 'This line must be saved before editing another.');
                return;
            }
        }

        $this->invoiceProducts[$index]['is_saved'] = false;
    }

    public function saveProduct($index)
    {
        $this->resetErrorBag();
        if ($this->type_id == 2) {
            $existencia = DB::Select("
                                        SELECT count(*) as total
                                            FROM items
                                            WHERE product_id = {$this->invoiceProducts[$index]['product_id']}
                                            AND store_id = {$this->store_origin_id}
                                    ");
            if ($existencia[0]->total < $this->invoiceProducts[$index]['quantity']) {
                $this->addError('invoiceProducts.' . $index, 'En la Bodega Seleccionada NO hay existencia para cumplir con este requerimiento!!.');
                return;
            }
        }

        $product = $this->allProducts->find($this->invoiceProducts[$index]['product_id']);
        $this->invoiceProducts[$index]['product_name'] = $product->name;
        $this->invoiceProducts[$index]['product_price'] = $product->price;
        $this->invoiceProducts[$index]['is_saved'] = true;
    }

    public function removeProduct($index)
    {
        unset($this->invoiceProducts[$index]);
        $this->invoiceProducts = array_values($this->invoiceProducts);
    }

    public function saveInvoice()
    {
        if ($this->action == 1) {
            $transaction = Transaction::create([
                'date' => $this->date,
                'description' => $this->description,
                'amount' => $this->amount,
                'store_origin' => $this->store_origin_id,
                'store_destiny' => $this->store_destiny_id,
                'customer' => $this->customer_id,
                'provider' => $this->provider_id,
                'status_id' => $this->status_id,
                'type_id' => $this->type_id,
            ]);

            foreach ($this->invoiceProducts as $product) {
                $detail = TransactionDetail::Create([
                    'transaction_id' => $transaction['id'],
                    'quantity' => $product['quantity']
                ]);

                /** Actualización de Stock al realizar Compra */
                if ($this->type_id == 1) {
                    $currentProduct = Product::find($product['product_id']);
                    $currentProduct->stock += $product['quantity'];
                    $currentProduct->save();

                    for ($i = 0; $i < $product['quantity']; $i++) {
                        $item = Item::create([
                            'price' => $product['product_price'],
                            'transaction_detail' => $detail['id'],
                            'status' => 'Stock',
                            'product_id' => $product['product_id'],
                            'store_id' => $this->store_destiny_id,
                        ]);

                        $itemsTransaction = ItemTransactionDetail::Create([
                            'transaction_detail_id' => $detail['id'],
                            'item_id' => $item['id']
                        ]);
                    }
                }

                /** Actualización de Stock al realizar Venta */
                if ($this->type_id == 2) {
                    $currentProduct = Product::find($product['product_id']);
                    $currentProduct->stock -= $product['quantity'];
                    $currentProduct->save();

                    for ($i = 0; $i < $product['quantity']; $i++) {
                        $item = Item::where('product_id', '=', $product['product_id'])->where('store_id', '=', $this->store_origin_id)->first();

                        $itemsTransaction = ItemTransactionDetail::Create([
                            'transaction_detail_id' => $detail['id'],
                            'item_id' => $item['id']
                        ]);

                        Item::where('id', '=', $item->id + $i)
                            ->update(['status' => 'Decrease', 'transaction_detail' => $detail['id']]);
                    }
                }
            }
        } else {

            Transaction::where('id', $this->transactionId)
                ->update([
                    'date' => $this->date, 'amount' => $this->amount, 'description' => $this->description, 'store_origin' => $this->store_origin_id,
                    'store_destiny' => $this->store_destiny_id, 'customer' => $this->customer_id, 'provider' => $this->provider_id,
                    'status_id' => $this->status_id, 'type_id' => $this->type_id
                ]);

            foreach ($this->invoiceProducts as $product) {
                $id_product = $product['product_id'];
                $product_detail_id =    DB::Select("
                                        SELECT DISTINCT
                                            td.id
                                        FROM
                                            transaction_details as td
                                        INNER JOIN
                                            items as i
                                        ON
                                            i.transaction_detail = td.id
                                        WHERE
                                            td.transaction_id = {$this->transactionId}
                                        AND
                                            i.product_id = {$id_product}
                                    ");

                $productDetailId = $product_detail_id[0]->id;

                TransactionDetail::where('id', '=', $productDetailId)
                    ->update(['quantity' => $product['quantity']]);

                $quantityItems = DB::Select("
                                                SELECT count(*) as total FROM items WHERE transaction_detail = {$productDetailId}
                                            ");
                $quantityItems = $quantityItems[0]->total;

                if ($quantityItems > $product['quantity']) {

                    $deleteItems = $quantityItems - $product['quantity'];

                    $currentProduct = Product::find($product['product_id']);
                    $currentProduct->stock -= $deleteItems;
                    $currentProduct->save();

                    for ($i = 0; $i < $deleteItems; $i++) {
                        $item = Item::where('product_id', $product['product_id'])->where('transaction_detail', $productDetailId)->first();
                        Item::where('id', '=', $item->id + $i)
                            ->update(['status' => 'Decrease']);
                    }
                }

                if ($quantityItems < $product['quantity']) {

                    $addItems = $product['quantity'] - $quantityItems;

                    $currentProduct = Product::find($product['product_id']);
                    $currentProduct->stock += $deleteItems;
                    $currentProduct->save();

                    for ($i = 0; $i < $addItems; $i++) {
                        $item = Item::create([
                            'price' => $product['product_price'],
                            'transaction_detail' => $productDetailId,
                            'status' => 'stock',
                            'product_id' => $product['product_id'],
                            'store_id' => $this->store_destiny_id,
                        ]);
                    }
                }
            }
        }

        $this->reset('invoiceProducts', 'date', 'amount', 'description', 'provider_id', 'store_destiny_id');
        $this->invoiceSaved = true;
    }
}
