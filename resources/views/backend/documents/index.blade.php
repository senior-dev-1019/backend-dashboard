@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.documents.documents')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.documents.documents')</li>
    </ol>
    <div class="card mb-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header">
            <a class="btn btn-info" href="{{ route('dashboard.documents.create') }}">
                @lang('dashboard.documents.create-document')
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>@lang('dashboard.iterator')</th>
                            <th>@lang('dashboard.documents.patient')</th>
                            <th>@lang('dashboard.documents.coupon')</th>
                            <th>@lang('dashboard.documents.title')</th>
                            <th>@lang('dashboard.documents.file-name')</th>
                            <th>@lang('dashboard.documents.folder')</th>
                            <th>@lang('dashboard.documents.is-provision')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>@lang('dashboard.iterator')</th>
                            <th>@lang('dashboard.documents.patient')</th>
                            <th>@lang('dashboard.documents.coupon')</th>
                            <th>@lang('dashboard.documents.title')</th>
                            <th>@lang('dashboard.documents.file-name')</th>
                            <th>@lang('dashboard.documents.folder')</th>
                            <th>@lang('dashboard.documents.is-provision')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @if(count($documents))
                        @foreach($documents as $document)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ isset($document->patient)?$document->patient->name:'' }}</td>
                                <td>{{ isset($document->coupon)?$document->coupon->name:'' }}</td>
                                <td>{{ $document->title }}</td>
                                <td>
                                    {{ $document->file_name }}
                                </td>
                                <td>{{ $document->folder->name }}</td>
                                <td>@lang($document->is_provision?'dashboard.yes':'dashboard.no')</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('dashboard.documents.edit', [$document->id]) }}">
                                        @lang('dashboard.edit')
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('dashboard.documents.delete', [$document->id]) }}">
                                        @lang('dashboard.delete')
                                    </a>
                                    <a class="btn btn-info" target="_blank" href="{{ route('dashboard.documents.download', [$document->storage_file_name]) }}">
                                        @lang('dashboard.documents.download-document')
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="9">@lang('dashboard.documents.no-result')</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
