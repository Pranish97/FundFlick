<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <title>Login</title>
</head>

<body>
    <div class="image-box">
        <img class="background" src="images/fundflick.png">

    </div>
    <div class="right-box">
        <img src="images/money.png" alt="">
        <h3>Login to <br>Fund Flick</h3>
        <p class="welcome">Welcome Back</p>
        <form action="{{ route('loginUser') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-2">
                <label class="email" for="email">Email address *</label><br>
                <input type="email" class="email-box" id="email" name="email" onclick="changeStyleEmail()" onkeyup="onKeyUpEmail()"><br><br>
                <div class="error"></div>
            </div>
            <div class="mb-2">
                <label class="password" for="password">Password *</label><br>
                <input type="password" class="password-box" id="password" name="password" onclick="changeStylePassword()" onkeyup="onKeyUpPassword()"><br><br>
                <img src="images/closed-eye.png" style="width: 36px; cursor:pointer; position: absolute; top: 47%; transform: translateY(-50%); height:45px; right:11%" id="eye-icon">
                <div class="error"></div>
            </div>
            <a class="forget" href="">Forgot Password?</a><br>
            <div class="mb-2">
                <input type="checkbox" class="checkbox" id="remember" name="remember">
                <label class="remember" for="remember">Remember Me</label><br>
            </div>
            <button type="submit" class="login">Login</button>
            <p class="new">New Here?<a class="register-link" href="/register"> Register</a></p>
        </form>
    </div>
    <script src="js/login.js"></script>
    @if(Session::has('success'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.success("{{ session('success') }}")
    </script>
    @endif

    @if(Session::has('error'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.error("{{ session('error') }}")
    </script>
    @endif

</body>

</html>