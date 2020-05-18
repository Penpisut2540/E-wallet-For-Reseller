@extends('layouts.app')
@section('title','Credit User')
@section('content')
<div class="container">
    <div class="row m-t-25 ">
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c1">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div class="text">
                            @foreach ($credit as $credits)
                            <h2>{{ $credits->credit_id }}</h2>
                            @endforeach
                            <span>Credit ID</span>
                        </div>
                    </div>
                    <div class="overview-chart">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c4">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-plus"></i>
                        </div>
                        <div class="text">
                            @foreach ($credit as $credits)
                            <h2>{{ $credits->after }}</h2>
                            @endforeach
                            <span>ยอดเงินคงเหลือ</span>
                        </div>
                    </div>
                    <div class="overview-chart">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row m-t-25">
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c3">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-calendar-note"></i>
                        </div>
                        <div class="text">
                            <h2>{{ $sumtopupday }}</h2>
                            <span>ยอดเติมรายวัน</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <canvas id="widgetChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c2">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                        <div class="text">
                            <h2>{{ $sumbuyday }}</h2>
                            <span>ยอดซื้อรายวัน</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <canvas id="widgetChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c3">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-calendar-note"></i>
                        </div>
                        <div class="text">
                            <h2>{{ $sumtopup }}</h2>
                            <span>ยอดการเติมรวม</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <canvas id="widgetChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="overview-item overview-item--c2">
                <div class="overview__inner">
                    <div class="overview-box clearfix">
                        <div class="icon">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                        <div class="text">
                            <h2>{{ $sumbuy }}</h2>
                            <span>ยอดการซื้อสะสม</span>
                        </div>
                    </div>
                    <div class="overview-chart">
                        <canvas id="widgetChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<div class="container">
    <div class="col-md-12">
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
            <div class="table-data__tool-right">

            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">User</th>
                        <th scope="col">Topup Money</th>
                        <th scope="col">Change</th>
                        <th scope="col">Pay</th>
                        <th scope="col">Type</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($hiscredit) == 0)
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
                    @foreach ($hiscredit as $his)
                    <tr>
                        <td>{{ $his->created_at }}</td>
                        <td>{{ $his->name }} {{ $his->surname }}</td>
                        @if ($his->topup !=0)
                        <td>
                            <font color="green"> + {{ $his->topup }}</font>
                        </td>
                        @else
                        <td>
                            <font color="green"> {{ $his->topup }}</font>
                        </td>
                        @endif

                        @if ($his->change !=0)
                        <td>
                            <span class="block-email">
                                <font color="blue"> - {{ $his->change }}</font>
                            </span>
                        </td>
                        @else
                        <td>
                            <font color="blue"> {{ $his->change }}</font>
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
                        @elseif($his->typeCreate == 'CHENGE')
                        <td>
                            <font color="blue">หักเงินออกจากบัญชี</font>
                        </td>
                        @elseif($his->typeCreate == 'USED')
                        <td>
                            <font color="red">เงินออกจากบัญชี</font>
                        </td>
                        @endif
                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="modal"
                                    data-target="#hiscreditModal{{ $his->hiscredit_id }}" data-placement="top"
                                    title="More">
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
            {{ $hiscredit->appends(Request::except('page'))->links() }}
        </div>
    </div>
</div>
@endsection

@section('modal')
<!-- modal showhistorycredit -->
@foreach ($hiscredit as $his)
<div class="modal fade" id="hiscreditModal{{ $his->hiscredit_id }}" tabindex="-1" role="dialog"
    aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Order# {{ $his->hiscredit_id }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data4">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Credit ID</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Topup Money</th>
                                    <th scope="col">Change</th>
                                    <th scope="col">Pay</th>
                                    <th scope="col">Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr-shadow">
                                    <td>{{ $his->created_at }}</td>
                                    <td>{{ $his->credit_id }}</td>
                                    <td>{{ $his->name }} {{ $his->surname }}</td>
                                    @if ($his->topup !=0)
                                    <td>
                                        <span class="block-email">
                                            <font color="green"> + {{ $his->topup }}</font>
                                        </span>
                                    </td>
                                    @else
                                    <td>
                                        <font color="green"> {{ $his->topup }}</font>
                                    </td>
                                    @endif

                                    @if ($his->change !=0)
                                    <td>
                                        <span class="block-email">
                                            <font color="blue"> - {{ $his->change }}</font>
                                        </span>
                                    </td>
                                    @else
                                    <td>
                                        <font color="blue"> {{ $his->change }}</font>
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
                                    @elseif($his->typeCreate == 'CHENGE')
                                    <td>
                                        <font color="blue">หักเงินออกจากบัญชี</font>
                                    </td>
                                    @elseif($his->typeCreate == 'USED')
                                    <td>
                                        <font color="red">เงินออกจากบัญชี</font>
                                    </td>
                                    @endif
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
<!-- modal showhistorycredit -->
@endsection
