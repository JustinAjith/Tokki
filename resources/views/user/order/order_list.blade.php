@extends('user.layouts.master')
@section('style')
    <style>
        .orderListImage{width: 70px;}
        #appDataTable tbody tr td{line-height: 70px;}
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Order List &nbsp;
                <a href="{{ route('user.order') }}" style="font-size: 18px;"><i class="fa fa-th-large"></i></a>&nbsp;
                <a href="{{ route('user.order.list') }}" style="font-size: 18px;color: #007bff;"><i class="fa fa-list-ul"></i></a>
            </h3>
        </div>
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
                            <table id="appDataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Date</th>
                                    <th>Qty</th>
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
                "url": "{{ route('user.order.list.table') }}",
                "dataType": "json",
                "type": "POST",
                "data": {_token: "{{csrf_token()}}"}
            },
            "columns": [
                {"data": "name", "orderable": false, "searchable": false},
                {"data": "date", "order": "desc"},
                {"data": "qty"},
                {"data": "status"},
                {"data": "action", "orderable": false}
            ],
        } );
    </script>
@endsection