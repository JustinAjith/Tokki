@extends('web.layouts.master')
@section('style')
    <style>
        .successIcon {font-size: 250px;color: #6db25e;}
    </style>
@endsection
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12 text-center">
                <span class="fa fa-smile-o successIcon" aria-hidden="true"></span>
                <h1><b>Thank you.</b></h1>
                <h2><small>Your order was completed successfully.</small></h2>
            </div>
        </div>
    </div>
@endsection