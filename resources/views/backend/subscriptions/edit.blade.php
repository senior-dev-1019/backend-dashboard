@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.subscriptions.subscriptions')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.subscriptions') }}">@lang('dashboard.subscriptions.subscriptions')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.subscriptions.edit-subscription')</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>@lang('dashboard.subscriptions.edit-subscription')</div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.subscriptions.update', [$subscription->id]) }}">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-right">@lang('dashboard.subscriptions.title')</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $subscription->title }}" required autocomplete="title" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="description" class="col-md-3 col-form-label text-md-right">@lang('dashboard.subscriptions.description')</label>

                    <div class="col-md-6">
                        <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $subscription->description }}" required autocomplete="description" autofocus>

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="monthly_price" class="col-md-3 col-form-label text-md-right">@lang('dashboard.subscriptions.monthly-price')</label>

                    <div class="col-md-6">
                        <input id="monthly_price" type="number" step="any" class="form-control @error('monthly_price') is-invalid @enderror" name="monthly_price" value="{{ $subscription->monthly_price }}" required autocomplete="name" autofocus>

                        @error('monthly_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="has_timeline" class="col-md-3 col-form-label text-md-right">@lang('dashboard.subscriptions.has-timeline')</label>

                    <div class="col-md-6">
                        <select name="has_timeline" id="has_timeline" class="form-control @error('has_timeline') is-invalid @enderror">
                            <option value="0" {{ $subscription->has_timeline === 0 ? "selected" : "" }}>No</option>
                            <option value="1" {{ $subscription->has_timeline === 1 ? "selected" : "" }}>Yes</option>
                        </select>

                        @error('has_timeline')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="has_documents" class="col-md-3 col-form-label text-md-right">@lang('dashboard.subscriptions.has-documents')</label>

                    <div class="col-md-6">
                        <select name="has_documents" id="has_documents" class="form-control @error('has_documents') is-invalid @enderror">
                            <option value="0" {{ $subscription->has_documents === 0 ? "selected" : "" }}>No</option>
                            <option value="1" {{ $subscription->has_documents === 1 ? "selected" : "" }}>Yes</option>
                        </select>

                        @error('has_documents')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="has_institution" class="col-md-3 col-form-label text-md-right">@lang('dashboard.subscriptions.has-institution')</label>

                    <div class="col-md-6">
                        <select name="has_institution" id="has_institution" class="form-control @error('has_institution') is-invalid @enderror">
                            <option value="0" {{ $subscription->has_institution === 0 ? "selected" : "" }}>No</option>
                            <option value="1" {{ $subscription->has_institution === 1 ? "selected" : "" }}>Yes</option>
                        </select>

                        @error('has_institution')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="provisions" class="col-md-3 col-form-label text-md-right">@lang('dashboard.subscriptions.provisions')</label>

                    <div class="col-md-6">
                        <input id="provisions" type="number" step="any" class="form-control @error('provisions') is-invalid @enderror" name="provisions" value="{{ $subscription->provisions }}" required autocomplete="name" autofocus>

                        @error('provisions')
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
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
