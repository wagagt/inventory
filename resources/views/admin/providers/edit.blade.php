@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.provider.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.providers.update", [$provider->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.provider.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $provider->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.provider.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $provider->address) }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="zone">{{ trans('cruds.provider.fields.zone') }}</label>
                <input class="form-control {{ $errors->has('zone') ? 'is-invalid' : '' }}" type="text" name="zone" id="zone" value="{{ old('zone', $provider->zone) }}">
                @if($errors->has('zone'))
                    <span class="text-danger">{{ $errors->first('zone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.zone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="city">{{ trans('cruds.provider.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $provider->city) }}">
                @if($errors->has('city'))
                    <span class="text-danger">{{ $errors->first('city') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="department">{{ trans('cruds.provider.fields.department') }}</label>
                <input class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}" type="text" name="department" id="department" value="{{ old('department', $provider->department) }}">
                @if($errors->has('department'))
                    <span class="text-danger">{{ $errors->first('department') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.department_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_name">{{ trans('cruds.provider.fields.contact_name') }}</label>
                <input class="form-control {{ $errors->has('contact_name') ? 'is-invalid' : '' }}" type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', $provider->contact_name) }}">
                @if($errors->has('contact_name'))
                    <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.contact_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_email">{{ trans('cruds.provider.fields.contact_email') }}</label>
                <input class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}" type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $provider->contact_email) }}">
                @if($errors->has('contact_email'))
                    <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.contact_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_phone">{{ trans('cruds.provider.fields.contact_phone') }}</label>
                <input class="form-control {{ $errors->has('contact_phone') ? 'is-invalid' : '' }}" type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $provider->contact_phone) }}">
                @if($errors->has('contact_phone'))
                    <span class="text-danger">{{ $errors->first('contact_phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.provider.fields.contact_phone_helper') }}</span>
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