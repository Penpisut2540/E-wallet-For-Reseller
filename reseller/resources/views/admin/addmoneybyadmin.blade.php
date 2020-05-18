@extends('layouts.appAdmin')
@section('title','Add Money by Admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h3 class="title-5 m-b-35">Add Money</h3>
        @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
        @endif
        <div class="au-card m-b-30">
            <div class="au-card-inner">
                <div class="table-responsive table-responsive-data2">
                    <form action="{{ route('updatemoneybyadmin' , $credit->credit_id) }}" method="POST">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="form-group row">
                            <label for="credit_id"
                                class="col-md-4 col-form-label text-md-right">{{ __('Credit ID') }}</label>

                            <div class="col-md-6">
                                <input id="credit_id" type="text"
                                    class="form-control @error('credit_id') is-invalid @enderror" name="credit_id"
                                    value="{{ $credit->credit_id}}" required autocomplete="credit_id" autofocus
                                    readonly>

                                @error('credit_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="current" class="col-md-4 col-form-label text-md-right">{{ __('Money') }}</label>

                            <div class="col-md-6">
                                <input id="current" type="int"
                                    class="form-control @error('current') is-invalid @enderror" name="current" value="0"
                                    required autocomplete="current" autofocus>

                                @error('current')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                    <i class="fas fa-save"></i>{{ __('Add Money') }}
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
