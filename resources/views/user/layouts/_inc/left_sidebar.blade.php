<div class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Home</li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('home') }}">Dashboard </a></li>
                        <li><a href="{{ route('user.profile') }}">Profile </a></li>
                    </ul>
                </li>



                <li class="nav-label">Apps</li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-shopping-bag"></i><span class="hide-menu">Products</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('user.product') }}">Product List</a></li>
                        <li><a href="{{ route('user.product.create') }}">Add Product</a></li>
                        {{--<li><a href="#">Categories</a></li>--}}
                    </ul>
                </li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-shopping-cart"></i><span class="hide-menu">Orders</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('user.order') }}">Order List</a></li>
                        <li><a href="{{ route('user.awaiting.delivery.order') }}">Awaiting delivery</a></li>
                        <li><a href="{{ route('user.order.status') }}">Order Status</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-archive"></i><span class="hide-menu">Bid</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('user.bid') }}">Bid List</a></li>
                        <li><a href="{{ route('user.bid.create') }}">Buy Bid</a></li>
                        <li><a href="{{ route('user.bid.rang') }}">Bid Rang</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-money"></i><span class="hide-menu">Payment</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('user.payment.statement') }}">P/L Statement</a></li>
                        <li><a href="{{ route('user.payment.create') }}">Add Payment</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-envelope"></i><span class="hide-menu">Message</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('user.message.compose') }}">Compose</a></li>
                        <li><a href="{{ route('user.message.index') }}">Inbox</a></li>
                        <li><a href="{{ route('user.message.send') }}">Send</a></li>
                    </ul>
                </li>


                <li class="nav-label">Settings</li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Edit Settings</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('user.edit.profile') }}">Edit Profile</a></li>
                        <li><a href="{{ route('user.upload.logo') }}">Upload Logo</a></li>
                        <li><a href="{{ route('user.edit.about.us') }}">About Us</a></li>
                        <li><a href="{{ route('user.change.password') }}">Change Password</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>