<?php

namespace App\Http\Livewire;

use App\Models\CrmCustomer;
use App\Models\Product;
use Livewire\Component;
use App\Models\TransactionStatus;
use App\Models\TransactionType;
use App\Models\Provider;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\TransactionDetail;

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


    public function mount($data)
    {
        $this->allProducts = Product::all();
        $this->type_id = $data->type;
        $this->transactionId = $data->transactionId;
        if ($this->transactionId > 0) {
            $currentTransaction = Transaction::find($this->transactionId);

            $this->date = $currentTransaction->date;
            $this->description = $currentTransaction->description;
            $this->amount = $currentTransaction->amount;
            $this->provider_id = $currentTransaction->provider_id;
            $this->store_destiny_id = $currentTransaction->store_destiny_id;
            // $this->date = $currentTransaction->date;
            // dd($currentTransaction);
            $currentDetail = TransactionDetail::Where('transaction_id', '=', $this->transactionId)->get();
            // foreach ($currentDetail as $product) {
            //     $this->invoiceProducts[]['product_name'] = $product->name;
            //     $this->invoiceProducts[]['product_price'] = $product->price;
            //     $this->invoiceProducts[]['is_saved'] = true;
            // }
            //dd($currentDetail);
        }
    }

    public function render()
    {
        $total = 0;

        $statuses = TransactionStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = TransactionType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $providers = Provider::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customers = CrmCustomer::all()->pluck('last_name', 'id')->prepend(trans('global.pleaseSelect'), '');

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
            $details = TransactionDetail::Create([
                'transaction_id' => $transaction['id'],
                'quantity' => $product['quantity']
            ]);

            /** Actualización de Stock al realizar Compra */
            if ($this->type_id == 1) {
                $currentProduct = Product::find($product['product_id']);
                $currentProduct->stock += $product['quantity'];
                $currentProduct->save();
            }

            /** Actualización de Stock al realizar Venta */
            if ($this->type_id == 2) {
                $currentProduct = Product::find($product['product_id']);
                $currentProduct->stock -= $product['quantity'];
                $currentProduct->save();
            }
        }

        $this->reset('invoiceProducts', 'date', 'amount', 'description', 'type_id', 'provider_id', 'store_destiny_id');
        $this->invoiceSaved = true;
    }
}
