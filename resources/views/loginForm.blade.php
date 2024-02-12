<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <title>Login</title>
</head>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <body style="background-color: #191919; font-family: Bebas neue">
        <section class="vh-120">
          <div class="container h-100" id="loginform">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem; background-color :#19191998; border-color:white">
                  <div class="card-body p-5 text-center">
                    <h3 class="mb-1 text-light">Coffe Masbro</h3>
                    <h5 class="mb-3 text-light">Log in</h5>
                    <form class="login-form" action="{{ route('login') }}" method="POST">
                      @csrf
                      <div class="form-outline form-white mb-4">
                        <input type="email" placeholder="e-mail" name="email" class="form-control form-control-lg" required>
                      </div>
                      <div class="form-outline form-white mb-4">
                        <input type="password" placeholder="password" name="password" class="form-control form-control-lg" required>
                      </div>
                      <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                      <hr class="my-3">
                      <p class="teks text-light">Forgot Password?<a href="{{ url('/forgotPassword') }}" class="link-info">Click
                         Here</a></p>
                      <p class="teks text-light">Don't have any account?<a href="{{ url('/register') }}" class="link-info">Register Here</a></p>
                    </form>
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
      {{-- <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">email</label>
        <input type="text" name="email" id="email"><br>
        <label for="password">password</label>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="login">
      </form>
      <p><a href="{{ url('/register') }}">don't have an account</a></p>
</body> --}}
</html>
      {{-- <div class="section">
        <div class="container">
          <div class="row full-height justify-content-center">
            <div class="col-12 text-center align-self-center py-5">
              <div class="section pb-5 pt-5 pt-sm-2 text-center">
                <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                      <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                      <label for="reg-log"></label>
                <div class="card-3d-wrap mx-auto">
                  <div class="card-3d-wrapper">
                    <div class="card-front">
                      <div class="center-wrap">
                        <div class="section text-center">
                          <h4 class="mb-4 pb-3">Log In</h4>
                          <div class="form-group">
                            <input type="email" class="form-style" placeholder="Email">
                            <i class="input-icon uil uil-at"></i>
                          </div>	
                          <div class="form-group mt-2">
                            <input type="password" class="form-style" placeholder="Password">
                            <i class="input-icon uil uil-lock-alt"></i>
                          </div>
                          <a href="https://www.web-leb.com/code" class="btn mt-4">Login</a>
                          <p class="mb-0 mt-4 text-center"><a href="https://www.web-leb.com/code" class="link">Forgot your password?</a></p>
                            </div>
                          </div>
                        </div>
                    <div class="card-back">
                      <div class="center-wrap">
                        <div class="section text-center">
                          <h4 class="mb-3 pb-3">Sign Up</h4>
                          <div class="form-group">
                            <input type="text" class="form-style" placeholder="Full Name">
                            <i class="input-icon uil uil-user"></i>
                          </div>	
                          <div class="form-group mt-2">
                            <input type="tel" class="form-style" placeholder="Phone Number">
                            <i class="input-icon uil uil-phone"></i>
                          </div>	
                          <div class="form-group mt-2">
                            <input type="email" class="form-style" placeholder="Email">
                            <i class="input-icon uil uil-at"></i>
                          </div>
                          <div class="form-group mt-2">
                            <input type="password" class="form-style" placeholder="Password">
                            <i class="input-icon uil uil-lock-alt"></i>
                          </div>
                          <a href="https://www.web-leb.com/code" class="btn mt-4">Register</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </div> --}}