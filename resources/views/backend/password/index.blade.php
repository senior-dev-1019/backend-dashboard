@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.change-password')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.change-password')</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>@lang('dashboard.change-password')</div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.password.update') }}">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                <div class="alert alert-warning" role="alert">
                    {{$errors->first()}}
                </div>
                @endif
                
                <div class="form-group row">
                    <label for="old_password" class="col-md-4 col-form-label text-md-right">@lang('passwords.old_password')</label>

                    <div class="col-md-6">
                        <input id="old_password" type="password" value="{{ old('old_password') }}" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="new-old_password">

                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">@lang('auth.password')</label>

                    <div class="col-md-6">
                        <input id="password" type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">@lang('auth.confirm-password')</label>

                    <div class="col-md-6">
                        <input id="password_confirmation" type="password" value="{{ old('password_confirmation') }}" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            @lang('passwords.change_password')
                        </button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
