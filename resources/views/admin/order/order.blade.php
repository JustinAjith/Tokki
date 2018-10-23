@extends('admin.layouts.master')
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Product Orders</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.product') }}">Product List</a></li>
                <li class="breadcrumb-item active">Product Orders</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="appDataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Mobile</th>
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
                "url": "{{ route('admin.product.order.all', $product) }}",
                "dataType": "json",
                "type": "POST",
                "data": {_token: "{{csrf_token()}}"}
            },
            "columns": [
                {"data": "name"},
                {"data": "street"},
                {"data": "city"},
                {"data": "mobile"},
                {"data": "date"},
                {"data": "status"},
                {"data": "action", "orderable": false}
            ]
        } );
    </script>
@endsection