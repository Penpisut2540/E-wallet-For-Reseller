@extends('layouts.app')
@section('title','Buy Order')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">Buy Order</h3>
        @if (session('status'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="au-card m-b-30">
            <div class="au-card-inner">
                <div class="table-responsive table-responsive-data2">
                    <form method="POST" action="{{ route('storebuyorder') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="order_id"
                                class="col-md-4 col-form-label text-md-right">{{ __('Order ID : ') }}</label>
                            <label for="" class="col-md-4 col-form-label text-md-left"> @foreach ($order as $o)
                                {{ $o->order_id + 1 }}
                                @endforeach</label>

                            <div class="col-md-6">

                                @foreach ($order as $o)
                                <input id="order_id" type="hidden"
                                    class="form-control @error('order_id') is-invalid @enderror" name="order_id"
                                    value="{{ $o->order_id + 1 }}" required autocomplete="order_id" autofocus readonly>
                                @endforeach

                                @error('order_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="order_ref"
                                class="col-md-4 col-form-label text-md-right">{{ __('Ref. order : ') }}</label>
                            <label for="" class="col-md-4 col-form-label text-md-left">@foreach ($order as $o)
                                {{ $o->order_ref + 1 }}
                                @endforeach</label>

                            <div class="col-md-6">

                                @foreach ($order as $o)
                                <input id="order_ref" type="hidden"
                                    class="form-control @error('order_ref') is-invalid @enderror" name="order_ref"
                                    value="{{ $o->order_ref + 1 }}" required autocomplete="order_ref" autofocus
                                    readonly>
                                @endforeach
                                @error('order_ref')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="credit_id"
                                class="col-md-4 col-form-label text-md-right">{{ __('Credit ID : ') }}</label>
                            <label for="" class="col-md-4 col-form-label text-md-left">@foreach ($credit as $c)
                                {{ $c->credit_id }}
                                @endforeach</label>

                            <div class="col-md-6">

                                <input id="credit_id" type="hidden"
                                    class="form-control @error('credit_id') is-invalid @enderror" name="credit_id"
                                    value="@foreach ($credit as $c){{ $c->credit_id }}@endforeach" required
                                    autocomplete="credit_id" autofocus readonly>

                                @error('credit_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="create_by"
                                class="col-md-4 col-form-label text-md-right">{{ __('Purchaser K. : ') }}</label>
                            <label for="" class="col-md-4 col-form-label text-md-left">{{ Auth::user()->name }}
                                {{ Auth::user()->surname }}</label>

                            <div class="col-md-6">

                                <input id="create_by" type="hidden"
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
                            <label for="product_id"
                                class="col-md-4 col-form-label text-md-right">{{ __('Product ID : ') }}</label>
                            <label for=""
                                class="col-md-4 col-form-label text-md-left">{{ $product->product_id }}</label>

                            <div class="col-md-6">

                                <input id="product_id" type="hidden"
                                    class="form-control @error('product_id') is-invalid @enderror" name="product_id"
                                    value="{{ $product->product_id }}" required autocomplete="product_id" autofocus
                                    readonly>

                                @error('product_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="product_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Product Name : ') }}</label>
                            <label for=""
                                class="col-md-4 col-form-label text-md-left">{{ $product->product_name }}</label>

                            <div class="col-md-6">

                                <input id="product_name" type="hidden"
                                    class="form-control @error('product_name') is-invalid @enderror" name="product_name"
                                    value="{{ $product->product_name }}" required autocomplete="product_name" autofocus
                                    readonly>

                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price : ') }}</label>
                            <label for="" class="col-md-4 col-form-label text-md-left"> {{ $product->price }}</label>

                            <div class="col-md-6">

                                <input id="price" type="hidden"
                                    class="form-control @error('price') is-invalid @enderror" name="price"
                                    value="{{ $product->price }}" required autocomplete="price" autofocus readonly>

                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-tags"></i> {{ __('Buy Now') }}
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
