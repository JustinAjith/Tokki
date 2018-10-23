@extends('user.layouts.master')
@section('style')
    <style>
        .user-profile-info .user-avatar{width: 100px;}
        .user-profile-info ul li {padding-bottom: 5px;}
    </style>
@endsection
@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Profile</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('home') }}">Users</a></li>
                <li class="breadcrumb-item active">{{ $user->name }}</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row user-profile-info">
                    <div class="col-md-4">
                        <div class="card user-profile-basic-info">
                            <div class="card-body">
                                <center>
                                    <a href="{{ route('user.upload.logo') }}"><img class="user-avatar" src="{{ asset('storage/user_profile') }}/{{ $user->profile }}" alt="User Logo"/></a>
                                </center>
                                <ul class="list-unstyled">
                                    <li>Code : {{ $user->code }}</li>
                                    <li>Name : {{ $user->name }}</li>
                                    <li>Email : {{ $user->email }}</li>
                                    <li>Address : {{ $user->address }}</li>
                                    <li>Mobile : {{ $user->mobile }}</li>
                                    <li>Land Line : {{ $user->land_line }}</li>
                                </ul>
                                <?php
                                $usedBid = $user->total_bid - $user->bid;
                                $availableBid = (100/$user->total_bid) * $usedBid;
                                ?>
                                <p class="m-t-20 f-w-600">Bid ({{ $usedBid }}/{{ $user->total_bid }}) <span class="pull-right">{{ round($availableBid, 2) }}%</span></p>
                                <div class="progress">
                                    <div role="progressbar" style="width: {{ $availableBid }}%; height:8px;" class="progress-bar bg-danger wow animated progress-animated"> <span class="sr-only">{{ $availableBid }}% Complete</span> </div>
                                </div>
                                <h5 class="mt-3"><small><a href="{{ route('user.change.password') }}"><i class="fa fa-pencil" aria-hidden="true"></i> Password Reset</a></small></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                @if(empty($user->about_us))
                                    <center>No data to show</center>
                                @else
                                    {!! $user->about_us !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var fixmeTop = $('.user-profile-basic-info').offset().top;
            $(window).scroll(function() {
                var currentScroll = $(window).scrollTop();
                if (currentScroll >= fixmeTop) {
                    $('.user-profile-basic-info').css({
                        position: 'fixed',
                        top: '10px',
                        width: '24%'
                    });
                } else {
                    $('.user-profile-basic-info').css({
                        position: 'static',
                        top: '0px',
                        width: '100%'
                    });
                }
            });
        });
    </script>
@endsection