<x-app-layout>

</x-app-layout>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
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
                                        <h4 class="card-title">Update Food Chef</h4>
                                    </u>
                                    <form class="forms-sample" action="{{url('/updatechef')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-3 col-form-label">Chef Name</label>
                                            <div class="col-sm-9">
                                                <input type="hidden" id="id" name="id" value="{{$data->id}}">
                                                <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="speciality" class="col-sm-3 col-form-label">Speciality</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="speciality" name="speciality" value="{{$data->speciality}}" required>
                                            </div>
                                        </div>
                                        <div class=" form-group row">
                                            <label for="image" class="col-sm-3 col-form-label">Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="image" class="form-control" id="image">
                                                Old Image : <img src="{{ asset('chefimage/' . $data->image) }}" alt="" width="100" height="100">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2">Update</button>
                                        <button class="btn btn-dark">Cancel</button>
                                    </form>
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