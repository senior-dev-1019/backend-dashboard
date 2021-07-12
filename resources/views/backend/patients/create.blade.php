@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.patients.patients')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.patients') }}">@lang('dashboard.patients.patients')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.patients.create-patient')</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>@lang('dashboard.patients.create-patient')</div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.patients.store') }}">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">@lang('dashboard.patients.name')</label>

                    <div class="col-md-6">
                        <input id="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="date_of_birth" class="col-md-3 col-form-label text-md-right">@lang('dashboard.patients.date-of-birth')</label>

                    <div class="col-md-6">
                        <input id="date_of_birth" value="{{ old('date_of_birth') }}" type="text" class="form-control date-picker @error('date_of_birth') is-invalid @enderror" name="date_of_birth" autocomplete="date_of_birth" autofocus>

                        @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="patient_number" class="col-md-3 col-form-label text-md-right">@lang('dashboard.patients.patient-number')</label>

                    <div class="col-md-6">
                        <input id="patient_number" value="{{ old('patient_number') }}" type="text" class="form-control @error('patient_number') is-invalid @enderror" name="patient_number" autocomplete="patient_number" autofocus>

                        @error('patient_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="institution_id" class="col-md-3 col-form-label text-md-right">@lang('dashboard.patients.institution')</label>

                    <div class="col-md-6">
                        <select name="institution_id" id="institution_id" class="form-control @error('institution_id') is-invalid @enderror">
                            <option></option>
                            @foreach($institutions as $institution)
                                <option value="{{ $institution->id }}" {{ old('institution_id') == $institution->id ? "selected" : "" }}>{{ $institution->name }}</option>
                            @endforeach
                        </select>

                        @error('institution_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            @lang('dashboard.save')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
