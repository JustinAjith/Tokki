@extends('admin.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Categories</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Categories</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" ng-controller="categoryController">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal" ng-click="showMainCategories()">Categories</button>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal" ng-click="showSubCategories()">Sub Categories</button>
                        <hr>
                        <div class="row">
                            @foreach($categories as $category)
                                <div class="col-md-3 mb-2">
                                    <h3 class="mb-0"><small>{{ $category->name }}</small></h3>
                                    <ul>
                                        @foreach($category->subCategory as $sub)
                                            <li><small>{{ $sub->name }}</small></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>





                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div ng-show="mainCategories">
                                        <form ng-submit="addNewCategory()" id="addNewCategory">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Categories</label>
                                                    <input type="text" class="form-control" name="name" placeholder="enter categories">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div ng-show="subCategories">
                                        <form ng-submit="addNewSubCategory()" id="addNewSubCategory">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Categories</label>
                                                    <select class="form-control" name="category_id">
                                                        @foreach(categories() as $key=>$value)
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sub Categories</label>
                                                    <input type="text" class="form-control" name="name" placeholder="enter categories">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
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
        app.controller('categoryController', function($scope, $http){
            $scope.mainCategories = false;
            $scope.subCategories = false;
            $scope.showMainCategories = function() {
                $scope.mainCategories = true;
                $scope.subCategories = false;
            };
            $scope.showSubCategories = function() {
                $scope.mainCategories = false;
                $scope.subCategories = true;
            };

            $scope.addNewCategory = function()
            {
                $http({
                    method: 'POST',
                    url: '{{ route('admin.category.store') }}',
                    data: $('#addNewCategory').serialize(),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function(response){
                    swal("Success!", "Your action was successfully completed!", "success");
                    setTimeout(location.reload(), 300);
                },function(error) {
                    swal("Ooops!", "Please try again!", "error");
                });
            };

            $scope.addNewSubCategory = function()
            {
                $http({
                    method: 'POST',
                    url: '{{ route('admin.sub.category.store') }}',
                    data: $('#addNewSubCategory').serialize(),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function(response){
                    swal("Success!", "Your action was successfully completed!", "success");
                    setTimeout(location.reload(), 300);
                },function(error) {
                    swal("Ooops!", "Please try again!", "error");
                });
            };
        });
    </script>
@endsection