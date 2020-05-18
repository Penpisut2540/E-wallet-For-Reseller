@extends('layouts.appAdmin')
@section('title','Manage Credit By Admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">Manage Credit</h3>

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
                <a href="{{ route('insertcreditbyadmin') }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
                    <i class="zmdi zmdi-plus"></i>add credit</a>
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
                    <form class="form-inline" action="{{ route('searchcreditadmin') }}" method="GET">
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
                        <th scope="col">Credit ID</th>
                        <th scope="col">User</th>
                        <th scope="col">before</th>
                        <th scope="col">current</th>
                        <th scope="col">after</th>
                        {{-- <th scope="col">Create by</th>
                        <th scope="col">Update by</th> --}}
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col">Add Money</th>
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
                    @foreach ($credit as $credits)
                    <tr class="tr-shadow">
                        <td>{{ $credits->credit_id}}</td>
                        <td>{{ $credits->name}} {{ $credits->surname}}</td>
                        <td>
                            <span class="block-email">{{ number_format($credits->before , 2) }}</span>
                        </td>
                        <td>
                            <span class="block-email">{{ number_format($credits->current , 2) }}</span>
                        </td>
                        <td>
                            <span class="block-email"><font color="green">{{ number_format($credits->after , 2) }}</font></span>
                        </td>
                        {{-- <td>{{ $credits->create_by}}</td>
                        <td>{{ $credits->update_by}}</td> --}}
                        <td>{{ $credits->created_at}}</td>
                        <td>{{ $credits->updated_at}}</td>
                        <td>
                            <a href="addmoneybyadmin/{{ $credits->credit_id }}"
                                class="au-btn au-btn-icon au-btn--blue au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add money</a>
                        </td>
                        <td>
                            <div class="table-data-feature">
                                <a href="" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </a>
                                @if (($credits->before == 0 ) AND ($credits->after == 0 ) AND ($credits->current == 0 ))
                                <button class="item" data-toggle="modal" id="confirm" data-target="#confirmModal"
                                    data-placement="top" type="button" title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                                @endif
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
            {{ $credit->links() }}
        </div>
        <!-- END DATA TABLE -->
    </div>
</div>
@endsection

<!-- modal static -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Confirm for Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    คุณต้องการลบเครดิต คุณ {{ $credits->name }} {{ $credits->surname }} ใช่หรือไม่ ?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('delectcreditbyadmin' , $credits->credit_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="sunmit" class="btn btn-danger">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal static -->
