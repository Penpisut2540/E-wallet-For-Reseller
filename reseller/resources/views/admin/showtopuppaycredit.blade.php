@extends('layouts.appAdmin')
@section('title','History credit By Admin')
<style>
    #cler {
        margin: 5px;
    }

    #clear {
        margin-right: 370px;
        margin-top: 4px;
    }

    option:checked {
        color: white;
        background: gray;
    }

</style>

@if(!empty(Session::get('show')) && Session::get('show') == 1)
<script>
    $(document).ready(function () {
        $('all .box').modal('show');
    });
</script>
@endif

@section('content')

<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

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
            <form class="form-inline" action="{{ route('showtopuppaycredit') }}" method="GET">
                <div class="text-right mb-4 float-left">
                    <div>
                        <select class="custom-select" id="myselect" name="myselect" value="">
                            @if ($select == 'all')
                            <option value="all" selected>ทุกสถานะ</option>
                            <option value="green">เติมเงินเข้าบัญชี</option>
                            <option value="red">เงินออกจากบัญชี</option>
                            <option value="blue">หักเงินจากบัญชี</option>
                            @elseif ($select == 'green')
                            <option value="all">ทุกสถานะ</option>
                            <option value="green" selected>เติมเงินเข้าบัญชี</option>
                            <option value="red">เงินออกจากบัญชี</option>
                            <option value="blue">หักเงินจากบัญชี</option>
                            @elseif ($select == 'red')
                            <option value="all">ทุกสถานะ</option>
                            <option value="green">เติมเงินเข้าบัญชี</option>
                            <option value="red" selected>เงินออกจากบัญชี</option>
                            <option value="blue">หักเงินจากบัญชี</option>
                            @elseif ($select == 'blue')
                            <option value="all">ทุกสถานะ</option>
                            <option value="green">เติมเงินเข้าบัญชี</option>
                            <option value="red">เงินออกจากบัญชี</option>
                            <option value="blue" selected>หักเงินจากบัญชี</option>
                            @elseif ($select == "")
                            <option value="all" selected>ทุกสถานะ</option>
                            <option value="green">เติมเงินเข้าบัญชี</option>
                            <option value="red">เงินออกจากบัญชี</option>
                            <option value="blue">หักเงินจากบัญชี</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="text-right mb-4 float-left ml-2">
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
                    <input class="ml-2" id="enddate" name="enddate" width="276" value="{{ $end }}" autocomplete=off />
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
                    <input class="au-input au-input--s" type="text" name="name" id="name" value="{{ $name }}"
                        placeholder="Search name , credit id" />
                </div>

                <div class="text-right mb-4 float-left">
                    <button class="btn btn-info btn-lg ml-2" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <div class="text-right mb-4 float-left" id="clear">
                <form class="form-inline" action="{{ route('showtopuppaycredit') }}">
                    <button class="btn btn-dark btn-lg " type="submit" title="clear"><i
                            class="fas fa-redo"></i></button>
                </form>
            </div>

            <div class="table-data__tool-right">
                <a class="btn btn-secondary" href="{{ route('exportrehiscredittoexcel') }}" target="_blank">Export</a>
            </div>
        </div>
        {{-- all --}}
        <div class="all box">
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
                        <tr class="tr-shadow">
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
</div>
{{-- all --}}
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
@endsection
