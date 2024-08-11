@extends('layout.ownerLayout')
@section('container')
    <div class="text-start container">
        <button class="btn" id="addButton" onClick="create()" style="background-color:#7B551C;color:white">Add Menu</button>
    </div>
    <div id="read" class="mt-3 "></div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="page"></div>
                </div>
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
            $.get("{{ route('owner.read') }}", {}, function(data, status) {
                $("#read").html(data);
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
                url: "{{ url('/owner/menu/search') }}",
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

        function create() {
            $.get("{{ route('create') }}", {}, function(data, status) {
                $("#staticBackdropLabel").html("Add New Menu");
                $("#page").html(data);
                $("#staticBackdrop").modal("show");
            });
        }

        function addProduk() {
            var name = $("#name").val();
            var harga = $("#harga").val();
            var desc = $("#desc").val();
            var kategori = $("#kategori").val();
            var stok = $('#stok').val()
            var foto = $("#foto")[0].files[0];

            var formData = new FormData();
            formData.append('name', name);
            formData.append('harga', harga);
            formData.append('desc', desc);
            formData.append('kategori', kategori);
            formData.append('stok', stok);
            formData.append('foto', foto);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('owner/menu/addProduk') }}",
                method: "POST",
                data: formData,
                processData: false, // Pastikan Anda menonaktifkan pengolahan data
                contentType: false, // Pastikan Anda menonaktifkan jenis konten
                success: function(response) {
                    $(".btn-close").click();
                    read();
                    Swal.fire({
                        icon: 'success',
                        title: 'Data successfully added!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }


        function edit(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('owner/menu/edit') }}/" + id,
                method: "GET", // Ubah metode HTTP menjadi POST
                data: {},
                success: function(data, status) {
                    $("#staticBackdropLabel").html("Edit Menu");
                    $("#page").html(data);
                    $("#staticBackdrop").modal("show");
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function update(id) {
            var name = $("#name").val();
            var harga = $("#harga").val();
            var desc = $("#desc").val();
            var stok = $("#stok").val();
            var foto = $("#foto")[0].files[0];

            var formData = new FormData();
            formData.append('name', name);
            formData.append('harga', harga);
            formData.append('desc', desc);
            formData.append('stok', stok);
            formData.append('foto', foto);

            console.log(formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('owner/menu/update') }}/" + id,
                method: "POST",
                data: formData,
                processData: false, // Pastikan Anda menonaktifkan pengolahan data
                contentType: false, // Pastikan Anda menonaktifkan jenis konten
                success: function(response) {
                    console.log(response);
                    $(".btn-close").click();
                    read();
                    Swal.fire({
                        icon: 'success',
                        title: 'Data successfully changed!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }

        function destroy(id) {
            
            Swal.fire({
                title: 'Are you sure you want to delete the selected item?',
                text: "Deleted items cannot be restored!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Delete!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('owner/menu/delete') }}/" + id,
                method: "POST",
                data: { },

                success: function(response) {
                    read();

                    // Show success SweetAlert after deletion
                    Swal.fire({
                        title: 'Data successfully deleted!',
                        icon: 'success',
                        timer: 1500,
                        buttons: false,
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
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
                url: "{{ url('owner/menu/addStok') }}/" + id,
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
                url: "{{ url('owner/menu/minStok') }}/" + id,
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
@endsection()
