@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.invoices.invoices')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.invoices') }}">@lang('dashboard.invoices.invoices')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.invoices.edit-invoice')</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>@lang('dashboard.invoices.edit-invoice')</div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.invoices.update', [$invoice->id]) }}">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="form-group row">
                    <label for="user_id" class="col-md-3 col-form-label text-md-right">@lang('dashboard.invoices.user')</label>

                    <div class="col-md-6">
                        <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $invoice->user_id === $user->id ? "selected" : "" }}>{{ $user->name }}</option>
                            @endforeach
                        </select>

                        @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="invoice_date" class="col-md-3 col-form-label text-md-right">@lang('dashboard.invoices.invoice-date')</label>

                    <div class="col-md-6">
                        <input id="invoice_date" type="text" step="any" class="form-control date-picker @error('invoice_date') is-invalid @enderror" name="invoice_date" value="{{ $invoice->invoice_date }}" required autocomplete="name" autofocus>

                        @error('invoice_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="payment_date" class="col-md-3 col-form-label text-md-right">@lang('dashboard.invoices.payment-date')</label>

                    <div class="col-md-6">
                        <input id="payment_date" type="text" class="form-control date-picker @error('payment_date') is-invalid @enderror" name="payment_date" value="{{ $invoice->payment_date }}" autocomplete="payment_date" autofocus>

                        @error('payment_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="status" class="col-md-3 col-form-label text-md-right">@lang('dashboard.invoices.status')</label>

                    <div class="col-md-6">
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="open" {{ $invoice->status === "open" ? "selected" : "" }}>open</option>
                            <option value="paid" {{ $invoice->status === "paid" ? "selected" : "" }}>paid</option>
                            <option value="cancelled" {{ $invoice->status === "cancelled" ? "selected" : "" }}>cancelled</option>
                        </select>

                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">@lang('dashboard.invoices.invoice-lines')</label>

                    <div class="col-md-6">
                        <span class="form-control col-md-6 btn btn-info" onclick="addInvoiceLine()">Create a new invoice line</span>
                    </div>
                </div>
                <hr>

                <div id="invoicelines">
                    @foreach ($invoicelines as $invoiceline)
                    <div id="{{ $invoiceline->id }}">
                        <div class="form-group row">
                            <input type="hidden" name="ids[]" value="{{ $invoiceline->id }}">
                            <label for="invoiceline_amount" class="col-md-3 col-form-label text-md-right">@lang('dashboard.invoices.amount')</label>
                        
                            <div class="col-md-6">
                                <input name="invoiceline_amounts[]" value="{{ $invoiceline->amount }}" type="number" step="any" class="form-control @error('invoiceline_amount') is-invalid @enderror" required autocomplete="invoiceline_amount" autofocus>
                        
                                @error('invoiceline_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <button type="button" onclick="removeInvoiceLine('{{ $invoiceline->id }}')" class="btn btn-danger" aria-label="Close">
                                    Delete
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="invoiceline_text" class="col-md-3 col-form-label text-md-right">@lang('dashboard.invoices.text')</label>
                        
                            <div class="col-md-6">
                                <textarea name="invoiceline_texts[]" cols="30" rows="5" class="form-control @error('invoiceline_text') is-invalid @enderror" required autocomplete="invoiceline_text" autofocus>{{ $invoiceline->text }}</textarea>
                        
                                @error('invoiceline_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                    </div>
                    
                    @endforeach
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary form-control">
                            @lang('dashboard.update')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
