@extends('layout.pelangganLayout')
@section('container')

<div class="container pt-5">
    <div class="col pt-5">
        <form class="d-flex">
          <input class="form-control me-2" oninput="search()" type="text" id="search" placeholder="Search Menu" aria-label="Search">
        </form>
    </div>
    <div class="pt-4">
        <div class="header">
            <h4>
                Menu
            </h4>
        </div>
    <div id="read" class="mt-3"></div>
    </div>
</div>
</div>
    <script>
        $(document).ready(function() {
            read();

            $("#search").on("input", function() {
                search();
            });
        });

        function read() {
            $.get("{{ route('read') }}", {}, function(data, status) {
                $("#read").html(data);
            });
        }

        function show(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('customer/cart') }}/" + id,
                method: "GET", // Ubah metode HTTP menjadi POST
                data: {},
                success: function(data, status) {
                    $("#staticBackdropLabel").html("Add Cart");
                    $("#page").html(data);
                    $("#staticBackdrop").modal("show");
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }


        function addCart(id) {
            var name = $("#name").val();
            var harga = $("#harga").val();
            var stok = $("#stok").val();
            var jumlah = $("#jumlah").val();

            var formData = new FormData();
            formData.append('name', name);
            formData.append('harga', harga);
            formData.append('stok', stok);
            formData.append('jumlah', jumlah);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('/customer/addCart') }}/"+id,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Added To Cart',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $(".btn-close").click();
                    $("#read").html(response);

                },
                error: function(xhr, status, error) {                    
                    console.log(xhr.responseText);
                }
            });
        }

        function search() {
            var search = $("#search").val();

            var formData = new FormData();
            formData.append('search', search);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('search') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#read").html(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function logout() {
            // Show confirmation SweetAlert
            Swal.fire({
                title: 'Are you sure to Logout ?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Logout',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: "{{ route('logout') }}",
                        method: "POST",
                        data: {},
                        success: function(response) {     
                            window.location="{{route("login")}}";
                            // // Show success SweetAlert after deletion
                            // Swal.fire({
                            //     title: 'Logout success!',
                            //     icon: 'success',
                            //     timer: 1500,
                            //     buttons: false,
                            // });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            alert('Error: ' + xhr.responseText);
                        }
                    });
                }
            });
        }
    </script>
@endsection
