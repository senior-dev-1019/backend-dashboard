@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.invoices.invoices')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.invoices.invoices')</li>
    </ol>
    <div class="card mb-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header">
            <a class="btn btn-info" href="{{ route('dashboard.invoices.create') }}">
                @lang('dashboard.invoices.create-invoice')
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>@lang('dashboard.iterator')</th>
                            <th>@lang('dashboard.invoices.user-name')</th>
                            <th>@lang('dashboard.invoices.invoice-date')</th>
                            <th>@lang('dashboard.invoices.payment-date')</th>
                            <th>@lang('dashboard.invoices.amount')</th>
                            <th>@lang('dashboard.invoices.status')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>@lang('dashboard.iterator')</th>
                            <th>@lang('dashboard.invoices.user-name')</th>
                            <th>@lang('dashboard.invoices.invoice-date')</th>
                            <th>@lang('dashboard.invoices.payment-date')</th>
                            <th>@lang('dashboard.invoices.amount')</th>
                            <th>@lang('dashboard.invoices.status')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @if(count($invoices))
                        @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $invoice->user->name }}</td>
                                <td>{{ $invoice->invoice_date }}</td>
                                <td>{{ $invoice->payment_date }}</td>
                                <td>{{ $invoice->amount }}</td>
                                <td>{{ $invoice->status }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('dashboard.invoices.edit', [$invoice->id]) }}">
                                        @lang('dashboard.edit')
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('dashboard.invoices.delete', [$invoice->id]) }}">
                                        @lang('dashboard.delete')
                                    </a>
                                    <a class="btn btn-info" target="_blank" href="{{ route('dashboard.invoices.downloadInvoice', [$invoice->id]) }}">
                                        @lang('dashboard.invoices.download-invoice')
                                    </a>
                                    @if ($invoice->status=='paid')
                                        <a class="btn btn-info" target="_blank" href="{{ route('dashboard.invoices.downloadReceipt', [$invoice->id]) }}">
                                            @lang('dashboard.invoices.download-receipt')
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="7">@lang('dashboard.invoices.no-result')</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
