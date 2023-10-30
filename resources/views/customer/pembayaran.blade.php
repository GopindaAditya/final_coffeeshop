@extends('layout.pelangganLayout')
@section('container')
<div class="container d-flex justify-content-center mt-5" style=" padding: 20px;">
    <div class="card w-50 py-5" style ="box-shadow: 0 0 10px rgba(0, 0, 0, 0.3)">
        <h2 style="display:flex;justify-content:center;">QR Code Payment</h2>
        <div id="qrcode" style="border: 2px solid #fff;display:flex;justify-content:center;">
            <!-- Tambahkan gambar/logo di sini -->
            {{-- <img src="../storage/bg.jpg" alt="Company Logo" style="width: 80px; height: 80px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"> --}}
        </div>
        <small style ="display: flex; justify-content:center;color:rgba(0, 0, 0, 0.315);margin-top:2vh;">Upload Your Transfer Proof Here</small>
        <div class="d-flex justify-content-center">
            <button class="btn mt-1" style ="background-color:#7B551C;color:white;">Upload</button>
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
@endsection
