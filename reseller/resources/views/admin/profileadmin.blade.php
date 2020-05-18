@extends('layouts.appAdmin')
@section('title','Profile Admin')
@section('content')
@if(!empty(Session::get('error_code5')) && Session::get('error_code5') == 5)
<script>
    $('#editprofilemeModal{{ Session::get('user') }}').modal('show');
</script>
@endif
<div class="row justify-content-center">
    <div class="col-md-7">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">Profile Admin</h3>
        @if (session('status'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
            <span class="badge badge-pill badge-success">Success</span>
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="au-card m-b-30">
            <div class="au-card-inner">
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <tbody>
                            <tr>
                                <td>User ID</td>
                                <td>{{ Auth::user()->id }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ Auth::user()->name }} {{ Auth::user()->surname }}</td>
                            </tr>
                            <tr>
                                <td>Tel</td>
                                <td>{{ Auth::user()->tel }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ Auth::user()->email }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ Auth::user()->typeUser }}</td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>{{ Auth::user()->password }}</td>
                            </tr>
                            <tr>
                                <td>Created at</td>
                                <td>{{ Auth::user()->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Updated at</td>
                                <td>{{ Auth::user()->updated_at }}</td>
                            </tr>
                            <tr></tr>
                        </tbody>
                    </table>
                    <br>
                    <center>
                        {{-- <a href="editprofileadmin/{{ Auth::user()->id }}"
                        class="au-btn au-btn-icon au-btn--blue au-btn--small">
                        <i class="fas fa-edit"></i>Edit
                        Profile
                        </a> --}}
                        <button class="au-btn au-btn-icon au-btn--blue au-btn--small" data-toggle="modal" id="confirm"
                            data-target="#editprofilemeModal{{ Auth::user()->id }}" data-placement="top" type="button"
                            title="Edit">
                            <i class="zmdi zmdi-edit"></i>Edit Profile
                        </button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- modal Edit User Modal -->
{{-- @foreach ($user as $users) --}}
<div class="modal fade" id="editprofilemeModal{{ Auth::user()->id }}" tabindex="-1" role="dialog"
    aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">EDIT ADMIN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateeditprofileadmin' , Auth::user()->id ) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

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
                                name="surname" value="{{ Auth::user()->surname }}" required autocomplete="surname"
                                autofocus>

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
                                name="tel" value="{{ Auth::user()->tel }}" required autocomplete="tel" autofocus>

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
                                name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

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
                                value="{{ Auth::user()->typeUser }}" required autocomplete="typeUser" autofocus>
                                @if( Auth::user()->typeUser == "RESELLER")
                                <option value="RESELLER">RESELLER</option>
                                {{-- <option value="ADMIN">ADMIN</option> --}}
                                @else
                                <option value="ADMIN">ADMIN</option>
                                {{-- <option value="RESELLER">RESELLER</option> --}}
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
                                value="{{ Auth::user()->password }}" required autocomplete="new-password">

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
                                name="password_confirmation" value="{{ Auth::user()->password }}" required
                                autocomplete="new-password">
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
{{-- @endforeach --}}
<!-- end modal medium -->
