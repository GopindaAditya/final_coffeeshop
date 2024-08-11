@extends('layout.pelangganLayout')
@section('container')
<div class="container mt-5">
    <div id="read" class="mt-3 "></div>
</div>
    <script>
        $(document).ready(function() {
            read();
        });

        function read() {
            $.get("{{ route('detailCart') }}", {}, function(data, status) {
                $("#read").html(data);
            });
        }
        
        function destroy() {
            var selectedItems = [];
            $('.item-checkbox:checked').each(function() {
                selectedItems.push($(this).val());
            });

            if (selectedItems.length === 0) {
                // alert('Select at least one item for delete.');
                Swal.fire({
                    icon: 'warning', 
                    title: 'Please Select an Item', 
                    text: 'You need to select an item before deleting.', 
                    showConfirmButton: true,
                });

                return;
            }

            // Show confirmation SweetAlert
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
                        url: "{{ url('/customer/cart/delete') }}",
                        method: "POST",
                        data: {
                            items: selectedItems
                        },
                        success: function(response) {
                            read();

                            Swal.fire({
                                title: 'Item successfully deleted!',
                                icon: 'success',
                                timer: 1500,
                                buttons: false,
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            alert('Error: ' + xhr.responseText);
                        }
                    });
                }
            });
        }


        function cekout() {
            var selectedItems = [];
            $('.item-checkbox:checked').each(function() {
                selectedItems.push($(this).val());
            });
            console.log(selectedItems);
            if (selectedItems.length === 0) {
                // alert('Select at least one item for checkout.');
                Swal.fire({
                    icon: 'warning', 
                    title: 'Please Select an Item', 
                    text: 'You need to select an item before checkout.', 
                    showConfirmButton: true,
                });
                return;
            }

            var formData = {
                items: selectedItems
            };
            console.log(formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('/customer/cekout') }}/",
                method: "POST",
                data: JSON.stringify(formData), // Mengonversi objek formData ke dalam format JSON
                contentType: "application/json", // Tentukan tipe konten sebagai JSON
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Wait for confirmation from cashier',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    var qrCodeText = '';
                            response.items.forEach(function(item) {
                                qrCodeText += 'id transaksi: '+item.id_transaksi+'\nid customer: '+item.name +'\nid produks'+item.produk +'\nSize: '+item.size+'\nJumlah Beli:' + item.quantity + '\nHarga:' + item.price +
                                    '\n';
                            });
                            
                            window.location = "{{ route('qrcode') }}?data=" + encodeURIComponent(qrCodeText) + "&snapToken=" + response.snapToken;

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function cekotSemua(){
            Swal.fire({
                title: 'CONFIRM',
                text: 'Are you sure you want to checkout all the items?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.item-checkbox').prop('checked', true); // Mencentang semua checkbox
                    cekout();
                }
            });
        }
    </script>
@endsection
