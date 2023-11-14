<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</head>
@if(session('error'))
<div style="color: red;">{{ session('error') }}</div>
@endif
<body style="background-color: #191919; font-family: Bebas neue">
    <section class="vh-120">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-6">
            <div class="card shadow-2-strong" style="border-radius: 1rem; background-color :#19191998; border-color:white">
              <div class="card-body p-5 text-center">
                <h3 class="mb-1 text-light">Coffe Masbro</h3>
                <h5 class="mb-3 text-light">OTP Verification</h5>
                <div id="step1">
                    <form method="post" action="{{ route('verify.otp') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" id="otp" placeholder="Enter Your OTP Code" name="otp" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Verify OTP</button>
                            </div>
                        </div>
                    </form>  
                </div>
                
                <hr class="my-3">
                 <p class="teks text-light">Haven't Received Your OTP Code?<button class="btn" type="button" onclick="resendOtp()" ><a class="link-info">Resend OTP</a></button></p>
                  {{-- <button type="button" onclick="resendOtp()">resend otp</button>     --}}
                  {{-- <p class="teks text-light">Already have an account?<a href="{{ url('/') }}" class="link-info">Login Here</a></p> --}}
                  {{-- <p class="teks text-light">Don't have any account?<a href="{{ url('/register') }}" class="link-info">Register Here</a></p> --}}
                {{-- </form> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
  </body>

    {{-- <h2>Verify OTP</h2>

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form method="post" action="{{ route('verify.otp') }}">
        @csrf
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit">Verify OTP</button>
    </form>    
        <button type="button" onclick="resendOtp()">resend otp</button>     --}}
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
</html>
