@extends('user.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Edit Profile</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-title">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form">
                            <form class="form-horizontal" method="POST" action="{{ route('user.edit.profile.submit') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Company Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="@if($errors->any()) {{ old('name') }}@else{{ Auth::user()->name }}@endif" class="form-control" placeholder="enter company name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Company Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="address" value="@if($errors->any()) {{ old('address') }}@else{{ Auth::user()->address }}@endif" class="form-control" placeholder="enter company address">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Mobile Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="mobile" value="@if($errors->any()) {{ old('mobile') }}@else{{ Auth::user()->mobile }}@endif" class="form-control" placeholder="enter mobile number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Land Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="land_line" value="@if($errors->any()) {{ old('land_line') }}@else{{ Auth::user()->land_line }}@endif" class="form-control" placeholder="enter land number">
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