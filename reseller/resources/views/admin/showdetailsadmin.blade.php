@extends('layouts.appAdmin')
@section('title','Show Detail Admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <!-- DATA TABLE -->
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
                <h3 class="title-5 m-b-35">Show Detail Admin</h3>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <tbody>
                            @foreach ($user as $u)

                            @endforeach
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
<div class="container">

</div>
@endsection
