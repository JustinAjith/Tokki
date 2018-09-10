@extends('user.layouts.master')
@section('style')
    <style>
        .orderTableProductImage {width: 45%;}
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
                        <div class="table-responsive">
                            <table id="appDataTable" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/tokki/auth/datatables.js') }}"></script>
    <script>
        $('#appDataTable').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('user.order.all') }}",
                "dataType": "json",
                "type": "POST",
                "data": {_token: "{{csrf_token()}}"}
            },
            "columns": [
                {"data": "price"},
                {"data": "name"},
                {"data": "qty"},
                {"data": "date"},
                {"data": "status"},
                {"data": "action"}
            ]
        } );
    </script>
@endsection