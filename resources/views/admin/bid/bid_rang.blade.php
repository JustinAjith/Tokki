@extends('admin.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Bid Rang <small><a href="{{ route('admin.bid.rang.create') }}" class="btn btn-sm btn-primary">Create</a></small></h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Bid Rang</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body"> This is some text within a card block. </div>
                </div>
            </div>
        </div>
    </div>
@endsection