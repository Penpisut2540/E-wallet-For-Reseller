@extends('layouts.appAdmin')
@section('title','Admin TEAM')
@section('content')

<style>
    #cler {
        margin: 4px;
    }

    #add {
        margin: 2px;
    }
</style>

@if(!empty(Session::get('error_code')) && Session::get('error_code') == 1)
<script>
    $(document).ready(function () {
        $('#mediumModal').modal('show');
    });
</script>
@elseif(!empty(Session::get('error_code2')) && Session::get('error_code2') == 2)
<script>
    $(document).ready(function () {
         $('#editModal{{ Session::get('us') }}').modal('show');
    });
</script>
@endif

<div class="row">
    <div class="col-md-12">
        <h3 class="title-5 m-b-35">ADMIN TEAM</h3>

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
                    data-target="#mediumModal" id="add">
                    <i class="zmdi zmdi-plus"></i>add admin
                </button>

                {{-- ค้นหา --}}
                <div class="text-right mb-4 float-left" id="serch">
                    <form class="form-inline" action="{{ route('searchadminuseradmin') }}" method="GET">
                        <div class="form-group">
                            <input class="au-input au-input--s" type="text" name="name" id="name"
                                placeholder="Search name , email" />
                        </div>
                        <button class="btn btn-dark btn-s ml-2" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                {{-- ค้นหา --}}

            </div>
        </div>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tel</th>
                        <th scope="col">Type User</th>
                        <th scope="col">Created_at</th>
                        <th scope="col">Update_at</th>
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
                    @if(count($user) == 0)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <br>
                            <br>
                            <p align="center">
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
                    @foreach ($user as $users)
                    <tr class="tr-shadow">
                        {{-- @if ($users->typeUser == "ADMIN") --}}
                        <td>{{ $users->id }}</td>
                        <td>{{ $users->name }} {{ $users->surname }} </td>
                        <td>
                            <span class="block-email">{{ $users->email }}</span>
                        </td>
                        <td>{{ $users->tel }}</td>
                        <td>{{ $users->typeUser }}</td>
                        <td>{{ $users->created_at }}</td>
                        <td>{{ $users->updated_at }}</td>
                        <td>
                            <div class="table-data-feature">
                                <button class="item" data-toggle="modal" id="confirm"
                                    data-target="#editModal{{ $users->id }}" data-placement="top" type="button"
                                    title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </button>
                                <button class="item" data-toggle="modal" id="edit"
                                    data-target="#confirmModal{{ $users->id }}" data-placement="top" type="button"
                                    title="Delete">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                                <button class="item" data-toggle="modal" id="show"
                                    data-target="#showprofileModal{{ $users->id }}" data-placement="top" type="button"
                                    title="More">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </div>
                        </td>
                        {{-- @endif --}}
                    </tr>
                    <tr class="spacer"></tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <br>
            {{-- {{ $user->links() }} --}}
        </div>
    </div>
</div>
@endsection


@section('modal')
<!-- modal Delete -->
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
                <form action="{{ route('deleteadminbyadmin' ,  $users->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="sunmit" class="btn btn-danger">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- modal Delete -->

<!-- modal insert Admin Modal -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">ADD ADMIN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('storeadminbyadmin') }}">
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
                                <option value="ADMIN">ADMIN</option>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal medium -->

<!-- modal Edit Admin Modal -->
@foreach ($user as $users)
<div class="modal fade" id="editModal{{ $users->id }}" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">EDIT ADMIN</h5>
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

                    @if ($users->email != Auth::user()->email)
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
                    @else
                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ $users->email }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @endif

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

                    @if ($users->email != Auth::user()->email)
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
                    @else
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                value="{{ $users->password }}" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    @endif

                    @if ($users->email != Auth::user()->email)
                    <div class="form-group row">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" value="{{ $users->password }}" required
                                autocomplete="new-password" readonly>
                        </div>
                    </div>
                    @else
                    <div class="form-group row">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" value="{{ $users->password }}" required
                                autocomplete="new-password">
                        </div>
                    </div>
                    @endif

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

<!-- modal ShowProfile Admin Modal -->
@foreach ($user as $users)
<div class="modal fade" id="showprofileModal{{ $users->id }}" tabindex="-1" role="dialog"
    aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-body">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="title-5 m-b-35">Profile</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <tbody>
                                <tr>
                                    <td>User ID</td>
                                    <td>{{ $users->id }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $users->name }} {{ $users->surname }}</td>
                                </tr>
                                <tr>
                                    <td>Tel</td>
                                    <td>{{ $users->tel }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $users->email }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>{{ $users->typeUser }}</td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>{{ $users->password }}</td>
                                </tr>
                                <tr>
                                    <td>Created at</td>
                                    <td>{{ $users->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated at</td>
                                    <td>{{ $users->updated_at }}</td>
                                </tr>
                                <tr></tr>
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- end modal medium -->
@endsection
