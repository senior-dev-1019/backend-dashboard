@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.subscriptions.subscriptions')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.subscriptions.subscriptions')</li>
    </ol>
    <div class="card mb-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header">
            <a class="btn btn-info" href="{{ route('dashboard.subscriptions.create') }}">
                @lang('dashboard.subscriptions.create-subscription')
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>@lang('dashboard.iterator')</th>
                            <th>@lang('dashboard.subscriptions.title')</th>
                            <th>@lang('dashboard.subscriptions.monthly-price')</th>
                            <th>@lang('dashboard.subscriptions.has-timeline')</th>
                            <th>@lang('dashboard.subscriptions.has-documents')</th>
                            <th>@lang('dashboard.subscriptions.has-institution')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>@lang('dashboard.iterator')</th>
                            <th>@lang('dashboard.subscriptions.title')</th>
                            <th>@lang('dashboard.subscriptions.monthly-price')</th>
                            <th>@lang('dashboard.subscriptions.has-timeline')</th>
                            <th>@lang('dashboard.subscriptions.has-documents')</th>
                            <th>@lang('dashboard.subscriptions.has-institution')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @if(count($subscriptions))
                        @foreach($subscriptions as $subscription)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $subscription->title }}</td>
                                <td>{{ $subscription->monthly_price }}</td>
                                <td>@lang($subscription->has_timeline?'dashboard.yes':'dashboard.no')</td>
                                <td>@lang($subscription->has_documents?'dashboard.yes':'dashboard.no')</td>
                                <td>@lang($subscription->has_institution?'dashboard.yes':'dashboard.no')</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('dashboard.subscriptions.edit', [$subscription->id]) }}">
                                        @lang('dashboard.edit')
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('dashboard.subscriptions.delete', [$subscription->id]) }}">
                                        @lang('dashboard.delete')
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="7">@lang('dashboard.subscriptions.no-result')</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
