<div class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Home</li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard </span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard </a></li>
                        <li><a href="#">Profile </a></li>
                    </ul>
                </li>


                <li class="nav-label">Apps</li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-shopping-bag"></i><span class="hide-menu">Products</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('admin.product') }}">Product List</a></li>
                        <li><a href="#">Categories</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-shopping-cart"></i><span class="hide-menu">Orders</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('admin.order') }}">Order List</a></li>
                        <li><a href="#">Order Status</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-users"></i><span class="hide-menu">User</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('admin.user.index') }}">Users</a></li>
                        <li><a href="{{ route('admin.user.create') }}">Add User</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-archive"></i><span class="hide-menu">Bid</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('admin.bid') }}">Bid List</a></li>
                        <li><a href="{{ route('admin.bid.rang') }}">Bid Rang</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-envelope"></i><span class="hide-menu">Email</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">Compose</a></li>
                        <li><a href="#">Read</a></li>
                        <li><a href="#">Inbox</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>