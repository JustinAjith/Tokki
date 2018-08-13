@extends('user.layouts.master')
@section('style')
    <style>
        .productListImage {width: 65%;height: 65%;}
        .productListCard:hover{box-shadow: 0px 5px 25px rgba(0,0,0,0.1);z-index: 10;}
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Product List</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Product List</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach($products as $product)
                                <?php $image = json_decode($product->image); ?>
                                <div class="col-3 mb-3">
                                    <div class="productListCard p-3">
                                        <div class="row justify-content-center">
                                            <img src="{{ asset('storage/product') }}/{{ array_get($image, 0) }}" class="productListImage">
                                        </div>
                                        <div class="row justify-content-center mt-2 mb-2">
                                            <small>{{ $product->status }}</small>
                                        </div>
                                        <div class="row justify-content-center">
                                            <a href="{{ route('user.product.show', $product->id) }}" class="btn btn-sm btn-primary">Show</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="float-right">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection