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
                    <th>D.Status</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recentOrders as $order)
                    <tr>
                        <td><a href="{{ route('admin.order.show', $order->id) }}">{{ $order->name }}</a></td>
                        <td><a href="{{ route('admin.product.show', $order->product_id) }}" class="mail-desc">{{ $order->product->heading }}</a></td>
                        <td><span>{{ $order->qty }} pcs</span></td>
                        <td><span>{{ $order->bid_value }}</span></td>
                        <td><span class="{{ $order->delete_status == 0 ? 'text-success' : 'text-danger' }}">{{ $order->delete_status == 0 ? 'Active' : 'Deleted' }}</span></td>
                        <td>
                            <span class="float-right badge mt-2 @if($order->status == 'Accept') badge-success @elseif($order->status == 'Complete') badge-primary @elseif($order->status == 'Pending') badge-warning @elseif($order->status == 'Reject') badge-danger @endif">{{ $order->status }}</span>
                        </td>
                    </tr>
                @endforeach
                @if(count($recentOrders) == 0)
                    <tr>
                        <td colspan="6" style="background-color: rgba(0,0,0,.05);">No data available in table</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>