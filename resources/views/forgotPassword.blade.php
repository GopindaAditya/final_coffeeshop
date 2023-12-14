<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="../css/login.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  {{-- <link rel="stylesheet" href="../css/styleOwner.css"> --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
    <title>Forgot Password</title>
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
                    <h5 class="mb-3 text-light">Forgot Password</h5>
                    <div id="step1">
                        <form id="sendOtpForm">   
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <input type="text" id="telepon" name="telepon" placeholder="Telephone Number" class="form-control form-control-lg" required>   
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary btn-lg btn-block" type="button" onclick="sendOtp()">Send OTP</button>
                                </div>
                            </div>
                        </form>
                    </div>
                
                    <div id="step2">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" id="otp" name="otp" placeholder="Enter your OTP Code" class="form-control form-control-lg" required>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary btn-lg btn-block" type="button" onclick="verifyOtp()">Verify OTP</button>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-3">
                     <p class="teks text-light">Haven't Received Your OTP Code?<button class="btn" type="button" onclick="resendOtp()" ><a class="link-info">Resend OTP</a></button></p>
                      {{-- <button type="button" onclick="resendOtp()">resend otp</button>     --}}
                      <p class="teks text-light">Already have an account?<a href="{{ url('/login') }}" class="link-info">Login Here</a></p>
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

    {{-- <h2>Forgot Password</h2> --}}

    {{-- @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif --}}

    {{-- <div id="step1">
        <form id="sendOtpForm">   
            @csrf
            <label for="telepon">Telepon</label>
            <input type="text" id="telepon" name="telepon" required>   
            <button type="button" onclick="sendOtp()">Send OTP</button>
        </form>
    </div>

    

    <div id="step2">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="button" onclick="verifyOtp()">Verify OTP</button>
    </div> --}}
    
    <script>
        function sendOtp() {
            var telepon = $('#telepon').val();                

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('sendOtp')}}", 
                method: "POST",
                data: {telepon},                
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
                        title: 'Successfully resent OTP.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr, status, error) {
                    // console.log(xhr.responseText);                    
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed sent OTP.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
            }


        function verifyOtp() {            
            var otp = $('#otp').val();        

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('/changePassword')}}", 
                method: "POST",
                data: {otp},
                success: function(response) {                    
                    window.location="{{route("resetPassword")}}";                                    
                },
                error: function(xhr, status, error) {
                    // console.log(xhr.responseText);                    
                    // alert('Terjadi kesalahan: ' + xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'The OTP Code You Entered Is Incompatible',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }

    </script>
</body>
</html>