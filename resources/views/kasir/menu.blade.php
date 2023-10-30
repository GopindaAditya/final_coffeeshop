@extends('layout.kasirLayout')
@section('container')
    <div id="read" class="mt-3"></div>
    <script>
        $(document).ready(function() {
            read();

            $("#search").on("input", function() {
                search();
            });
        })

        function read() {
            $.get("{{ route('kasir.read') }}", {}, function(data, status) {
                $("#read").html(data);
            })
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
                url: "{{ url('/kasir/menu/search') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Tampilkan hasil pencarian di div dengan id "read"
                    $("#read").html(response);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function stok(id){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('kasir/menu/stok') }}/" + id,
                method: "GET", // Ubah metode HTTP menjadi POST
                data: {},
                success: function(data, status) {
                    $("#staticBackdropLabel").html("update Menu");
                    $("#page").html(data);
                    $("#staticBackdrop").modal("show");
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
        
        function addStok(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('kasir/menu/addStok') }}/" + id,
                method: "POST",
                data: {},
                success: function(response) {
                    console.log(response);
                    // Refresh tampilan setelah stok diperbarui
                    read();
                    // Tampilkan pesan sukses jika diperlukan
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Stok berhasil ditambahkan!',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // Tampilkan pesan error jika diperlukan
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }

        function minStok(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('kasir/menu/minStok') }}/" + id,
                method: "POST",
                data: {},
                success: function(response) {
                    console.log(response);
                    // Refresh tampilan setelah stok diperbarui
                    read();
                    // Tampilkan pesan sukses jika diperlukan
                    // Swal.fire({
                    //     icon: 'success',
                    //     title: 'Stok berhasil dikurangi!',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // Tampilkan pesan error jika diperlukan
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }
    </script>
@endsection
