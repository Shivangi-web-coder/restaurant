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
                                    <u>
                                        <h4 class="card-title">Add Food Menu</h4>
                                    </u>
                                    <form class="forms-sample" action="{{url('/uploadmenu')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="title" class="col-sm-3 col-form-label">Food Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="title" name="title" placeholder="Food Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="price" class="col-sm-3 col-form-label">Price</label>
                                            <div class="col-sm-9">
                                                <input type="num" class="form-control" id="price" name="price" placeholder="Price" required>
                                            </div>
                                        </div>
                                        <div class=" form-group row">
                                            <label for="image" class="col-sm-3 col-form-label">Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="image" class="form-control" id="image" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description" class="col-sm-3 col-form-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea type="text" class="form-control" name="description" id="description" required></textarea>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2">Save</button>
                                        <button class="btn btn-dark">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <u>
                                        <h4 class="card-title">List of Food Menu</h4>
                                    </u>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No.</th>
                                                    <th>Food Name</th>
                                                    <th>Price</th>
                                                    <th>Description</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $row)
                                                <tr>
                                                    <td>{{$row->id}}</td>
                                                    <td>{{$row->title}}</td>
                                                    <td>$ {{$row->price}}</td>
                                                    <td>{{$row->description}}</td>
                                                    <td><img src="/foodimage/{{$row->image}}" alt="{{$row->image}}" height="20px" width="20px"></td>
                                                    <td>
                                                        <a href="{{url('/editmenu',$row->id)}}"><i class="mdi mdi-table-edit"></i></a>
                                                        <a href="{{url('/deletemenu',$row->id)}}"><i class="mdi mdi-delete"></i></a>
                                                    </td>
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