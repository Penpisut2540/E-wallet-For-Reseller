@extends('layouts.app')
@section('title','Order Details')
@section('content')
<div class="container-fulid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order Details</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @foreach ($product as $products)

                    @if ($products->product_id == 1)
                        AAAAAAAAAAAA
                    @elseif ($products->product_id == 2)
                        I have multiple records!
                    @else
                        I don't have any records!
                    @endif

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
