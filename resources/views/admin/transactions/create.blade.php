@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transaction.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.transactions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="date">{{ trans('cruds.transaction.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}">
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.transaction.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.transaction.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', '350') }}" step="0.01">
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.transaction.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="store_origin">{{ trans('cruds.transaction.fields.store_origin') }}</label>
                <input class="form-control {{ $errors->has('store_origin') ? 'is-invalid' : '' }}" type="number" name="store_origin" id="store_origin" value="{{ old('store_origin', '') }}" step="1">
                @if($errors->has('store_origin'))
                    <span class="text-danger">{{ $errors->first('store_origin') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.store_origin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="store_destiny">{{ trans('cruds.transaction.fields.store_destiny') }}</label>
                <input class="form-control {{ $errors->has('store_destiny') ? 'is-invalid' : '' }}" type="number" name="store_destiny" id="store_destiny" value="{{ old('store_destiny', '') }}" step="1">
                @if($errors->has('store_destiny'))
                    <span class="text-danger">{{ $errors->first('store_destiny') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.store_destiny_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="customer">{{ trans('cruds.transaction.fields.customer') }}</label>
                <input class="form-control {{ $errors->has('customer') ? 'is-invalid' : '' }}" type="number" name="customer" id="customer" value="{{ old('customer', '') }}" step="1">
                @if($errors->has('customer'))
                    <span class="text-danger">{{ $errors->first('customer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.customer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="provider">{{ trans('cruds.transaction.fields.provider') }}</label>
                <input class="form-control {{ $errors->has('provider') ? 'is-invalid' : '' }}" type="number" name="provider" id="provider" value="{{ old('provider', '') }}" step="1">
                @if($errors->has('provider'))
                    <span class="text-danger">{{ $errors->first('provider') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.provider_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="status_id">{{ trans('cruds.transaction.fields.status') }}</label>
                <select class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status_id" id="status_id">
                    @foreach($statuses as $id => $status)
                        <option value="{{ $id }}" {{ old('status_id') == $id ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="type_id">{{ trans('cruds.transaction.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id">
                    @foreach($types as $id => $type)
                        <option value="{{ $id }}" {{ old('type_id') == $id ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
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

`@livewire('invoice-create')`

<livewire:invoice-create />

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/transactions/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $transaction->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection
