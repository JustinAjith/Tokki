<h3>Select your product category</h3>
<hr>
<div class="row">
    @foreach($categories as $category)
        <div class="col-md-3 mb-2">
            <h3 class="mb-0"><small>{{ $category->name }}</small></h3>
            <ul>
                @foreach($category->subCategory as $sub)
                    <li class="selectCategoryItems"><small ng-click="selectCategory({{$category}}, {{ $sub }})">{{ $sub->name }}</small></li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>