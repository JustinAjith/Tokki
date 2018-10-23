@extends('user.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Bid Rang</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Bid Rang</li>
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
                                    <th>Rang <small>(Rs)</small></th>
                                    <th>Bid</th>
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
                "url": "{{ route('user.bid.rang.data') }}",
                "dataType": "json",
                "type": "POST",
                "data": {_token: "{{csrf_token()}}"}
            },
            "columns": [
                {"data": "rang"},
                {"data": "bid"}
            ]
        } );
    </script>
@endsection