<div class="col-md-3">
    <div class="card p-30">
        <div class="media">
            <div class="media-left meida media-middle">
                <span><i class="fa fa-usd f-s-40 color-primary"></i></span>
            </div>
            <div class="media-body media-text-right">
                <h2>@{{ salesRevenue }}</h2>
                <p class="m-b-0">Sales Revenue</p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card p-30">
        <div class="media">
            <div class="media-left meida media-middle">
                <span><i class="fa fa-shopping-cart f-s-40 color-success"></i></span>
            </div>
            <div class="media-body media-text-right">
                <h2>@{{ totalSales }}</h2>
                <p class="m-b-0">Sales</p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card p-30">
        <div class="media">
            <div class="media-left meida media-middle">
                <span><i class="fa fa-archive f-s-40 color-warning"></i></span>
            </div>
            <div class="media-body media-text-right">
                <h2>{{ Auth::user()->bid }}</h2>
                <p class="m-b-0">Bid</p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="card p-30">
        <div class="media">
            <div class="media-left meida media-middle">
                <span><i class="fa fa-shopping-bag f-s-40 color-danger"></i></span>
            </div>
            <div class="media-body media-text-right">
                <h2>@{{ totalProducts }}</h2>
                <p class="m-b-0">Products</p>
            </div>
        </div>
    </div>
</div>