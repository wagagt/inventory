<div>
    @if ($invoiceSaved)
        <div class="alert alert-info">Invoice saved successfully.</div>
    @endif
    <form wire:submit.prevent="saveInvoice">
        @csrf
        <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : '' }}">
            <label>Customer name</label>
            <input wire:model="customer_name" type="text" name="customer_name" class="form-control"
                   value="{{ old('customer_name') }}" required>
            @if($errors->has('customer_name'))
                <em class="invalid-feedback">
                    {{ $errors->first('customer_name') }}
                </em>
            @endif
        </div>
        <div class="form-group {{ $errors->has('customer_email') ? 'has-error' : '' }}">
            <label>Customer email</label>
            <input wire:model="customer_email" type="email" name="customer_email" class="form-control"
                   value="{{ old('customer_email') }}">
            @if($errors->has('customer_email'))
                <em class="invalid-feedback">
                    {{ $errors->first('customer_email') }}
                </em>
            @endif
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Products
            </div>

            <div class="card-body">
                <table class="table" id="products_table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th width="150">Quantity</th>
                        <th width="150"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($invoiceProducts as $index => $invoiceProduct)
                        <tr>
                            <td>
                                @if($invoiceProduct['is_saved'])
                                    <input type="hidden" name="invoiceProducts[{{$index}}][product_id]"
                                           wire:model="invoiceProducts.{{$index}}.product_id" />
                                    @if($invoiceProduct['product_name'] && $invoiceProduct['product_price'])
                                        {{ $invoiceProduct['product_name'] }}
                                        (${{ number_format($invoiceProduct['product_price'], 2) }})
                                    @endif
                                @else
                                    <select name="invoiceProducts[{{$index}}][product_id]"
                                            class="form-control{{ $errors->has('invoiceProducts.' . $index) ? ' is-invalid' : '' }}"
                                            wire:model="invoiceProducts.{{$index}}.product_id">
                                        <option value="">-- choose product --</option>
                                        @foreach ($allProducts as $product)
                                            <option value="{{ $product->id }}">
                                                {{ $product->name }} (${{ number_format($product->price, 2) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('invoiceProducts.' . $index))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('invoiceProducts.' . $index) }}
                                        </em>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($invoiceProduct['is_saved'])
                                    <input type="hidden" name="invoiceProducts[{{$index}}][quantity]"
                                           wire:model="invoiceProducts.{{$index}}.quantity" />
                                    {{ $invoiceProduct['quantity'] }}
                                @else
                                    <input type="number" name="invoiceProducts[{{$index}}][quantity]"
                                           class="form-control" wire:model="invoiceProducts.{{$index}}.quantity" />
                                @endif
                            </td>
                            <td>
                                @if($invoiceProduct['is_saved'])
                                    <button class="btn btn-sm btn-primary"
                                            wire:click.prevent="editProduct({{$index}})">
                                        Edit
                                    </button>
                                @elseif($invoiceProduct['product_id'])
                                    <button class="btn btn-sm btn-success mr-1"
                                            wire:click.prevent="saveProduct({{$index}})">
                                        Save
                                    </button>
                                @endif
                                <button class="btn btn-sm btn-danger"
                                        wire:click.prevent="removeProduct({{$index}})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-secondary"
                                wire:click.prevent="addProduct">+ Add Product</button>
                    </div>
                </div>

                <div class="col-lg-5 ml-auto text-right">
                    <table class="table pull-right">
                        <tr>
                            <th>Subtotal</th>
                            <td>${{ number_format($subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Taxes</th>
                            <td width="125">
                                <input type="number" name="taxes" class="form-control w-75 d-inline"
                                       min="0" max="100" wire:model="taxes">
                                %
                            </td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <td>${{ number_format($total, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <br />
        <div>
            <input class="btn btn-primary" type="submit" value="Save Invoice">
        </div>
    </form>
</div>
