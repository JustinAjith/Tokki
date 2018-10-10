@extends('user.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Order Status</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('user.order') }}">Order List</a></li>
                <li class="breadcrumb-item active">Order Status</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" ng-controller="orderStatsController">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-title">
                        <h4>Recent Orders </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Product</th>
                                    <th>quantity</th>
                                    <th>Bid</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td><a href="{{ route('user.order.show', $order->id) }}">{{ $order->name }}</a></td>
                                        <td><a href="{{ route('user.product.show', $order->product_id) }}">{{ $order->product->heading }}</a></td>
                                        <td><span>{{ $order->qty }} pcs</span></td>
                                        <td><span>{{ $order->bid_value }}</span></td>
                                        <td>
                                            <span class="float-right badge @if($order->status == 'Accept') badge-success @elseif($order->status == 'Complete') badge-primary @elseif($order->status == 'Pending') badge-warning @elseif($order->status == 'Reject') badge-danger @endif">{{ $order->status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                @if(count($recentOrders) == 0)
                                    <tr>
                                        <td colspan="5" style="background-color: rgba(0,0,0,.05);">No data available in table</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-title">
                        <h4>Bid Usage</h4>
                    </div>
                    <div class="flot-container">
                        <div id="bid-usage" class="flot-pie-container"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-title">
                        <h4>Recent Bids </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Receipt Id</th>
                                    <th>Amount</th>
                                    <th>Bid</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recentBids as $bid)
                                    <tr>
                                        <td>{{ $bid->receipt_id }}</td>
                                        <td><span>{{ $bid->amount }}</span></td>
                                        <td><span>{{ $bid->bid }}</span></td>
                                        <td>
                                            <span class="float-right badge @if($bid->status == 'Accept') badge-success @elseif($bid->status == 'Pending') badge-warning @elseif($bid->status == 'Reject') badge-danger @endif">{{ $bid->status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                @if(count($recentBids) == 0)
                                    <tr>
                                        <td colspan="4" style="background-color: rgba(0,0,0,.05);">No data available in table</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/tokki/chart/jquery.flot.js') }}"></script>
    <script src="{{ asset('js/tokki/chart/jquery.flot.pie.js') }}"></script>
    <script>
        app.controller('orderStatsController', function($scope, $http){
            var total = "{{ Auth::user()->total_bid }}";
            var bid = "{{ Auth::user()->bid }}";
            var value = Math.round((100/total)*bid);
            $( function () {
                var data = [
                    {
                        label: "Warning",
                        data: 100 - value,
                        color: "#DC3545"
                    },
                    {
                        label: "Primary",
                        data: value,
                        color: "#8fc9fb"
                    }
                ];

                var plotObj = $.plot( $( "#bid-usage" ), data, {
                    series: {
                        pie: {
                            show: true,
                            radius: 1,
                            label: {
                                show: false,

                            }
                        }
                    },
                    grid: {
                        hoverable: true
                    },
                    tooltip: {
                        show: true,
                        content: "%p.0%, %s",
                        shifts: {
                            x: 20,
                            y: 0
                        },
                        defaultTheme: false
                    }
                } );
            } );
        });
    </script>
    <script src="{{ asset('js/tokki/chart/flot-tooltip/jquery.flot.tooltip.min.js') }}"></script>
@endsection