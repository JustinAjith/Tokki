@extends('web.layouts.master')
@section('style')
    <style>
        .smallHeading small {font-size: 15px;font-weight: bold;color: #444;}
        .productCategoryItems small a{text-decoration: none;color: #444;}
        .productCategoryItems small a:hover{color: #ff970c;}
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row mt-3">
            @foreach($categories as $category)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                    <h5 class="smallHeading"><small>{{ $category->name }}</small></h5>
                    <ul class="mb-2 productCategoryItems">
                        @foreach($category->subCategory as $sub)
                            <li><small><a href="{{ route('web.category.product', $sub->ref_id) }}">{{ $sub->name }}</a></small></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@endsection