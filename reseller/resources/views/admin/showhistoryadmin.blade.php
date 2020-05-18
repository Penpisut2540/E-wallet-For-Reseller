@extends('layouts.appAdmin')
@section('title','History order By Admin')
@section('content')

{{-- Datepicker --}}
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<style>
    #cler {
        margin: 4px;
    }

    #cleardate {
        margin-right: 390px;
        margin-top: 4px;
    }

    /* #export {
        margin-right: 1000;
        margin-top: 4px;
    } */
</style>

<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">Order</h3>

        @if (session('status'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="table-data__tool">
            <div class="table-data__tool-left">
                <form class="form-inline" action="{{ route('searchhistoryadminbydate') }}" method="GET">
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
                    <div class="text-right mb-4 float-left ml-2">
                        <input size="40" class="au-input au-input--s" type="text" name="name" id="name"
                            value="{{ $name }}" placeholder="Search name , email , order id , product name" />
                    </div>

                    <div class="text-right mb-4 float-left">
                        <button class="btn btn-info btn-s ml-2" type="submit"><i class="fas fa-search"></i></button>
                    </div>

                </form>
            </div>
            <div class="table-data__tool-left" id="cleardate">
                <div class="text-right mb-4 float-left">
                    <form class="form-inline" action="{{ route('showhistoryadmin') }}">
                        <button class="btn btn-dark btn-s " type="submit" title="clear"><i
                                class="fas fa-redo"></i></button>
                    </form>
                </div>
            </div>
            <div class="table-data__tool-right" id="export">
                <a class="btn btn-secondary" href="{{ route('exporttoexcel') }}" target="_blank">Export</a>
            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Order ID</th>
                        <th scope="col">Name</th>
                        {{-- <th scope="col">Ref. Order</th> --}}
                        {{-- <th scope="col">Credit ID</th> --}}
                        {{-- <th scope="col">Creat By</th> --}}
                        {{-- <th scope="col">Product Id</th> --}}
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th></th>
                    </tr>
                </thead>
                @if (session('status2'))
                <div class="sufee-alert alert with-close alert-info alert-dismissible fade show">
                    <span class="badge badge-pill badge-danger">try agian</span>
                    {{ session('status2') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <tbody>
                    @if(count($history) == 0)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <br>
                            <br>
                            <p align="left">
                                <img src="{{ asset('images/icon/nodata.png') }}" alt="nodata" width="150"
                                    height="150" />
                            </p>
                            <br>
                            <br>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @else
                    @foreach ($history as $his)
                    <tr class="tr-shadow">
                        <td>{{ $his->created_at }}</td>
                        {{-- <td>{{ $his->credit_id }}</td> --}}
                        <td>{{ $his->order_id }}</td>
                        <td>{{ $his->create_by }}</td>
                        {{-- <td>{{ $his->order_ref }}</td> --}}
                        {{-- <td>{{ $his->credit_id }}</td> --}}
                        {{-- <td>{{ $his->create_by }}</td> --}}
                        {{-- <td>{{ $his->product_id }}</td> --}}
                        <td>{{ $his->product_name }}</td>
                        <td>
                            <font color="red">{{ number_format($his->price , 2) }}</font>
                        </td>
                        <td>
                            <div class="table-data-feature">
                                {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button> --}}
                                <button class="item" data-toggle="modal"
                                    data-target="#hisorderModal{{ $his->order_id }}" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <br>
            {{ $history->links() }}
        </div>
    </div>
</div>
@endsection

@section('modal')
<!-- modal showhistory -->
@foreach ($history as $his)
<div class="modal fade" id="hisorderModal{{ $his->order_id }}" tabindex="-1" role="dialog"
    aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Order# {{ $his->order_id }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data4">
                            {{-- <table class="table"> --}}
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Order ID</th>
                                    <th scope="col">Ref. Order</th>
                                    <th scope="col">Credit ID</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Product Id</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr-shadow">
                                    <td>{{ $his->created_at }}</td>
                                    <td>{{ $his->order_id }}</td>
                                    <td>{{ $his->order_ref }}</td>
                                    <td>{{ $his->credit_id }}</td>
                                    <td>{{ $his->create_by }}</td>
                                    <td>{{ $his->product_id }}</td>
                                    <td>{{ $his->product_name }}</td>
                                    <td>
                                        <font color="red">{{ number_format($his->price , 2) }}</font>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                            </tbody>
                        </table>
                        <br>
                    </div>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- modal showhistory -->
@endsection
