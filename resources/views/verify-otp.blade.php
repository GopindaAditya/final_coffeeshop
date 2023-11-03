<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify OTP</title>
</head>
<body>
    <h2>Verify OTP</h2>

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form method="post" action="{{ route('verify.otp') }}">
        @csrf
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit">Verify OTP</button>
    </form>    
        <button type="button" onclick="resendOtp()">resend otp</button>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function resendOtp() {                         

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('resend.otp')}}", 
                method: "POST",
                data: {},                
                success: function(response) {                    
                    // Tampilkan pesan sukses jika diperlukan
                    Swal.fire({
                        icon: 'success',
                        title: '"Successfully sent OTP."',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);                    
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        }
    </script>
</body>
</html>
