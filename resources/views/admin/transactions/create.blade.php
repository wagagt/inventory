@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.transaction.title_singular') }}
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route("admin.transactions.store") }}" enctype="multipart/form-data">
            @csrf
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
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount"
                    value="{{ old('amount') }}">
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.transaction.fields.amount_helper') }}</span>
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
