@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.institutions.institutions')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.institutions.institutions')</li>
    </ol>
    <div class="card mb-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header">
            <a class="btn btn-info" href="{{ route('dashboard.institutions.create') }}">
                @lang('dashboard.institutions.create-institution')
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>@lang('dashboard.iterator')</th>
                            <th>@lang('dashboard.institutions.name')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>@lang('dashboard.iterator')</th>
                            <th>@lang('dashboard.institutions.name')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @if(count($institutions))
                        @foreach($institutions as $institution)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $institution->name }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('dashboard.institutions.edit', [$institution->id]) }}">
                                        @lang('dashboard.edit')
                                    </a>
                                    <a class="btn btn-danger confirm-action" href="{{ route('dashboard.institutions.delete', [$institution->id]) }}" data-method='DELETE'>
                                        @lang('dashboard.delete')
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="3">@lang('dashboard.institutions.no-result')</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
