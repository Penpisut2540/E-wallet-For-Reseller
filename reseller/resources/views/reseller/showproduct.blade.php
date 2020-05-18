@extends('layouts.app')
@section('title','Products')
@section('content')
@if(!empty(Session::get('status3')) && Session::get('status3') == 3)
<script>
    $(document).ready(function(){
        $('#alertModal').modal('show');
    });
</script>
@elseif(!empty(Session::get('status4')) && Session::get('status4') == 4)
<script>
    $(document).ready(function(){
        $('#alertsuccessModal').modal('show');
    });
</script>
@endif
<div class="row ">
    <div class="col-md-12">
        <h3 class="title-5 m-b-35">Products</h3>

        {{-- @if (session('status'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif --}}

    <div class="table-responsive table--no-card m-b-30">
        <table class="table table-borderless table-striped table-earning">
            <thead>
                <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Buy Now</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $products)
                <tr>
                    <td>{{ $products->product_id }}</td>
                    <td>{{ $products->product_name }}</td>
                    <td>{{ number_format($products->price, 2) }}</td>
                    <td>
                        {{-- <a href="buyorder/{{ $products->product_id }}" class="btn btn-danger">Buy Now</a> --}}
                        <button class="btn btn-danger" data-toggle="modal" id="confirm"
                            data-target="#buyModal{{ $products->product_id }}" data-placement="top" type="button"
                            title="Buy">Buy Now
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('modal')
<!-- alertModal -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Alert </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p align="center">
                    ยอดเงินคงเหลือของคุณไม่เพียงพอ กรุณาติดต่อเจ้าหน้าที่
                </p>
                <br>
                <p align="center"><i class="fas fa-phone" style="font-size: 15px;"></i> 02-038-5588
                    &nbsp;&nbsp;&nbsp;<i class="far fa-envelope" style="font-size: 18px;"></i>
                    adminreseller@ketshopweb.com</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal static -->

<!-- alertModal success -->
<div class="modal fade" id="alertsuccessModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Alert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center>
                    <p>
                        <i class="fa fa-check-circle"
                            style="font-size:48px;color:green"></i>&nbsp;&nbsp;การสั่งซื้อสำเร็จ
                    </p>
                </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!-- end modal static -->
@endsection

<!-- modal Buy User Modal -->
@section('buy')
@foreach ($product as $products)
<div class="modal fade" id="buyModal{{ $products->product_id }}" tabindex="-1" role="dialog"
    aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Confirm Payment #Order ID : @foreach ($order as $o)
                    {{ $o->order_id + 1 }}@endforeach</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('storebuyorder') }}">
                    @csrf
                    <div class="form-group row">
                        {{-- <label for="order_id"
                            class="col-md-4 col-form-label text-md-right">{{ __('Order ID : ') }}</label>
                        <label for="" class="col-md-4 col-form-label text-md-left"> @foreach ($order as $o)
                            {{ $o->order_id + 1 }}
                            @endforeach</label> --}}

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
                        {{-- <label for="order_ref"
                            class="col-md-4 col-form-label text-md-right">{{ __('Ref. order : ') }}</label>
                        <label for="" class="col-md-4 col-form-label text-md-left">@foreach ($order as $o)
                            {{ $o->order_ref + 1 }}
                            @endforeach</label> --}}

                        <div class="col-md-6">

                            @foreach ($order as $o)
                            <input id="order_ref" type="hidden"
                                class="form-control @error('order_ref') is-invalid @enderror" name="order_ref"
                                value="{{ $o->order_ref + 1 }}" required autocomplete="order_ref" autofocus readonly>
                            @endforeach
                            @error('order_ref')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    {{-- Show modal --}}
                    <span>
                        <p align="center">{{ __('Product : ') }} {{ $products->product_name }}</p>
                    </span>

                    <span>
                        <p align="center">{{ __('Price : ') }} {{ number_format($products->price,2) }} Baht.</p>
                    </span>
                    <br>
                    <hr>

                    <span>
                        <p align="right">
                            <font color="black">{{ __('Total : ') }} {{ number_format($products->price,2) }} Baht.
                            </font>
                        </p>
                    </span>

                    <hr>

                    {{-- Show modal --}}

                    <div class="form-group row">
                        {{-- <label for="credit_id" class="col-md-4 col-form-label text-md-right">{{ __('Credit ID : ') }}</label>
                        <label for="" class="col-md-4 col-form-label text-md-left">@foreach ($credit as $c)
                            {{ $c->credit_id }}
                            @endforeach</label> --}}

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
                        {{-- <label for="create_by"
                            class="col-md-4 col-form-label text-md-right">{{ __('Purchaser K. : ') }}</label>
                        <label for="" class="col-md-4 col-form-label text-md-left">{{ Auth::user()->name }}
                            {{ Auth::user()->surname }}</label> --}}

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
                        {{-- <label for="product_id"
                            class="col-md-4 col-form-label text-md-right">{{ __('Product ID : ') }}</label>
                        <label for="" class="col-md-4 col-form-label text-md-left">{{ $products->product_id }}</label>
                        --}}

                        <div class="col-md-6">

                            <input id="product_id" type="hidden"
                                class="form-control @error('product_id') is-invalid @enderror" name="product_id"
                                value="{{ $products->product_id }}" required autocomplete="product_id" autofocus
                                readonly>

                            @error('product_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        {{-- <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name : ') }}</label>
                        <label for="" class="col-md-4 col-form-label text-md-left">{{ $products->product_name }}</label>
                        --}}

                        <div class="col-md-6">

                            <input id="product_name" type="hidden"
                                class="form-control @error('product_name') is-invalid @enderror" name="product_name"
                                value="{{ $products->product_name }}" required autocomplete="product_name" autofocus
                                readonly>

                            @error('product_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        {{-- <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price : ') }}</label>
                        <label for="" class="col-md-4 col-form-label text-md-left">
                            {{ number_format($products->price,2) }} Baht.</label> --}}

                        <div class="col-md-6">

                            <input id="price" type="hidden" class="form-control @error('price') is-invalid @enderror"
                                name="price" value="{{ $products->price }}" required autocomplete="price" autofocus
                                readonly>

                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="modal-footer"> --}}
                    <p align="right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-info">
                            Confirm Payment</button>
                    </p>
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- end modal medium -->
@endsection
