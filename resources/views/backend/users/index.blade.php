@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.users.users')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.users.users')</li>
    </ol>
    <div class="card mb-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header">
            <a class="btn btn-info" href="{{ route('dashboard.users.create') }}">
                @lang('dashboard.users.create-user')
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>@lang('dashboard.users.name')</th>
                            <th>@lang('dashboard.users.email')</th>
                            <th>@lang('dashboard.users.address')</th>
                            <th>@lang('dashboard.users.postcode')</th>
                            <th>@lang('dashboard.users.city')</th>
                            <th>@lang('dashboard.users.mobile')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>@lang('dashboard.users.name')</th>
                            <th>@lang('dashboard.users.email')</th>
                            <th>@lang('dashboard.users.address')</th>
                            <th>@lang('dashboard.users.postcode')</th>
                            <th>@lang('dashboard.users.city')</th>
                            <th>@lang('dashboard.users.mobile')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @if(count($users))
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->postcode }}</td>
                                <td>{{ $user->city }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('dashboard.users.edit', [$user->id]) }}">
                                        @lang('dashboard.edit')
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('dashboard.users.delete', [$user->id]) }}">
                                        @lang('dashboard.delete')
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="7">@lang('dashboard.users.no-result')</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
