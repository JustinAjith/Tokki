@extends('admin.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Bid List</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.bid') }}">Bid List</a></li>
                <li class="breadcrumb-item active">Show</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header mb-1">
                        <div class="float-left">{{ $userBid->user->name }}</div>
                        <div class="float-right" id="bidActions">
                            <button class="btn btn-sm btn-success" id="bidAccept">Accept</button>
                            <button class="btn btn-sm btn-danger" id="bidReject">Reject</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                User<br>
                                <span class="text-muted"><a href="{{ route('admin.user.show', $userBid->user->id) }}">{{ $userBid->user->name }}</a></span>
                            </div>
                            <div class="col-md-4">
                                Email<br>
                                <span class="text-muted">{{ $userBid->user->email }}</span>
                            </div>
                            <div class="col-md-4">
                                Status<br>
                                <span class="@if($userBid->status=='Accept') badge badge-success @elseif($userBid->status=='Reject') badge badge-danger @elseif($userBid->status=='Pending') badge badge-secondary @endif">{{ $userBid->status }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                Bid<br>
                                <span class="text-muted">{{ $userBid->bid }}</span>
                            </div>
                            <div class="col-md-4">
                                Receipt Id<br>
                                <span class="text-muted">{{ $userBid->receipt_id }}</span>
                            </div>
                            <div class="col-md-4">
                                Date<br>
                                <span class="text-muted">{{ $userBid->date }}</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('images/bid_receipt') }}/{{ $userBid->receipt }}" alt="Receipt">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin.bid._inc.script')
@endsection