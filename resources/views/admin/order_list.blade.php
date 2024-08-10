@foreach($orderData as $userOrders)
    <div class="user-orders">
            <h3>Name: {{ $userOrders->first()->name }}</h3>
            <p>Email: {{ $userOrders->first()->email }}</p>
            <p>Phone: {{ $userOrders->first()->phone }}</p>
            <p>Address: {{ $userOrders->first()->address }}</p>
            
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userOrders as $row)
                    <tr>
                        <?php $row->total_price = ($row->price * $row->total_quantity); ?>
                        <td>{{$row->foodname}}</td>
                        <td>{{$row->price}}</td>
                        <td>{{$row->total_quantity}}</td>
                        <td>{{$row->total_price}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<hr/>
@endforeach