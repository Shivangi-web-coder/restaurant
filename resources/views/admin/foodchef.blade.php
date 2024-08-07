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
                                        <h4 class="card-title">Add Food Chef</h4>
                                    </u>
                                    <form class="forms-sample" action="{{url('/uploadchef')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Chef Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Chef Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="speciality" class="col-sm-3 col-form-label">Speciality</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="speciality" name="speciality" placeholder="Speciality" required>
                                            </div>
                                        </div>
                                        <div class=" form-group row">
                                            <label for="image" class="col-sm-3 col-form-label">Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="image" class="form-control" id="image" required>
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
                                        <h4 class="card-title">List of Food Chefs</h4>
                                    </u>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No.</th>
                                                    <th>Chef Name</th>
                                                    <th>Speciality</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $row)
                                                <tr>
                                                    <td>{{$row->id}}</td>
                                                    <td>{{$row->name}}</td>
                                                    <td>{{$row->speciality}}</td>
                                                    <td><img src="/chefimage/{{$row->image}}" alt="{{$row->image}}" height="20px" width="20px"></td>
                                                    <td>
                                                        <a href="{{url('/editchef',$row->id)}}"><i class="mdi mdi-table-edit"></i></a>
                                                        <a href="{{url('/deletechef',$row->id)}}"><i class="mdi mdi-delete"></i></a>
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