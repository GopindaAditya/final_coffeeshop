@extends('layout.pelangganLayout')
@section('container')
    <div id="read" class="mt-3"></div>
    <script>
        $(document).ready(function() {
            read();
        });        

        function read() {
            $.get("{{ route('customerDetail') }}", {}, function(data, status) {
                $("#read").html(data);
            })
        }

        function show() {
            
        }        

        function update() {
            var name = $("#name").val();
            var email = $("#email").val();
            var alamat = $("#alamat").val();
            var telepon = $("#telepon").val();

            var formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('alamat', alamat);
            formData.append('telepon', telepon);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('customer/update') }}",
                method: "POST",
                data: formData,
                processData: false, // Pastikan Anda menonaktifkan pengolahan data
                contentType: false, // Pastikan Anda menonaktifkan jenis konten
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Successfully Changed!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location = "{{ route('customer') }}";
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }
    </script>
@endsection