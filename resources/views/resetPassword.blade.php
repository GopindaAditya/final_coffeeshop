<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <title>Reset Password</title>
</head>
@if(session('error'))
<div style="color: red;">{{ session('error') }}</div>
@endif
<body style="background-color: #191919; font-family: Bebas neue">
    <section class="vh-120">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem; background-color :#19191998; border-color:white">
              <div class="card-body p-5 text-center">
                <h3 class="mb-1 text-light">Coffe Masbro</h3>
                <h5 class="mb-3 text-light">Reset Password</h5>
                <form method="post" action="{{ url('/resetPassword') }}">
                    @csrf        
                    <div class="form-outline form-white mb-4">
                        <input type="password" placeholder="Enter your new password" name="password" id="password"
                            class="form-control form-control-lg" required>
                    </div>
            
                    <div class="form-outline form-white mb-4">
                        <input type="password" placeholder="repeatPassword" name="password_confirmation"
                            id="password_confirmation" class="form-control form-control-lg" required>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
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
</html>
