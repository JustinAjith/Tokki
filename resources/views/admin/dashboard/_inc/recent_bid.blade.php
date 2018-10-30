<div class="card">
    <div class="card-title">
        <h4>Recent Bids </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Receipt Id</th>
                    <th>Amount</th>
                    <th>Bid</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($recentBids as $bid)
                    <tr>
                        <td>{{ $bid->receipt_id }}</td>
                        <td><span>{{ $bid->amount }}</span></td>
                        <td><span>{{ $bid->bid }}</span></td>
                        <td>
                            <span class="float-right badge @if($bid->status == 'Accept') badge-success @elseif($bid->status == 'Pending') badge-warning @elseif($bid->status == 'Reject') badge-danger @endif">{{ $bid->status }}</span>
                        </td>
                    </tr>
                @endforeach
                @if(count($recentBids) == 0)
                    <tr>
                        <td colspan="4" style="background-color: rgba(0,0,0,.05);">No data available in table</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>