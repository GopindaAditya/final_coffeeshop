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
<body>
    <h2>Reset Password</h2>

    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <form method="post" action="{{ url('/resetPassword') }}">
        @csrf        
        <div class="form-outline form-white mb-4">
            <input type="password" placeholder="password" name="password" id="password"
                class="form-control form-control-lg" required>
        </div>

        <div class="form-outline form-white mb-4">
            <input type="password" placeholder="repeatPassword" name="password_confirmation"
                id="password_confirmation" class="form-control form-control-lg" required>
        </div>
        <button type="submit">sumbit</button>
    </form>
</body>
</html>
