@extends('layout.pelangganLayout')
@section('container')
    <div class="container d-flex justify-content-center mt-5" style=" padding: 20px;">
        <div class="card w-50 py-5" style ="box-shadow: 0 0 10px rgba(0, 0, 0, 0.3)">
            <h2 style="display:flex;justify-content:center;">QR Code Payment</h2>
            <div id="qrcode" style="border: 2px solid #fff;display:flex;justify-content:center;">
            </div>
            <small style ="display: flex; justify-content:center;color:rgba(0, 0, 0, 0.315);margin-top:2vh;">Upload Your
                Transfer Proof Here</small>
            <div class="d-flex justify-content-center">
                <button class="btn mt-1" style ="background-color:#7B551C;color:white;" onclick="create()">Upload</button>
                <button class="btn mt-1" style ="background-color:#7B551C;color:white;" id="pay-button">Bayar</button>
            </div>
        </div>
    </div>
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

    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script>
        // Mendapatkan data dari parameter URL
        var urlParams = new URLSearchParams(window.location.search);
        var qrCodeText = urlParams.get('data');

        // Mengisi QR Code dengan data yang diterima dari parameter URL
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: qrCodeText,
            width: 256,
            height: 256
        });
    </script>
    <script>
        function create() {
            $.get("{{ route('showUploadBukti') }}", {}, function(data, status) {
                $("#staticBackdropLabel").html("Upload Your Transfer Proof");
                $("#page").html(data);
                $("#staticBackdrop").modal("show");
            });
        }

        function uploadBukti() {
            var urlParams = new URLSearchParams(window.location.search);
            var dataParam = urlParams.get('data');
            var idTransaksi = null;

            if (dataParam) {
                var idTransaksiStart = dataParam.indexOf('id transaksi: ');
                if (idTransaksiStart !== -1) {
                    idTransaksiStart += 'id transaksi: '.length;
                    var idTransaksiEnd = dataParam.indexOf('\n', idTransaksiStart);
                    if (idTransaksiEnd !== -1) {
                        idTransaksi = dataParam.substring(idTransaksiStart, idTransaksiEnd).trim();
                    }
                }
            }

            console.log(idTransaksi);
            var foto = $("#foto")[0].files[0];
            var formData = new FormData();
            formData.append('id_transaksi', idTransaksi);
            formData.append('foto', foto);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('uploadBukti') }}",
                method: "POST",
                data: formData,
                processData: false, // Pastikan Anda menonaktifkan pengolahan data
                contentType: false, // Pastikan Anda menonaktifkan jenis konten
                success: function(response) {
                    $(".btn-close").click();
                    Swal.fire({
                        icon: 'success',
                        title: 'Payment Received, Please Wait for confirmation from the cashier',
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
    </script>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MITRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            var snapToken = '{{ request()->input('snapToken') }}';

            // SnapToken acquired from previous step
            snap.pay(snapToken, {
                // Optional
                onSuccess: function(result) {
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);                    
                    var urlParams = new URLSearchParams(window.location.search);
                    var idTransaksi = urlParams.get('data').split('id transaksi: ')[1].split('\n')[0].trim();                    
                    // Redirect ke halaman updateTransactionStatus dengan id_transaksi
                    window.location.href = "{{ url('customer/updateTransactionStatus') }}/" + idTransaksi;
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>    
@endsection
