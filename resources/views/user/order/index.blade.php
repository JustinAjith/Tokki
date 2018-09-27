@extends('user.layouts.master')
@section('style')
    <style>
        .productListImage {width: 100%;height: 100%;}
        .productListCard:hover{box-shadow: 0px 5px 25px rgba(0,0,0,0.1);z-index: 10;}
        .productListHeading {font-size: 14px;display: block;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Order List</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Order List</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach($orders as $order)
                                <div class="col-3 mb-3">
                                    <a href="{{ route('user.order.show', $order->id) }}">
                                        <div class="productListCard p-3">
                                            <div class="row justify-content-center" style="padding: 0 20px;">
                                                <img src="{{ asset('storage/display_image') }}/{{ $order->product->display_image }}" class="productListImage">
                                            </div>
                                            <div class="row justify-content-center">
                                                <span><small>{{ $order->qty }} Pieces</small></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="productListHeading">{{ $order->product->heading }}</span>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center mb-2">
                                                <small class="float-right badge @if($order->status == 'Accept') badge-success @elseif($order->status == 'Complete') badge-primary @elseif($order->status == 'Pending') badge-warning @elseif($order->status == 'Reject') badge-danger @endif">{{ $order->status }}</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="float-right">
                                    {{ $orders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection