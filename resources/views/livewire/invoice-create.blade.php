<div>
    @if ($invoiceSaved)
        <div class="alert alert-info">Transacción Realizada con éxito.</div>
    @endif
    <form wire:submit.prevent="saveInvoice">
        @csrf
        {{-- <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
            <label>Fecha</label>
            <input wire:model="date" type="date" name="date" class="form-control"
                   value="{{ old('date') }}" required>
            @if($errors->has('date'))
                <em class="invalid-feedback">
                    {{ $errors->first('date') }}
                </em>
            @endif
        </div>
        <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
            <label>Monto</label>
            <input wire:model="amount" type="email" name="amount" class="form-control"
                   value="${{ number_format($total, 2) }}" readonly>
            @if($errors->has('amount'))
                <em class="invalid-feedback">
                    {{ $errors->first('amount') }}
                </em>
            @endif
        </div> --}}
        <div class="row">
            <div class="col-lg-6">
                            <div class="form-group">
                                <label for="description">{{ trans('cruds.transaction.fields.description') }}</label>
                                <input wire:model="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                    type="text" name="description" id="description" value="{{ old('description') }}">
                                @if($errors->has('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.transaction.fields.description_helper') }}</span>
                            </div>
                        </div>

            <div class="col-lg-6">
                    <div class="form-group">
                        <label for="amount">{{ trans('cruds.transaction.fields.amount') }}</label>
                        <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount" id="amount" value="${{ number_format($total, 2) }}" readonly>
                        @if($errors->has('amount'))
                            <span class="text-danger">{{ $errors->first('amount') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.transaction.fields.amount_helper') }}</span>
                    </div>
            </div>
<div class="col-lg-6">

                <div class="form-group">
                    <label for="date">{{ trans('cruds.transaction.fields.date') }}</label>
                    <input wire:model="date" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" type="date"
                        name="date" id="date" value="{{ old('date') }}">
                    @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.transaction.fields.date_helper') }}</span>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="required" for="type_id">{{ trans('cruds.transaction.fields.type') }}</label>
                    <select class="form-control {{ $errors->has('type_id') ? 'is-invalid' : '' }}" name="type_id"
                        id="type_id" required readonly>
                        {{-- @foreach($types as $id => $type) --}}
                        @if ($type_id == 1)
                            <option value="1" {{ old('type_id') == 1 ? 'selected' : '' }}> Compras </option>
                        @endif
                        @if ($type_id == 2)
                            <option value="2" {{ old('type_id') == 2 ? 'selected' : '' }}> Ventas </option>
                        @endif
                        @if ($type_id == 3)
                            <option value="3" {{ old('type_id') == 3 ? 'selected' : '' }}> Transferencias </option>
                        @endif
                        {{-- @endforeach --}}
                    </select>
                    @if($errors->has('type_id'))
                    <span class="text-danger">{{ $errors->first('type_id') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.transaction.fields.type_helper') }}</span>
                </div>
            </div>

            @if ($type_id == 1)
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="required" for="provider_id">{{ trans('cruds.transaction.fields.provider') }}</label>
                        <select wire:model="provider_id" class="form-control select2 {{ $errors->has('provider_id') ? 'is-invalid' : '' }}" name="provider_id"
                            id="provider_id" required>
                            @foreach($providers as $id => $provider)
                            <option value="{{ $id }}" {{ old('provider_id') == $id ? 'selected' : '' }}>{{ $provider }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('provider_id'))
                        <span class="text-danger">{{ $errors->first('provider_id') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.transaction.fields.provider_helper') }}</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="required" for="store_id">{{ trans('cruds.transaction.fields.store_destiny') }}</label>
                        <select wire:model="store_destiny_id" class="form-control select2 {{ $errors->has('store_id') ? 'is-invalid' : '' }}" name="store_id"
                            id="store_id" required>
                            @foreach($stores as $id => $store)
                            <option value="{{ $id }}" {{ old('store_id') == $id ? 'selected' : '' }}>{{ $store }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('store_id'))
                        <span class="text-danger">{{ $errors->first('store_id') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.transaction.fields.store_destiny_helper') }}</span>
                    </div>
                </div>
            @endif

            @if ($type_id == 2)
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="required" for="customer_id">{{ trans('cruds.transaction.fields.customer') }}</label>
                        <select wire:model="customer_id" class="form-control select2 {{ $errors->has('customer_id') ? 'is-invalid' : '' }}" name="customer_id"
                            id="customer_id" required>
                            @foreach($customers as $id => $customer)
                            <option value="{{ $id }}" {{ old('customer_id') == $id ? 'selected' : '' }}>{{ $customer }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('customer_id'))
                        <span class="text-danger">{{ $errors->first('customer_id') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.transaction.fields.customer_helper') }}</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="required" for="store_id">{{ trans('cruds.transaction.fields.store_origin') }}</label>
                        <select wire:model="store_origin_id" class="form-control select2 {{ $errors->has('store_id') ? 'is-invalid' : '' }}" name="store_id"
                            id="store_id" required>
                            @foreach($stores as $id => $store)
                            <option value="{{ $id }}" {{ old('store_id') == $id ? 'selected' : '' }}>{{ $store }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('store_id'))
                        <span class="text-danger">{{ $errors->first('store_id') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.transaction.fields.store_origin_helper') }}</span>
                    </div>
                </div>
            @endif

            @if ($type_id == 3)
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="required" for="store_id">{{ trans('cruds.transaction.fields.store_origin') }}</label>
                        <select wire:model="store_origin_id" class="form-control select2 {{ $errors->has('store_id') ? 'is-invalid' : '' }}" name="store_id"
                            id="store_id" required>
                            @foreach($stores as $id => $store)
                            <option value="{{ $id }}" {{ old('store_id') == $id ? 'selected' : '' }}>{{ $store }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('store_id'))
                        <span class="text-danger">{{ $errors->first('store_id') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.transaction.fields.store_origin_helper') }}</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="required" for="store_id">{{ trans('cruds.transaction.fields.store_destiny') }}</label>
                        <select wire:model="store_destiny_id" class="form-control select2 {{ $errors->has('store_id') ? 'is-invalid' : '' }}" name="store_id"
                            id="store_id" required>
                            @foreach($stores as $id => $store)
                            <option value="{{ $id }}" {{ old('store_id') == $id ? 'selected' : '' }}>{{ $store }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('store_id'))
                        <span class="text-danger">{{ $errors->first('store_id') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.transaction.fields.store_destiny_helper') }}</span>
                    </div>
                </div>
            @endif

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
                        <th width="225">Nombre Item</th>
                        <th width="25">Precio Item</th>
                        <th width="25">Cantidad</th>
                        <th width="25">Detalle</th>
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
                            <a href= "{{ env('APP_URL') }}/admin/products/{{ $invoiceProduct['product_id'] }}" target="_blank" rel="noopener noreferrer">Ver</a>
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
                            <td id="valorTotal">${{ number_format($total, 2) }}</td>
                        </tr>
                    </table>
                    {{-- <button class="btn btn-sm btn-success"
                                        id="finalizarDetalle">
                                    Finalizar
                                </button> --}}
                </div>
            </div>
        </div>
        <br />
        <div>
            <input class="btn btn-primary" type="submit" value="Guardar Transacción">
        </div>
    </form>
</div>

{{-- @section('scripts')
<script>
    $(document).ready(function () {
        $('#finalizarDetalle').on('click', function(e) {
            e.preventDefault();
            var valor = $("#valorTotal").html();
            // alert(valor);
            $("#amount").val(valor);
            $("#totalGeneral").val(valor);
            $("#grabar").show();
            // alert('click' + ' ' + $("#amount").val());
        })
    });
</script>
@endsection --}}
