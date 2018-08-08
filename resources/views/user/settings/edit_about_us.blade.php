@extends('user.layouts.master')
@section('style')
    <style>
        .ck-file-dialog-button {
            display: none;
        }
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Edit About us</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                <li class="breadcrumb-item active">Edit About us</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-title">
                        <h4>Edit About us</h4>
                    </div>
                    <div class="card-body">
                        <div class="horizontal-form">
                            <form class="form-horizontal" method="POST" action="{{ route('user.edit.about.us.submit') }}">
                                @csrf
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <textarea name="about_us" id="editor" rows="15">
                                            @if($errors->any())
                                                {{ old('about_us') }}
                                            @else
                                                {{ Auth::user()->about_us }}
                                            @endif
                                        </textarea>
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
    <script src="{{ asset('js/tokki/auth/editor.js') }}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
            console.error( error );
        });
    </script>
@endsection