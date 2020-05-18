@extends('layouts.appAdmin')
@section('title','History credit By Admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">History Credit</h3>

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
                    <select class="js-select2" name="property" onchange="location = this.value;">
                        <option value="{{ route('showtopuppaycredit') }}">ทุกสถานะ</option>
                        <option value="{{ route('showtopuppaycreditadd') }}" selected="selected">เติมเงินเข้าบัญชี
                        </option>
                        <option value="{{ route('showtopuppaycredituse') }}">เงินออกจากบัญชี</option>
                        <option value="{{ route('showtopuppaycreditchange') }}">หักเงินจากบัญชี</option>
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
                <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                    <select class="js-select2" name="type">
                        <option selected="selected">Export</option>
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                    <div class="dropDownSelect2"></div>
                </div>

                {{-- ค้นหา --}}
                <div class="text-right mb-4 float-left">
                    <form class="form-inline" action="" method="GET">
                        <div class="form-group">
                            <input class="au-input au-input--s" type="text" name="name" id="name"
                                placeholder="Search" />
                        </div>
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
                {{-- ค้นหา --}}
            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">User</th>
                        <th scope="col">Topup Money</th>
                        <th scope="col">Change Money</th>
                        <th scope="col">Pay</th>
                        <th scope="col">Type</th>
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
                    @foreach ($hiscredit as $his)
                    <tr class="tr-shadow">
                        <td>{{ $his->created_at }}</td>
                        <td>{{ $his->name }} {{ $his->surname }}</td>
                        @if ($his->typeCreate == 'ADD')
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
                                    data-target="#hiscreditModal{{ $his->hiscredit_id }}" data-placement="top"
                                    title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </div>
                        </td>
                        @endif
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            {{ $hiscredit->links() }}
        </div>
        <!-- END DATA TABLE -->
    </div>
</div>
@endsection

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
                                    <th scope="col">Change Money</th>
                                    <th scope="col">Pay</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">created By</th>
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
                                    <td>{{ $his->create_by }}</td>
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
