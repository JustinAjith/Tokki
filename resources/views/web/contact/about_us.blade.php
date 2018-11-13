@extends('web.layouts.master')
@section('style')
    <style>
        .aboutUsBanner{width: 100%;}
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 p-0">
            <img src="{{ asset('images/general/about_us.png') }}" class="aboutUsBanner">
        </div>
    </div>
@endsection
@section('script')

@endsection