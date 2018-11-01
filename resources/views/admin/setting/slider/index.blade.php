@extends('admin.layouts.master')
@section('style')
    <style>
        .tokkiHomeSliderImage {width: 100%;}
        .removeSlider {position: absolute;right: 10px;top: -8px;font-size: 18px;color: #f76565;border: 1px solid;border-radius: 50%;cursor: pointer;}
        .switch {position: relative;display: inline-block;width: 60px;height: 34px;float:right;}
        .switch input {display:none;}
        .slider {position: absolute;cursor: pointer;top: 0; left: 0;right: 0;bottom: 0;background-color: #ccc;-webkit-transition: .4s; transition: .4s;}
        .slider:before {position: absolute;content: "";height: 26px;width: 26px;left: 4px;bottom: 4px;background-color: white;-webkit-transition: .4s;transition: .4s;}
        input.default:checked + .slider {background-color: #ff970c;}
        input:focus + .slider {box-shadow: 0 0 1px #2196F3;}
        input:checked + .slider:before {-webkit-transform: translateX(26px);-ms-transform: translateX(26px);transform: translateX(26px);}
        .slider.round {border-radius: 34px;}
        .slider.round:before {border-radius: 50%;}
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Top Slider</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Top Slider</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        @csrf
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Select Image</label>
                                                <input type="file" class="form-control" name="image">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" name="title" placeholder="enter image title">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Text</label>
                                                <input type="text" class="form-control" name="text" placeholder="enter image text">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <button class="btn btn-sm btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach($sliders as $slider)
                                        <div class="col-md-4 mb-3">
                                            <div class="float-right">
                                                <span class="fa fa-times removeSlider" data-id="{{ $slider->id }}"></span>
                                            </div>
                                            <img src="{{ asset('images/slider') }}/{{ $slider->image }}" class="tokkiHomeSliderImage">
                                            <center>
                                                <h4 class="mb-0"><small>{{ $slider->title ? $slider->title : '-' }}</small></h4>
                                                <h5><small>{{ $slider->text ? $slider->text : '-' }}</small></h5>
                                            </center>
                                            <label class="switch">
                                                <input type="checkbox" class="default sliderCheckbox" @if($slider->status == 'yes') checked @endif value="{{ $slider->id }}">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.removeSlider', function(){
                var id = $(this).attr('data-id');
                var routeUrl  = '{{ route('admin.slider.delete', [ 'slider'=>'ID']) }}';
                routeUrl = routeUrl.replace('ID', id);
                var removeSlider = $(this).closest('.col-md-4');
                $.ajax({
                    method: 'POST',
                    url: routeUrl,
                    data : {'_token' : '{{ csrf_token() }}'},
                    success: function(result) {
                        removeSlider.remove();
                    }
                });
            });
            $(document).on('click', '.sliderCheckbox', function(){
                var id = $(this).val();
                var routeUrl  = '{{ route('admin.slider.status', [ 'slider'=>'ID']) }}';
                routeUrl = routeUrl.replace('ID', id);
                $.ajax({
                    method: 'POST',
                    url: routeUrl,
                    data : {'_token' : '{{ csrf_token() }}'},
                    success: function(result) {
                        removeSlider.remove();
                    }
                });
            });
        });
    </script>
@endsection