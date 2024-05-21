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
        <form>
            <label class="email" for="email">Emali Address *</label><br>
            <input class="email-box" type="text" id="email" name="email"><br><br>
            <label class="password" for="lname">Password *</label>
            <input class="password-box" type="password" id="password" name="password"><br>
            <a class="forget" href="">Forgot Password?</a><br>
            <input class="checkbox" type="checkbox">
            <label class="remember">Remember Me</label><br>
            <input class="login" type="submit" value="Login">
            <p class="new">New Here?<a class="register-link" href="/register"> Register</a></p><br>
        </form>
    </div>
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