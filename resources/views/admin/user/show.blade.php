@extends('admin.layouts.master')
@section('style')
    <style>
        .user-profile-info .user-avatar{
            width: 100px;
        }
        .user-profile-info ul li {
            padding-bottom: 5px;
        }
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">User</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.user.index') }}">Users</a></li>
                <li class="breadcrumb-item active">{{ $user->name }}</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" ng-controller="userController">
        <div class="row">
            <div class="col-12">
                <div class="row user-profile-info">
                    <div class="col-md-4">
                        <div class="card user-profile-basic-info">
                            <div class="card-body">
                                <center>
                                    <img class="user-avatar" src="{{ asset('storage/user_profile') }}/{{ $user->profile }}" alt="Company Logo"/>
                                </center>
                                <ul class="list-unstyled">
                                    <li>Code : {{ $user->code }}</li>
                                    <li>Name : {{ $user->name }}</li>
                                    <li>Email : {{ $user->email }}</li>
                                    <li>Address : {{ $user->address }}</li>
                                    <li>Mobile : {{ $user->mobile }}</li>
                                    <li>Land Line : {{ $user->land_line }}</li>
                                </ul>
                                <?php $availableBid = (100/$user->total_bid) * $user->bid; ?>
                                <p class="m-t-20 f-w-600">Bid ({{ $user->bid }}/{{ $user->total_bid }}) &nbsp; <a href=""><i class="fa fa-pencil" aria-hidden="true"></i></a> <span class="pull-right">{{ $availableBid }}%</span></p>
                                <div class="progress">
                                    <div role="progressbar" style="width: {{ $availableBid }}%; height:8px;" class="progress-bar bg-success wow animated progress-animated"> <span class="sr-only">{{ $availableBid }}% Complete</span> </div>
                                </div>
                                <h5 class="mt-3"><small><a href="" ng-click="showPasswordForm()"><i class="fa fa-pencil" aria-hidden="true"></i> Password Reset</a></small></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div ng-show="aboutCompany">
                                    @if(empty($user->about_us))
                                        <center>No data to show</center>
                                    @else
                                        {!! $user->about_us !!}
                                    @endif
                                </div>
                                <div ng-show="userPasswordReset">
                                    @include('admin.user._inc.user_password_reset')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin.user._inc.script')
@endsection