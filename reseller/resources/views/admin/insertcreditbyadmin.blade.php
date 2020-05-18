@extends('layouts.appAdmin')
@section('title','Create Credit by Admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h3 class="title-5 m-b-35">Create Credit</h3>
        @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
        @endif
        @if (session('status2'))
        <div class="alert alert-success">
            {{ session('status2') }}
        </div>
        @endif
        <div class="au-card m-b-30">
            <div class="au-card-inner">
                <div class="table-responsive table-responsive-data2">
                    <form method="POST" action="{{ route('storecreditbyadmin') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Create By') }}</label>

                            <div class="col-md-6">
                                <input id="create_by" type="text"
                                    class="form-control @error('create_by') is-invalid @enderror" name="create_by"
                                    value="{{ Auth::user()->name }} {{ Auth::user()->surname }}" required
                                    autocomplete="create_by" autofocus readonly>

                                @error('create_by')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_id" class="col-md-4 col-form-label text-md-right">{{ __('User') }}</label>

                            <div class="col-md-6">

                                <select class="form-control" name="user_id" id="user_id"
                                    class="form-control @error('user_id') is-invalid @enderror" name="user_id"
                                    value="{{ old('user_id') }}" required autofocus>
                                    @foreach ($user as $users)
                                    <option value="{{ $users->id }}">{{ $users->name }} {{ $users->surname }}</option>
                                    @endforeach
                                </select>

                                @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                    <i class="fas fa-save"></i>{{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
