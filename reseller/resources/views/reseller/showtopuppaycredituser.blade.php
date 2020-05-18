@extends('layouts.app')
@section('title','History credit')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">รายการ</h3>

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
                <div class="rs-select2--light rs-select2--md">
                    <select class="js-select2" name="property">
                        <option selected="selected">All Properties</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <div class="rs-select2--light rs-select2--sm">
                    <select class="js-select2" name="time">
                        <option selected="selected">Today</option>
                        <option value="">3 Days</option>
                        <option value="">1 Week</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>
                <button class="au-btn-filter">
                    <i class="zmdi zmdi-filter-list"></i>filters</button>
            </div>
            <div class="table-data__tool-right">
                {{-- ค้นหา --}}
                {{-- <div class="text-right mb-4 float-left">
                    <form class="form-inline" action="" method="GET">
                        <div class="form-group">
                            <input class="au-input au-input--s" type="text" name="name" id="name"
                                placeholder="Search" />
                        </div>
                        <button class="au-btn au-btn-icon au-btn--blue au-btn--sm ml-2" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div> --}}
                {{-- ค้นหา --}}
            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        {{-- <th scope="col">User</th> --}}
                        <th scope="col">Date</th>
                        <th scope="col">Topup Money</th>
                        <th scope="col">Pay</th>
                        <th scope="col">Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hiscredit as $his)
                    <tr>
                        <td>{{ $his->created_at }}</td>
                        {{-- <td>{{ $his->credit_id }} : {{ $his->name }} {{ $his->surname }}</td> --}}
                        @if ($his->topup !=0)
                        <td>
                            <font color="green"> + {{ $his->topup }}</font>
                        </td>
                        @else
                        <td>
                            <font color="green"> {{ $his->topup }}</font>
                        </td>
                        @endif

                        @if ($his->pay !=0)
                        <td>
                            <font color="red"> - {{ $his->pay }}</font>
                        </td>
                        @else
                        <td>
                            <font color="red">{{ $his->pay }}</font>
                        </td>
                        @endif



                        @if ($his->typeCreate == 'ADD')
                        <td>
                            <font color="green">เติมเงินเข้าบัญชี</font>
                        </td>
                        @elseif($his->typeCreate == 'USED')
                        <td>
                            <font color="red">ชำระสินค้า</font>
                        </td>
                        @endif
                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {{-- {{ $hiscredit->links() }} --}}
        </div>
        <!-- END DATA TABLE -->
    </div>
</div>
@endsection
