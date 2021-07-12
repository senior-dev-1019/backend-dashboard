@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.institutions.institutions')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.institutions') }}">@lang('dashboard.institutions.institutions')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.institutions.edit-institution')</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>@lang('dashboard.institutions.edit-institution')</div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.institutions.update', [$institution->id]) }}">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">@lang('dashboard.institutions.name')</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $institution->name }}" required autocomplete="name" autofocus>

                        @error('name')
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
