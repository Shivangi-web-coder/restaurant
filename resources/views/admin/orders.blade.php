<x-app-layout>

</x-app-layout>

<!DOCTYPE html>
<html lang="en">

<head>
    @include("admin.admincss")
</head>

<body>
    <div class="container-scroller">
        @include("admin.sidebar")
        <div class="container-fluid page-body-wrapper">
            @include("admin.navbar")
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">

                                    <form action="{{url('/search')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <u>
                                                    <h4 class="card-title">Customer Orders</h4>
                                                </u>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <input type="text" class="form-control" name="search" Placeholder="Search Here">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="submit" class="btn btn-success" value="Search">
                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone No</th>
                                                    <th>Address</th>
                                                    <th>Food Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Total Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orderData as $row)
                                                <tr>
                                                    <?php $row->total_price = ($row->price * $row->total_quantity); ?>
                                                    <td>{{$row->name}}</td>
                                                    <td>{{$row->email}}</td>
                                                    <td>{{$row->phone}}</td>
                                                    <td>{{$row->address}}</td>
                                                    <td>{{$row->foodname}}</td>
                                                    <td>{{$row->price}}</td>
                                                    <td>{{$row->total_quantity}}</td>
                                                    <td>{{$row->total_price}}</td>
                                                    <td></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("admin.adminscript")
</body>

</html>