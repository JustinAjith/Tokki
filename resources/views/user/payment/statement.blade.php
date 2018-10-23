@extends('user.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/tokki/auth/datepicker.css') }}">
    <style>
        .datepicker-bottom-left, .datepicker-bottom-right {border-bottom-color: #ff970c;}
        .datepicker-bottom-left:before, .datepicker-bottom-right:before {border-top-color: #ff970c;}
        .datepicker-panel>ul>li.picked, .datepicker-panel>ul>li.picked:hover {color: #ff970c;}
        .datepicker-panel>ul>li.highlighted {background-color: #fff4de;}
        .datepicker-top-left, .datepicker-top-right {border-top-color: #ff970c;}
        .datepicker-top-left:before, .datepicker-top-right:before {border-bottom-color: #ff970c;}
        .borderless td , .borderless th{border: none;}
        .report-table-header td, .report-bold {font-weight: bold;}
        .report-table-body td {padding: 0.3rem 0.75rem;}
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">P/L Statement</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">P/L Statement</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" ng-controller="paymentStatementController">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="paymentDateRang" ng-submit="paymentStatement()">
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <input type="text" class="form-control appDatePicker" name="start" placeholder="enter start date" autocomplete="off">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control appDatePicker" name="end" placeholder="enter end date" autocomplete="off">
                                </div>
                                <div class="col-md-1 mt-1">
                                    <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        <hr>

                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table borderless">
                                    <tbody>
                                    <tr class="report-table-header">
                                        <td>Particulars</td>
                                        <td class="float-right">Amount(Rs)</td>
                                    </tr>
                                    <tr class="report-table-body" ng-repeat="incomePayment in incomePayments">
                                        <td>@{{ incomePayment.description }}</td>
                                        <td class="float-right">@{{ incomePayment.income | number : 2 }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-sm-6">
                                <table class="table borderless">
                                    <tbody>
                                    <tr class="report-table-header">
                                        <td>Particulars</td>
                                        <td class="float-right">Amount(Rs)</td>
                                    </tr>
                                    <tr class="report-table-body" ng-repeat="outgoingPayment in outgoingPayments">
                                        <td>@{{ outgoingPayment.description }}</td>
                                        <td class="float-right">@{{ outgoingPayment.outgoing | number : 2 }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table borderless">
                                    <tbody>
                                    <tr class="report-table-body">
                                        <td class="report-bold">To Balance B/d</td>
                                        <td class="float-right">@{{ lost | number : 2 }}</td>
                                    </tr>
                                    <tr class="report-table-body">
                                        <td>Total</td>
                                        <td class="float-right" style="border-top: 1px solid #333;border-bottom: 1px solid #333;">@{{ balance | number : 2 }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table class="table borderless">
                                    <tbody>
                                    <tr class="report-table-body">
                                        <td class="report-bold">Balance C/d</td>
                                        <td class="float-right">@{{ profit | number : 2 }}</td>
                                    </tr>
                                    <tr class="report-table-body">
                                        <td>Total</td>
                                        <td class="float-right" style="border-top: 1px solid #333;border-bottom: 1px solid #333;">@{{ balance | number : 2 }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('js/tokki/auth/datepicker.js') }}"></script>
    <script>
        $('.appDatePicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
    <script>
        app.controller('paymentStatementController', function($scope, $http){
            $scope.balance = 0.00;
            $scope.profit = 0.00;
            $scope.lost = 0.00;
            $scope.paymentStatement = function()
            {
                var routeUrl = "{{ route('user.payment.statement.result') }}";
                $scope.incomePayments = [];
                $scope.outgoingPayments = [];
                $scope.totalIncome = 0.00;
                $scope.totalOurgoing = 0.00;
                $scope.balance = 0.00;
                $scope.profit = 0.00;
                $scope.lost = 0.00;
                $http({
                    method: 'POST',
                    url: routeUrl,
                    data: $('#paymentDateRang').serialize(),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function(response){
                    $scope.payments = response.data;
                    for(var i=0; i < $scope.payments.length; i++)
                    {
                        if(response.data[i].income !== null){
                            $scope.incomePayments.push(response.data[i]);
                            $scope.totalIncome = parseInt($scope.totalIncome) + parseInt(response.data[i].income);
                        }
                        if(response.data[i].outgoing !== null){
                            $scope.outgoingPayments.push(response.data[i]);
                            $scope.totalOurgoing = parseInt($scope.totalOurgoing) + parseInt(response.data[i].outgoing);
                        }
                    }
                    if($scope.totalIncome > $scope.totalOurgoing) {
                        $scope.profit = parseInt($scope.totalIncome) - parseInt($scope.totalOurgoing);
                        $scope.balance = $scope.totalIncome;
                    }
                    if($scope.totalOurgoing > $scope.totalIncome) {
                        $scope.lost = parseInt($scope.totalOurgoing) - parseInt($scope.totalIncome);
                        $scope.balance = $scope.totalOurgoing;
                    }
                },function(error) {

                });
            }
        });
    </script>
@endsection