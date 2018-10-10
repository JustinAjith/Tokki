@extends('user.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/tokki/auth/datepicker.css') }}">
    <style>
        .datepicker-bottom-left, .datepicker-bottom-right {border-bottom-color: #ff970c;}
        .datepicker-bottom-left:before, .datepicker-bottom-right:before {border-top-color: #ff970c;}
        .datepicker-panel>ul>li.picked, .datepicker-panel>ul>li.picked:hover {color: #ff970c;}
        .datepicker-panel>ul>li.highlighted {background-color: #fff4de;}
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Buy Bid</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Buy Bid</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-title">
                        <h4>Buy Bid</h4>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form">
                            <form class="form-horizontal" method="POST" action="{{ route('user.bid.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group {{ $errors->has('bid') ? 'is-invalid' : '' }}">
                                    <label class="col-sm-12 control-label">Bid</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('bid') }}" name="bid" class="form-control" placeholder="enter bid">
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('receipt_id') ? 'is-invalid' : '' }}">
                                    <label class="col-sm-12 control-label">Receipt Number</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('receipt_id') }}" name="receipt_id" class="form-control" placeholder="enter receipt number">
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('amount') ? 'is-invalid' : '' }}">
                                    <label class="col-sm-12 control-label">Amount</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('amount') }}" name="amount" class="form-control" placeholder="enter payment amount">
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('receipt_file') ? 'is-invalid' : '' }}">
                                    <label class="col-sm-12 control-label">Receipt</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="receipt_file" class="form-control" placeholder="choose receipt">
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('date') ? 'is-invalid' : '' }}">
                                    <label class="col-sm-12 control-label">Payment date</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ old('date') }}" name="date" class="form-control appDatePicker" placeholder="enter payment date">
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

@section('script')
    <script type="text/javascript" src="{{ asset('js/tokki/auth/datepicker.js') }}"></script>
    <script>
        $('.appDatePicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection