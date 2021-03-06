@extends('admin.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Dashboard</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('admin.dashboard._inc.recent_order')
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @include('admin.dashboard._inc.recent_bid')
            </div>
        </div>
    </div>
@endsection