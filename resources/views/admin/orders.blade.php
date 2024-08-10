<x-app-layout>

</x-app-layout>

<!DOCTYPE html>
<html lang="en">

<head>
    @include("admin.admincss")
</head>

<body>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <u>
                                                <h4 class="card-title">Customer Orders</h4>
                                            </u>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <input type="text" class="form-control" id="searchInput" name="searchInput" Placeholder="Search Here">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="submit" class="btn btn-success search" value="Search">
                                        </div>
                                    </div>
                                    <div class="order_table"></div>
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
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        fetch_orders();

        $(document).on("click", ".search", function() {
            var searchInput=$('#searchInput').val();
            fetch_orders(searchInput);
        });
    });
    function fetch_orders(search){
         $.ajax({
            type: "post",
            url: "fetch_orders",
            data: {search:search},
            success: function(data) {
                $(".order_table").empty().html(data);
            },

            error: function(data) {
                console.log(data);
            },
        });
    }
</script>
</html>