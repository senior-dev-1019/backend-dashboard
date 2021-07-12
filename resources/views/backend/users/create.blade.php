@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4">@lang('dashboard.users.users')</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('dashboard.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.users') }}">@lang('dashboard.users.users')</a></li>
        <li class="breadcrumb-item active">@lang('dashboard.users.create-user')</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-table mr-1"></i>@lang('dashboard.users.create-user')</div>
        <div class="card-body">
            <form method="POST" action="{{ route('dashboard.users.store') }}">
                @csrf
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.name')</label>

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
                    <label for="email" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.email')</label>

                    <div class="col-md-6">
                        <input id="email" value="{{ old('email') }}" type="text" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="address" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.address')</label>

                    <div class="col-md-6">
                        <input id="address" value="{{ old('address') }}" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address" autofocus>

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="postcode" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.postcode')</label>

                    <div class="col-md-6">
                        <input id="postcode" value="{{ old('postcode') }}" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" required autocomplete="postcode" autofocus>

                        @error('postcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="city" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.city')</label>

                    <div class="col-md-6">
                        <input id="city" value="{{ old('city') }}" type="text" class="form-control @error('city') is-invalid @enderror" name="city" required autocomplete="city" autofocus>

                        @error('city')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="mobile" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.mobile')</label>

                    <div class="col-md-6">
                        <input id="mobile" value="{{ old('mobile') }}" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" required autocomplete="mobile" autofocus>

                        @error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="is_locked" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.is-locked')</label>

                    <div class="col-md-6">
                        <select name="is_locked" id="is_locked" class="form-control @error('is_locked') is-invalid @enderror">
                            <option value="0" {{ old('is_locked') == 0 ? "selected" : "" }}>No</option>
                            <option value="1" {{ old('is_locked') == 1 ? "selected" : "" }}>Yes</option>
                        </select>

                        @error('is_locked')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="is_admin" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.is-admin')</label>

                    <div class="col-md-6">
                        <select name="is_admin" id="is_admin" class="form-control @error('is_admin') is-invalid @enderror">
                            <option value="0" {{ old('is_admin') == 0 ? "selected" : "" }}>No</option>
                            <option value="1" {{ old('is_admin') == 1 ? "selected" : "" }}>Yes</option>
                        </select>

                        @error('is_admin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="institution_id" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.institution')</label>

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
                
                <div class="form-group row">
                    <label for="may_edit_patients" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.may-edit-patients')</label>

                    <div class="col-md-6">
                        <select name="may_edit_patients" id="may_edit_patients" class="form-control @error('may_edit_patients') is-invalid @enderror">
                            <option value="0" {{ old('may_edit_patients') == 0 ? "selected" : "" }}>No</option>
                            <option value="1" {{ old('may_edit_patients') == 1 ? "selected" : "" }}>Yes</option>
                        </select>

                        @error('may_edit_patients')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="may_edit_employees" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.may-edit-employees')</label>

                    <div class="col-md-6">
                        <select name="may_edit_employees" id="may_edit_employees" class="form-control @error('may_edit_employees') is-invalid @enderror">
                            <option value="0" {{ old('may_edit_employees') == 0 ? "selected" : "" }}>No</option>
                            <option value="1" {{ old('may_edit_employees') == 1 ? "selected" : "" }}>Yes</option>
                        </select>

                        @error('may_edit_employees')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="is_institution_admin" class="col-md-3 col-form-label text-md-right">@lang('dashboard.users.is-institution-admin')</label>

                    <div class="col-md-6">
                        <select name="is_institution_admin" id="is_institution_admin" class="form-control @error('is_institution_admin') is-invalid @enderror">
                            <option value="0" {{ old('is_institution_admin') == 0 ? "selected" : "" }}>No</option>
                            <option value="1" {{ old('is_institution_admin') == 1 ? "selected" : "" }}>Yes</option>
                        </select>

                        @error('is_institution_admin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">
                            @lang('dashboard.create')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
