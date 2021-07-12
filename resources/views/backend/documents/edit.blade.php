@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.documents.documents')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.documents') }}">@lang('dashboard.documents.documents')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.documents.edit-document')</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>@lang('dashboard.documents.edit-document')</div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.documents.update', [$document->id]) }}">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="form-group row">
                    <label for="patient_id" class="col-md-3 col-form-label text-md-right">@lang('dashboard.documents.patient')</label>

                    <div class="col-md-6">
                        <select name="patient_id" id="patient_id" class="form-control @error('patient_id') is-invalid @enderror">
                            <option></option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ $document->patient_id === $patient->id ? "selected" : "" }}>{{ $patient->name }}</option>
                            @endforeach
                        </select>

                        @error('patient_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="coupon_id" class="col-md-3 col-form-label text-md-right">@lang('dashboard.documents.coupon')</label>

                    <div class="col-md-6">
                        <select name="coupon_id" id="coupon_id" class="form-control @error('coupon_id') is-invalid @enderror">
                            <option></option>
                            @foreach($coupons as $coupon)
                                <option value="{{ $coupon->id }}" {{ $document->coupon_id === $coupon->id ? "selected" : "" }}>{{ $coupon->code }}</option>
                            @endforeach
                        </select>

                        @error('coupon_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-right">@lang('dashboard.documents.title')</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $document->title }}" required autocomplete="title" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="file" class="col-md-3 col-form-label text-md-right">@lang('dashboard.file')</label>

                    <div class="col-md-6">
                        <input id="file" value="{{ old('file') }}" type="file" class="form-control @error('file') is-invalid @enderror" name="file" autocomplete="file" autofocus>

                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="folder_id" class="col-md-3 col-form-label text-md-right">@lang('dashboard.documents.folder')</label>

                    <div class="col-md-6">
                        <select name="folder_id" id="folder_id" class="form-control @error('folder_id') is-invalid @enderror">
                            @foreach($folders as $folder)
                                <option value="{{ $folder->id }}" {{ $document->folder_id === $folder->id ? "selected" : "" }}>{{ $folder->name }}</option>
                            @endforeach
                        </select>

                        @error('folder_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="is_provision" class="col-md-3 col-form-label text-md-right">@lang('dashboard.documents.is-provision')</label>

                    <div class="col-md-6">
                        <select name="is_provision" id="is_provision" class="form-control @error('is_provision') is-invalid @enderror">
                            <option value="0" {{ $document->is_provision === 0 ? "selected" : "" }}>No</option>
                            <option value="1" {{ $document->is_provision === 1 ? "selected" : "" }}>Yes</option>
                        </select>

                        @error('is_provision')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            @lang('dashboard.update')
                        </button>
                        <a class="btn btn-info" target="_blank" href="{{ route('dashboard.documents.download', [$document->storage_file_name]) }}">@lang('dashboard.documents.download-document')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
