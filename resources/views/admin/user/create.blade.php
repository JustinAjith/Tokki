@extends('admin.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Add User</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Add User</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-title">
                        <h4>Add User</h4>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form">
                            <form class="form-horizontal" method="POST" action="{{ route('admin.user.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Company Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="enter company name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="enter email address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" placeholder="enter password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Bid</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="bid" value="{{ old('bid') }}" class="form-control" placeholder="enter bid value">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-info btn-sm">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection