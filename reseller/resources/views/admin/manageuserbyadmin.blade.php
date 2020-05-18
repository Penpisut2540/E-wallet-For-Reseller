@extends('layouts.appAdmin')
@section('title','Reseller')
@section('content')

<style>
    #cler {
        margin: 4px;
    }

    #add {
        margin: 2px;
    }
</style>

@if(!empty(Session::get('error_code3')) && Session::get('error_code3') == 3)
<script>
    $(document).ready(function () {
        $('#insertuserModal').modal('show');
    });
</script>
@elseif(!empty(Session::get('error_code2')) && Session::get('error_code2') == 2)
<script>
    $(document).ready(function () {
         $('#editModal{{ Session::get('us') }}').modal('show');
    });
</script>
@elseif(!empty(Session::get('error_code4')) && Session::get('error_code4') == 4)
<script>
    $(document).ready(function () {
         $('#addmoneyModal{{ Session::get('credit') }}').modal('show');
    });
</script>
@elseif(!empty(Session::get('error_code7')) && Session::get('error_code7') == 7)
<script>
    $(document).ready(function () {
          $('#changemoneyModal{{ Session::get('credit') }}').modal('show');
    });
</script>
@elseif(!empty(Session::get('alert')) && Session::get('alert') == 2)
<script>
    $(document).ready(function () {
          $('#alertModal').modal('show');
    });
</script>
@endif

<div class="row">
    <div class="col-md-12">
        <h3 class="title-5 m-b-35">RESELLER</h3>

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

            </div>
            <div class="table-data__tool-right">

                <button type="button" class="au-btn au-btn-icon au-btn--green au-btn--small ml-2" data-toggle="modal"
                    data-target="#insertuserModal" id="add">
                    <i class="zmdi zmdi-plus"></i>add reseller
                </button>

                <a class="btn btn-secondary" href="{{ route('exportresellertoexcel') }}" target="_blank">Export</a>

                {{-- ค้นหา --}}
                <div class="text-right mb-4 float-left" id="serch">
                    <form class="form-inline" action="{{ route('searchuseradmin') }}" method="GET">
                        <div class="form-group">
                            <input class="au-input au-input--s" type="text" name="name" id="name"
                                placeholder="Search name , email" />
                        </div>
                        <button class="btn btn-dark btn-s ml-2" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                {{-- ค้นหา --}}

                {{-- <div class="text-right mb-4 float-left" id="cler">
                    <form class="form-inline" action="{{ route('manageadminbyadmin') }}">
                <button class="btn btn-dark btn-s ml-1" type="submit" title="clear"><i class="fas fa-redo"></i></button>
                </form>
            </div> --}}
        </div>
    </div>
    <div class="table-responsive table-responsive-data2">
        <table class="table table-data2">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type User</th>
                    <th scope="col">before</th>
                    <th scope="col">current</th>
                    <th scope="col">after</th>
                    <th scope="col">Add Money</th>
                    <th scope="col">Change Money</th>
                    <th></th>
                </tr>
            </thead>

            @if (session('status2'))
            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">try agian</span>
                {{ session('status2') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <tbody>
                @if(count($user) == 0)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <br>
                        <br>
                        <p align="left">
                            <img src="{{ asset('images/icon/nodata.png') }}" alt="nodata" width="150" height="150" />
                        </p>
                        <br>
                        <br>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @else
                @foreach ($user as $users)
                <tr class="tr-shadow">
                    <td>{{ $users->id }}</td>
                    <td>{{ $users->name }} {{ $users->surname }} </td>
                    <td>{{ $users->typeUser }}</td>
                    <td>
                        <span class="block-email">{{ number_format($users->before , 2) }}</span>
                    </td>

                    @if ($users->typeCreate == "CHENGE")
                    <td>
                        <span class="block-email">
                            <font color="blue">- {{ number_format($users->current , 2) }}</font>
                        </span>
                    </td>
                    @elseif ($users->typeCreate == "ADD")
                    <td>
                        <span class="block-email">
                            <font color="green">+ {{ number_format($users->current , 2) }}</font>
                        </span>
                    </td>
                    @elseif ($users->typeCreate == null)
                    <td>
                        <span class="block-email">
                            {{ number_format($users->current , 2) }}
                        </span>
                    </td>
                    @endif

                    <td>
                        <span class="block-email">
                            {{ number_format($users->after , 2) }}
                        </span>
                    </td>
                    <td>
                        <button type="button" class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="modal"
                            data-target="#addmoneyModal{{ $users->credit_id }}">
                            <i class="zmdi zmdi-plus"></i>add money
                        </button>
                    </td>
                    <td>
                        <button type="button" class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="modal"
                            data-target="#changemoneyModal{{ $users->credit_id }}">
                            <i class="zmdi zmdi-minus"></i>change money
                        </button>
                    </td>
                    <td>
                        <div class="table-data-feature">
                            <button class="item" data-toggle="modal" id="confirm"
                                data-target="#editModal{{ $users->id }}" data-placement="top" type="button"
                                title="Edit">
                                <i class="zmdi zmdi-edit"></i>
                            </button>
                            @if (($users->before == 0 ) AND ($users->after == 0 ) AND ($users->current == 0 ))
                            <button class="item" data-toggle="modal" id="confirm"
                                data-target="#confirmModal{{ $users->id }}" data-placement="top" type="button"
                                title="Delete">
                                <i class="zmdi zmdi-delete"></i>
                            </button>
                            @endif &nbsp;
                            <a href="showdetailsuser/{{ $users->id }}" class="item" data-toggle="tooltip"
                                data-placement="top" title="More">
                                <i class="zmdi zmdi-more"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr class="spacer"></tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <br>
        {{ $user->appends(Request::except('page'))->links() }}
    </div>
</div>
</div>
@endsection

@section('modal')
{{-- model alert not changemoneyModal --}}
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel"> Alert </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p align="center">
                    ไม่สามารถเปลี่ยนแปลงเงินในบัญชีได้<br>
                    เนื่องจากยอดเงินในบัญชีน้อยกว่าจำนวณเงินที่ต้องการเปลี่ยนแปลง
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
{{-- model alert not changemoneyModal --}}

<!-- Add Money Modal -->
@foreach ($user as $users)
<div class="modal fade" id="addmoneyModal{{ $users->credit_id }}" tabindex="-1" role="dialog"
    aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Add Money</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updatemoneybyadmin' , $users->credit_id) }}" method="POST">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="form-group row">
                        <label for="credit_id"
                            class="col-md-4 col-form-label text-md-right">{{ __('Credit ID') }}</label>

                        <div class="col-md-6">
                            <input id="credit_id" type="text"
                                class="form-control @error('credit_id') is-invalid @enderror" name="credit_id"
                                value="{{ $users->credit_id}}" required autocomplete="credit_id" autofocus readonly>

                            @error('credit_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="current" class="col-md-4 col-form-label text-md-right">{{ __('Money') }}</label>

                        <div class="col-md-6">
                            <input id="current" type="int" class="form-control @error('current') is-invalid @enderror"
                                name="current" value="0" required autocomplete="current" autofocus>

                            @error('current')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- end modal static -->

<!-- changemoneyModal -->
@foreach ($user as $users)
<div class="modal fade" id="changemoneyModal{{ $users->credit_id }}" tabindex="-1" role="dialog"
    aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticModalLabel">Change Money K. {{ $users->name }} {{ $users->surname }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('savechangmoneybyadmin' , $users->credit_id) }}" method="POST">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="form-group row">
                        <label for="credit_id"
                            class="col-md-4 col-form-label text-md-right">{{ __('Credit ID') }}</label>

                        <div class="col-md-6">
                            <input id="credit_id" type="text"
                                class="form-control @error('credit_id') is-invalid @enderror" name="credit_id"
                                value="{{ $users->credit_id}}" required autocomplete="credit_id" autofocus readonly>

                            @error('credit_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="current" class="col-md-4 col-form-label text-md-right">{{ __('Money') }}</label>

                        <div class="col-md-6">
                            <input id="current" type="int" class="form-control @error('current') is-invalid @enderror"
                                name="current" value="0" required autocomplete="current" autofocus>

                            @error('current')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- end modal static -->

<!-- Delete Modal -->
@foreach ($user as $users)
<div class="modal fade" id="confirmModal{{ $users->id }}" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel"
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
                    ต้องการลบคุณ {{ $users->name }} {{ $users->surname }} ใช่หรือไม่ ?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form action="{{ route('deleteuserbyadmin' ,  $users->credit_id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="sunmit" class="btn btn-danger">Confirm</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endforeach
<!-- end modal static -->

<!-- modal insert User Modal -->
<div class="modal fade" id="insertuserModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">ADD USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('storeuserbyadmin') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                        <div class="col-md-6">
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                                name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                            @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Tel') }}</label>

                        <div class="col-md-6">
                            <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror"
                                name="tel" value="{{ old('tel') }}" required autocomplete="tel" autofocus>

                            @error('tel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="typeUser" class="col-md-4 col-form-label text-md-right">{{ __('TypeUser') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="typeUser" id="typeUser" type="typeUser"
                                class="form-control @error('typeUser') is-invalid @enderror" name="typeUser"
                                value="{{ old('typeUser') }}" required autocomplete="typeUser" autofocus>
                                <option value="RESELLER">RESELLER</option>
                                {{-- <option value="ADMIN">ADMIN</option> --}}
                            </select>

                            @error('typeUser')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end modal medium -->

<!-- modal Edit User Modal -->
@foreach ($user as $users)
<div class="modal fade" id="editModal{{ $users->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">EDIT USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateedituserbyadmin' , $users->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ $users->name}}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                        <div class="col-md-6">
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror"
                                name="surname" value="{{ $users->surname}}" required autocomplete="surname" autofocus>

                            @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Tel') }}</label>

                        <div class="col-md-6">
                            <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror"
                                name="tel" value="{{ $users->tel }}" required autocomplete="tel" autofocus>

                            @error('tel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $users->email }}" required autocomplete="email" readonly>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="typeUser" class="col-md-4 col-form-label text-md-right">{{ __('TypeUser') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="typeUser" id="typeUser" type="typeUser"
                                class="form-control @error('typeUser') is-invalid @enderror" name="typeUser"
                                value="{{ $users->typeUser}}" required autocomplete="typeUser" autofocus>
                                @if( $users->typeUser == "RESELLER")
                                <option value="RESELLER">RESELLER</option>
                                <option value="ADMIN">ADMIN</option>
                                @else
                                <option value="ADMIN">ADMIN</option>
                                <option value="RESELLER">RESELLER</option>
                                @endif
                            </select>

                            @error('typeUser')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                value="{{ $users->password }}" required autocomplete="new-password" readonly>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" value="{{ $users->password }}" required
                                autocomplete="new-password" readonly>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- end modal medium -->
@endsection
