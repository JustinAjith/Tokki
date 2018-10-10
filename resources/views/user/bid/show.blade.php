@extends('user.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Bid Show</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('user.bid') }}">Bid</a></li>
                <li class="breadcrumb-item active">Bid Show</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mb-1">
                        <div class="float-left">Bid Show</div>
                        <div class="float-right">
                            <span class="@if($bid->status=='Accept') badge badge-success @elseif($bid->status=='Reject') badge badge-danger @elseif($bid->status=='Pending') badge badge-secondary @endif">{{ $bid->status }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                Bid<br>
                                <span class="text-muted">{{ $bid->bid }}</span>
                            </div>
                            <div class="col-md-3">
                                Receipt Id<br>
                                <span class="text-muted">{{ $bid->receipt_id }}</span>
                            </div>
                            <div class="col-md-3">
                                Amount<br>
                                <span class="text-muted">{{ $bid->amount }}</span>
                            </div>
                            <div class="col-md-3">
                                Date<br>
                                <span class="text-muted">{{ $bid->date }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('images/bid_receipt') }}/{{ $bid->receipt }}" alt="Receipt">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection