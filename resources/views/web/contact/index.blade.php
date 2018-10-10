@extends('web.layouts.master')
@section('style')
    <style>
        .smallHeading small{font-size: 16px;font-weight: bold;color: #444;}
        input {border-radius: 0 !important;height: 34px !important;}
    </style>
@endsection
@section('content')
    <div class="container mt-4" ng-controller="controllerController" ng-cloak>
        <div class="row">
            <div class="col-md-8">
                <h5 class="smallHeading"><small>Contact us</small></h5>
                <form id="contactForm" ng-submit="contactFormSubmit()">
                    <div class="form-group row mb-2">
                        <label class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" placeholder="enter your name" ng-model="contact.name">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-8">
                            <input type="email" class="form-control" name="email" placeholder="enter your email" ng-model="contact.email">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="col-md-2 col-form-label">Message</label>
                        <div class="col-md-10">
                            <textarea rows="4" class="form-control" name="message" placeholder="enter your message" ng-model="contact.message"></textarea>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-sm tokkiAccessButton">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <span><small><i class="fa fa-map-marker"></i> Address</small></span>
                    </div>
                    <div class="col-md-8">
                        <span>
                            No 100, 4th Cross Street,<br>
                            Gurunagar,<br>
                            Jaffna,<br>
                            SriLanka.
                        </span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <span><small><i class="fa fa-phone"></i> Call us</small></span>
                    </div>
                    <div class="col-md-8">
                        <span>+94 77 593 2985</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <span><small><i class="fa fa-envelope-o"></i> Email</small></span>
                    </div>
                    <div class="col-md-8">
                        <span>justinajith94@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        app.controller('controllerController', function($scope, $http) {
            $scope.contactFormSubmit = function() {
                var routeUrl = "{{ route('web.contact.store') }}";
                $http({
                    method: 'POST',
                    url: routeUrl,
                    data: $('#contactForm').serialize(),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function(response){
                    $.jnoty("Your action was successfully completed!", {
                        header: 'Success',
                        theme: 'jnoty-success',
                        icon: 'fa fa-check-circle-o'
                    });
                    $scope.contact = '';
                },function(error){
                    $.jnoty("Please try again!", {
                        header: 'Error',
                        theme: 'jnoty-danger',
                        icon: 'fa fa-exclamation-circle'
                    });
                });
            }
        });
    </script>
@endsection