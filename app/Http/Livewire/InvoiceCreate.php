<?php

namespace App\Http\Livewire;

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
    public $name;
    public $type_id;
    public $provider_id;
    public $store_id;
    public $invoiceSaved = false;

    public function mount()
    {
        $this->allProducts = Product::all();
    }

    public function render()
    {
        $total = 0;
        $statuses = TransactionStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = TransactionType::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $providers = Provider::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stores = Store::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        foreach ($this->invoiceProducts as $invoiceProduct) {
            if ($invoiceProduct['is_saved'] && $invoiceProduct['product_price'] && $invoiceProduct['quantity']) {
                $total += $invoiceProduct['product_price'] * $invoiceProduct['quantity'];
            }
        }

        return view('livewire.invoice-create', [
            'subtotal' => $total,
            'total' => $total,
            'statuses' => $statuses,
            'types' => $types,
            'providers' => $providers,
            'stores' => $stores
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
            'amount' => $this->amount,
            'name' => $this->name,
            'type_id' => $this->type_id,
            'provider_id' => $this->provider_id,
            'store_id' => $this->store_id,
        ]);


        foreach ($this->invoiceProducts as $product) {
            $transaction->transactionTransactionDetails()->attach(
                $product['product_id'],
                [
                    'quantity' => $product['quantity']
                ]
            );
        }

        $this->reset('invoiceProducts', 'date', 'amount', 'name', 'type_id', 'provider_id', 'store_id');
        $this->invoiceSaved = true;
    }
}
