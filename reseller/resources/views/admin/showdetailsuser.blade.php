@extends('layouts.appAdmin')
@section('title','Show Detail User')
<script>
    function goBack() {
      window.history.back();
    }
</script>
@section('content')

<style>
    .nav-pills .nav-link.active {
        background-color: grey;
    }

    .nav-pills .nav-link {
        color: gray;
    }
</style>
<button type="button" class="btn btn-success" onclick="goBack()"><i class="fas fa-angle-left"></i> BACK</button>
<br>
<br>

<div class="row ">
    <div class="col-3">
        <ul class="nav flex-column nav-pills" id="myTab" role="tablist" aria-orientation="vertical">
            <li>
                <a class="nav-link active" id="v-pills-profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="v-pills-profile" aria-selected="true">Profile</a>
            </li>
            <li>
                <a class="nav-link" id="v-pills-credit-tab" data-toggle="tab" href="#credit" role="tab"
                    aria-controls="v-pills-credit" aria-selected="false">Credit</a>
            </li>
            <li>
                <a class="nav-link" id="v-pills-hiscredit-tab" data-toggle="tab" href="#hiscredit" role="tab"
                    aria-controls="v-pills-hiscredit" aria-selected="false">รายการ</a>
            </li>
            <li>
                <a class="nav-link" id="v-pills-hisbuy-tab" data-toggle="tab" href="#hisbuy" role="tab"
                    aria-controls="v-pills-hisbuy" aria-selected="false">ประวัติการสั่งซื้อ</a>
            </li>
        </ul>
        <script>
            $(function() {
                $('a[data-toggle="tab"]').on('click', function(e) {
                window.localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
                var activeTab = window.localStorage.getItem('activeTab');
                if (activeTab) {
                    $('#myTab a[href="' + activeTab + '"]').tab('show');
                    window.localStorage.removeItem("activeTab");
                }
            });
        </script>
    </div>
    <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="col-md-9">
                    <div class="au-card chart-percent-card">
                        <div class="au-card-inner">
                            <h3 class="title-5 m-b-35">&nbsp;&nbsp;&nbsp;&nbsp; K. {{ $user->name }}
                                {{ $user->surname }}</h3>
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <tbody>
                                        <tr>
                                            <td>User ID</td>
                                            <td>{{ $user->id }}</td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ $user->name }} {{ $user->surname }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tel</td>
                                            <td>{{ $user->tel }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>{{ $user->typeUser }}</td>
                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td>{{ $user->password }}</td>
                                        </tr>
                                        <tr>
                                            <td>Created at</td>
                                            <td>{{ $user->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <td>Updated at</td>
                                            <td>{{ $user->updated_at }}</td>
                                        </tr>
                                        <tr></tr>
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="credit" role="tabpanel" aria-labelledby="v-pills-credit-tab">
                <div class="col-md-9">
                    <div class="au-card chart-percent-card">
                        <div class="au-card-inner">
                            <h3 class="title-5 m-b-35">K. {{ $user->name }}
                                {{ $user->surname }}</h3>
                            <div class="row m-t-25">
                                <div class="col-sm-3 col-lg-6">
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
                                <div class="col-sm-6 col-lg-6">
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
                            <div class="row m-t-25">
                                <div class="col-sm-6 col-lg-6">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="overview-item overview-item--c3">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-calendar-note"></i>
                                                </div>
                                                <div class="text">
                                                    <h2>{{ $sumcreditday }}</h2>
                                                    <span>ยอดเติมรายวัน</span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-25">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="overview-item overview-item--c2">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-shopping-cart"></i>
                                                </div>
                                                <div class="text">
                                                    <h2>{{ $sumbuymonth }}</h2>
                                                    <span>ยอดการซื้อรายเดือน</span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="overview-item overview-item--c3">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-calendar-note"></i>
                                                </div>
                                                <div class="text">
                                                    <h2>{{ $sumcreditmonth }}</h2>
                                                    <span>ยอดการเติมรายเดือน</span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-25">
                                <div class="col-sm-6 col-lg-6">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="overview-item overview-item--c3">
                                        <div class="overview__inner">
                                            <div class="overview-box clearfix">
                                                <div class="icon">
                                                    <i class="zmdi zmdi-calendar-note"></i>
                                                </div>
                                                <div class="text">
                                                    <h2>{{ $sumall }}</h2>
                                                    <span>ยอดการเติมสะสม</span>
                                                </div>
                                            </div>
                                            <div class="overview-chart">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="hiscredit" role="tabpanel" aria-labelledby="v-pills-hiscredit-tab">
                {{-- //รายการการเติมเงิน--}}
                <div class="col-md-12">
                    {{-- <h3 class="title-5 m-b-35">รายการ</h3> --}}
                    @if (session('status'))
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                        <span class="badge badge-pill badge-success">Success</span>
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

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
                                    <td>
                                        <br>
                                        <br>
                                        <p align="right">
                                            <img src="{{ asset('images/icon/nodata.png') }}" alt="nodata" width="150" height="150"/>
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
                                        <span class="block-email">
                                            <font color="red"> - {{ $his->pay }}</font>
                                        </span>
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
                                                data-target="#hiscreditModal{{ $his->hiscredit_id }}"
                                                data-placement="top" title="More">
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
                        {{-- {{$hiscredit->appends(['p1' => $hiscredit->currentPage(), 'p2' => $history->currentPage()])->links()}}
                        --}}
                        {{-- {{ $hiscredit->appends(Request::except('page'))->links() }} --}}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="hisbuy" role="tabpanel" aria-labelledby="v-pills-hisbuy-tab">
                {{-- //ประวัติการสั่งซื้อ--}}
                <div class="col-md-12">
                    {{-- <h3 class="title-5 m-b-35">ประวัติการสั่งซื้อ</h3> --}}
                    @if (session('status'))
                    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                        <span class="badge badge-pill badge-success">Success</span>
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    {{-- <th scope="col">Credit ID</th> --}}
                                    <th scope="col">Order ID</th>
                                    {{-- <th scope="col">Ref. Order</th> --}}
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
                                @if(count($hiscredit) == 0)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <br>
                                        <br>
                                        <p align="center">
                                            <img src="{{ asset('images/icon/nodata.png') }}" alt="nodata" width="150" height="150"/>
                                        </p>
                                        <br>
                                        <br>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @else
                                @foreach ($history as $his)
                                <tr class="tr-shadow">
                                    <td>{{ $his->created_at }}</td>
                                    {{-- <td>{{ $his->credit_id }}</td> --}}
                                    <td>{{ $his->order_id }}</td>
                                    {{-- <td>{{ $his->order_ref }}</td> --}}
                                    <td>{{ $his->product_name }}</td>
                                    <td>
                                        <font color="red">{{ number_format($his->price , 2) }}</font>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="modal"
                                                data-target="#hisorderModal{{ $his->order_id }}" data-placement="top"
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
                        {{-- {{$history->appends(['p1' => $hiscredit->currentPage(), 'p2' => $history->currentPage()])->links()}}
                        --}}
                    </div>
                    <br>
                </div>
            </div>
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
                            <thead>
                                <tr>
                                    <th scope="col">Date
                                    </th>
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
                                        <span class="block-email">
                                            <font color="red"> - {{ $his->pay }}</font>
                                        </span>
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
