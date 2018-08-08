@extends('user.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Change Password</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                <li class="breadcrumb-item active">Change Password</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-title">
                        <h4>Password Rest</h4>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form">
                            <form class="form-horizontal" method="POST" action="{{ route('user.change.password.submit') }}">
                                @csrf
                                <div class="form-group {{ $errors->has('current_password') ? 'is-invalid' : '' }}">
                                    <label class="col-sm-12 control-label">Current Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="current_password" class="form-control" placeholder="current password">
                                    </div>
                                    @if(session()->has('error'))
                                        <div class="col-sm-10 error_response">
                                            {{ session()->get('error') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('password') ? 'is-invalid' : '' }}">
                                    <label class="col-sm-12 control-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" placeholder="new password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Re-type Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="re-type password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-success btn-sm">Submit</button>
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