<div class="card">
    <div class="card-title">
        <h4>Recent Messages </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>From</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="message in messages">
                    <td>Tokki</td>
                    <td class="messageTable"><span>@{{ message.message }}</span></td>
                    <td><span>@{{ message.created_at }}</span></td>
                </tr>
                <tr ng-if="messages.length === 0">
                    <td colspan="3" style="background-color: rgba(0,0,0,.05);">No message to show</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>