@extends('user.layouts.master')
@section('title', 'Dashboard')
@section('style')
    <style>
        .messageTable{position: absolute;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;width: 52%;border-top: 0;}
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Dashboard</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" ng-controller="dashboardController">
        <div class="row">
            <div class="col-md-12">
                @include('user.dashboard._inc.recent_orders')
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
                @include('user.dashboard._inc.recent_bids')
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                @include('user.dashboard._inc.admin_message')
            </div>
            <div class="col-md-9">
                @include('user.dashboard._inc.recent_message')
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/tokki/chart/jquery.flot.js') }}"></script>
    <script src="{{ asset('js/tokki/chart/jquery.flot.pie.js') }}"></script>
    <script>
        app.controller('dashboardController', function($scope, $http){
            var total = "{{ Auth::user()->total_bid }}";
            var bid = "{{ Auth::user()->bid }}";
            var value = Math.round((100/total)*bid);
            $( function () {
                var data = [
                    {
                        label: "Used",
                        data: 100 - value,
                        color: "#DC3545"
                    },
                    {
                        label: "Remaining",
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

            var getMessage = "{{ route('user.get.dashboard.message') }}";
            $http.get(getMessage).then(function(response){
                $scope.messages = response.data.messages;
            });
        });
    </script>
    <script src="{{ asset('js/tokki/chart/flot-tooltip/jquery.flot.tooltip.min.js') }}"></script>
@endsection