@extends('user.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Dashboard</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-two">
                            <header>
                                <div class="avatar">
                                    <img src="{{ asset('storage/user_profile') }}/{{ Auth::user()->profile }}" alt="Company Logo" />
                                </div>
                            </header>

                            <h3>{{ Auth::user()->name }}</h3>
                            <div class="desc">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit et cupiditate deleniti.
                            </div>
                            <div class="contacts">
                                <a href=""><i class="fa fa-plus"></i></a>
                                <a href=""><i class="fa fa-whatsapp"></i></a>
                                <a href=""><i class="fa fa-envelope"></i></a>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection