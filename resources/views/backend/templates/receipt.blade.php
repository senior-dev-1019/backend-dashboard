<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
<style type="text/css" media="all">
    div.header {
        width: 100%;
    }

    img.logo {
        width: 200px;
        margin-left: 250px
    }

    div.page-title {
        text-align: center;
    }
    .invoice-title{
        font-size: 22px;
    }

    .title-header {
        padding-top: 40px;
    }

    .invoice-title {
        font-weight: bold;
    }

    .invoice-content {
        padding-top: 40px;
        width: 100%;
    }

    .table-header {
        font-weight: bold;
    }

    .item {
        width: 350px;
        display: inline-block;
    }

    .amount {
        width: 350px;
        display: inline-block;
        text-align: right;
    }

    .page-footer {
        padding-top: 40px;
    }
</style>
<body>
    <div class="page-break">
        <div class="header">
            <img class="logo" src="{{ asset('logo/400dpiLogo.png') }}" alt="Logo">
        </div>
        <div class="page-title">
            <p>@lang('pdf.address')</p>
            <p>@lang('pdf.email')</p>
            <p>@lang('pdf.telephone-and-fax')</p>
        </div>
        <div class="title-header">
            <div class="invoice-title">
                @lang('pdf.receipt') # {{ $invoice->id }}
            </div>
            <P>@lang('pdf.invoice-date') {{ $invoice->invoice_date }}</P>
            <P>@lang('pdf.payment-date') {{ $invoice->payment_date }}</P>
            <p>&nbsp;</p>
            <p>{{ $user->name }}</p>
            <p>{{ $user->address }}</p>
            <p>{{ $user->postcode }} {{ $user->city }}</p>
        </div>
        <div class="invoice-content">
            <div class="invoice-row table-header">
                <div class="item">
                    @lang('pdf.item')
                </div>
                <div class="amount">
                    @lang('pdf.amount')
                </div>
            </div>
            @foreach ($invoicelines as $invoiceline)
            <div class="invoice-row">
                <div class="item">
                    {{ $invoiceline->text }}
                </div>
                <div class="amount">
                    {{ app()->getLocale()=='de'?number_format($invoiceline->amount, 2, ',', '.'):number_format($invoiceline->amount, 2) }}
                </div>
            </div>
            @endforeach
            <div class="invoice-row table-header">
                <div class="item">
                    @lang('pdf.total')
                </div>
                <div class="amount">
                    {{ app()->getLocale()=='de'?number_format($invoicelines->sum('amount'), 2, ',', '.'):number_format($invoicelines->sum('amount'), 2) }}
                </div>
            </div>
        </div>
        <div class="page-footer">
            @lang('pdf.visit-app')
        </div>
    </div>
</body>
</html>
