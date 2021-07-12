@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.patients.patients')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.patients.patients')</li>
    </ol>
    <div class="card mb-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header">
            <a class="btn btn-info" href="{{ route('dashboard.patients.create') }}">
                @lang('dashboard.patients.create-patient')
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>@lang('dashboard.iterator')</th>
                            <th>@lang('dashboard.patients.name')</th>
                            <th>@lang('dashboard.patients.date-of-birth')</th>
                            <th>@lang('dashboard.patients.patient-number')</th>
                            <th>@lang('dashboard.patients.institution')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>@lang('dashboard.iterator')</th>
                            <th>@lang('dashboard.patients.name')</th>
                            <th>@lang('dashboard.patients.date-of-birth')</th>
                            <th>@lang('dashboard.patients.patient-number')</th>
                            <th>@lang('dashboard.patients.institution')</th>
                            <th>@lang('dashboard.actions')</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    @if(count($patients))
                        @foreach($patients as $patient)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->date_of_birth }}</td>
                                <td>{{ $patient->patient_number }}</td>
                                <td>{{ isset($patient->institution)?$patient->institution->name:'' }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('dashboard.patients.edit', [$patient->id]) }}">
                                        @lang('dashboard.edit')
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('dashboard.patients.delete', [$patient->id]) }}">
                                        @lang('dashboard.delete')
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="5">@lang('dashboard.patients.no-result')</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
