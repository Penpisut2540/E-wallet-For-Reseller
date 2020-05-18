@extends('layouts.appAdmin')
@section('title','Products')
@section('content')


{{-- Datepicker --}}
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<style>
    #clear {
        margin-right: 475px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-9">
        <h3 class="title-5 m-b-35">Products</h3>

        <div class="table-data__tool">
            <div class="table-data__tool-right">
                <form class="form-inline" action="{{ route('showproductadmin') }}" method="GET">
                    <div class="text-right mb-4 float-left">
                        <input class="form-inline" id="startdate" name="startdate" width="276" value="{{ $start }}"
                            autocomplete=off />
                        <script>
                            $('#startdate').datepicker({
                            uiLibrary: 'bootstrap4',
                            format: 'yyyy-mm-dd',
                            maxDate: function() {
                                var date = new Date();
                                date.setDate(date.getDate());
                                return new Date(date.getFullYear(), date.getMonth(), date.getDate());
                            }
                        });
                        </script>
                    </div>

                    <div class="text-right mb-4 float-left">
                        <input class="ml-2" id="enddate" name="enddate" width="276" value="{{ $end }}"
                            autocomplete=off />
                        <script>
                            $('#enddate').datepicker({
                            uiLibrary: 'bootstrap4',
                            format: 'yyyy-mm-dd',
                            maxDate: function() {
                                var date = new Date();
                                date.setDate(date.getDate());
                                return new Date(date.getFullYear(), date.getMonth(), date.getDate());
                            }
                        });
                        </script>
                    </div>

                    <div class="text-right mb-4 float-left">
                        <button class="btn btn-info btn-s ml-2" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="text-right mb-4 float-left" id="clear">
                <form class="form-inline" action="{{ route('showproductadmin') }}">
                    <button class="btn btn-dark btn-s " type="submit" title="clear"><i class="fas fa-redo"></i></button>
                </form>
            </div>
        </div>

        @if (session('status'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="table-responsive table--no-card m-b-30">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th scope="col">Product ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">
                            <p align="left">Amount</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pro as $products)
                    <tr>
                        <td>{{ $products->product_id }}</td>
                        <td>{{ $products->product_name }}</td>
                        <td>{{ number_format($products->price , 2) }}</td>
                        <td>{{ $products->q }}</td>
                        <td>
                            <p align="left">{{ number_format($products->total,2) }}</p>
                        </td>
                    </tr>
                    @endforeach
                    <td>
                        <font color="black">Total</font>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <font color="black">{{ $pro->sum('q') }}</font>
                    </td>
                    <td>
                        <font color="black">
                            <p align="left">{{ number_format($pro->sum('total') , 2) }}</p>
                        </font>
                    </td>
                </tbody>

                {{-- <tbody>
                    @foreach ($product as $products)
                    <tr>
                        <td>{{ $products->product_id }}</td>
                <td>{{ $products->product_name }}</td>
                <td>{{ number_format($products->price , 2) }}</td>

                @if ($products->product_id == 1)
                <td>{{ $count1 }}</td>
                <td>
                    <p align="left">{{ number_format($count1*$products->price , 2) }}</p>
                </td>
                @elseif ($products->product_id == 2)
                <td>{{ $count2 }}</td>
                <td>
                    <p align="left">{{ number_format($count2*$products->price , 2) }}</p>
                </td>
                @elseif ($products->product_id == 3)
                <td>{{ $count3 }}</td>
                <td>
                    <p align="left">{{ number_format($count3*$products->price , 2) }}</p>
                </td>
                @elseif ($products->product_id == 4)
                <td>{{ $count4 }}</td>
                <td>
                    <p align="left">{{ number_format($count4*$products->price , 2) }}</p>
                </td>
                @elseif ($products->product_id == 5)
                <td>{{ $count5 }}</td>
                <td>
                    <p align="left">{{ number_format($count5*$products->price , 2 ) }}</p>
                </td>
                @elseif ($products->product_id == 6)
                <td>{{ $count6 }}</td>
                <td>
                    <p align="left">{{ number_format($count6*$products->price , 2) }}</p>
                </td>
                @endif
                </tr>
                @endforeach
                <td>
                    <font color="black">Total</font>
                </td>
                <td></td>
                <td></td>
                <td>
                    <font color="black">{{ $count }}</font>
                </td>
                <td>
                    <font color="black">{{ number_format($sumproducts , 2) }}</font>
                </td>
                </tbody> --}}

            </table>
        </div>
    </div>
</div>
@endsection
