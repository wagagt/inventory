<div>
    @if ($invoiceSaved)
        <div class="alert alert-info">Invoice saved successfully.</div>
    @endif
    <form wire:submit.prevent="saveInvoice">
        @csrf
        <td>${{ number_format($total, 2) }}</td>
        {{-- <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : '' }}">
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
        </div> --}}

        <div class="row">
            <div class="col-lg-6">

                        <div class="form-group">
                            <label for="date">{{ trans('cruds.transaction.fields.date') }}</label>
                            <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                            @if($errors->has('date'))
                                <span class="text-danger">{{ $errors->first('date') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.date_helper') }}</span>
                        </div>
            </div>
            <div class="col-lg-6">
                        <div class="form-group">
                            <label for="amount">{{ trans('cruds.transaction.fields.amount') }}</label>
                            <input class="form-control  type="text" name="amount" id="amount"
                                value="${{ number_format($total, 2) }}" disabled>
                        </div>
            </div>
            <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">{{ trans('cruds.transaction.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '350') }}" step="0.01">
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.name_helper') }}</span>
                        </div>
                    </div>

            <div class="col-lg-6">
                        <div class="form-group">
                            <label for="type_id">{{ trans('cruds.transaction.fields.type') }}</label>
                            <input class="form-control {{ $errors->has('type_id') ? 'is-invalid' : '' }}" type="text" name="type_id" id="type_id" value="Compra" disabled>
                            @if($errors->has('type_id'))
                                <span class="text-danger">{{ $errors->first('type_id') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.transaction.fields.type_helper') }}</span>
                        </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="required" for="provider">{{ trans('cruds.transaction.fields.provider') }}</label>
                    <select class="form-control select2 {{ $errors->has('provider') ? 'is-invalid' : '' }}" name="provider_id"
                        id="provider_id" required>
                        @foreach($providers as $id => $provider)
                        <option value="{{ $id }}" {{ old('provider_id') == $id ? 'selected' : '' }}>{{ $provider }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('provider'))
                    <span class="text-danger">{{ $errors->first('provider') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.transaction.fields.provider_helper') }}</span>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="required" for="store">{{ trans('cruds.transaction.fields.store_destiny') }}</label>
                    <select class="form-control select2 {{ $errors->has('store') ? 'is-invalid' : '' }}" name="store_id"
                        id="store_id" required>
                        @foreach($stores as $id => $store)
                        <option value="{{ $id }}" {{ old('store_id') == $id ? 'selected' : '' }}>{{ $store }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('store'))
                    <span class="text-danger">{{ $errors->first('store') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.transaction.fields.store_destiny_helper') }}</span>
                </div>
            </div>
        </div>


        <div class="card mt-4">
            <div class="card-header">
                Detalle
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-sm btn-secondary"
                                wire:click.prevent="addProduct">+ Agregar Item</button>
                    </div>
                </div>

                <table class="table" id="products_table">
                    <thead>
                    <tr>
                        <th width="25">Id Item</th>
                        <th width="100">Nombre Item</th>
                        <th width="100">Precio Item</th>
                        <th width="100">Cantidad</th>
                        <th width="150">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($invoiceProducts as $index => $invoiceProduct)
                        <tr>
                            <td>
                                @if(!$invoiceProduct['is_saved'])
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
                                @if($invoiceProduct['is_saved'])
                                    <input type="hidden" name="invoiceProducts[{{$index}}][product_id]"
                                           wire:model="invoiceProducts.{{$index}}.product_id" />
                                    {{ $invoiceProduct['product_id'] }}
                                @endif

                            </td>

                            <td>
                                @if($invoiceProduct['is_saved'])
                                    <input type="hidden" name="invoiceProducts[{{$index}}][product_name]"
                                           wire:model="invoiceProducts.{{$index}}.product_name" />
                                    {{ $invoiceProduct['product_name'] }}
                                    {{-- @if($invoiceProduct['product_name'] && $invoiceProduct['product_price'])
                                        {{ $invoiceProduct['product_name'] }}
                                        (${{ number_format($invoiceProduct['product_price'], 2) }})
                                    @endif --}}
                                @endif
                            </td>

                            <td>
                                @if($invoiceProduct['is_saved'])
                                    <input type="hidden" name="invoiceProducts[{{$index}}][product_price]"
                                           wire:model="invoiceProducts.{{$index}}.product_price" />
                                    {{ $invoiceProduct['product_price'] }}
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
                                        Editar
                                    </button>
                                @elseif($invoiceProduct['product_id'])
                                    <button class="btn btn-sm btn-success mr-1"
                                            wire:click.prevent="saveProduct({{$index}})">
                                        Grabar
                                    </button>
                                @endif
                                &nbsp; &nbsp; &nbsp;
                                <button class="btn btn-sm btn-danger"
                                        wire:click.prevent="removeProduct({{$index}})">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="col-lg-12 ml-auto text-right">
                    <table class="table pull-right">
                        {{-- <tr>
                            <th>Subtotal</th>
                            <td>${{ number_format($subtotal, 2) }}</td>
                        </tr> --}}
                        {{-- <tr>
                            <th>Taxes</th>
                            <td width="125">
                                <input type="number" name="taxes" class="form-control w-75 d-inline"
                                       min="0" max="100" wire:model="taxes">
                                %
                            </td>
                        </tr> --}}
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
            <input class="btn btn-primary" type="submit" value="Guardar">
        </div>
    </form>
</div>
