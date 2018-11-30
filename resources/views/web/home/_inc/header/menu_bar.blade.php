<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="main">
                <nav class="cbp-hsmenu-wrapper" id="cbp-hsmenu-wrapper">
                    <div class="cbp-hsinner">
                        <ul class="cbp-hsmenu">
                            {{--<li>--}}
                                {{--<a href="#">Categories</a>--}}
                                {{--<ul class="cbp-hssubmenu">--}}
                                    {{--@foreach($categories as $category)--}}
                                        {{--<li>--}}
                                            {{--<h5><small>{{ $category->name }}</small></h5>--}}
                                            {{--<hr>--}}
                                            {{--<ul class="mb-2 productCategoryItems">--}}
                                                {{--@foreach($category->subCategory as $sub)--}}
                                                    {{--<li><small><a href="{{ route('web.category.product', $sub->ref_id) }}">{{ $sub->name }}</a></small></li>--}}
                                                {{--@endforeach--}}
                                            {{--</ul>--}}
                                        {{--</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            <li>
                                <a href="{{ route('web.categories') }}">Categories</a>
                            </li>
                            <li>
                                <a href="{{ route('web.best.sell') }}">Best Sell</a>
                            </li>
                            <li>
                                <a href="{{ route('web.popular.categories') }}">Popular Categories</a>
                            </li>
                            <li>
                                <a href="{{ route('web.special.offers') }}">Special Offers</a>
                            </li>
                            <li>
                                <a href="{{ route('web.contact.us') }}">Contact Us</a>
                            </li>
                            <li>
                                <a href="{{ route('web.about.us') }}">About Us</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>