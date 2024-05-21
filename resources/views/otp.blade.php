<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/otp_verify.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <title>OTP Verification</title>
</head>

<body>
    <div class="image-box">
        <img class="background" src="{{ asset('images/fundflick.png') }}">
    </div>
    <div class="otp-verification-box">
        <img src="{{ asset('images/money.png') }}" alt="">
        <h3>OTP Verification</h3>
        <p>Please enter the OTP sent to your Email</p>
        <form action="{{ route('otp.verify', ['email' => $emailFromUrl]) }}" method="POST">
            @csrf
            <div class="otp-input">
                <label for="otp">OTP:</label><br>
                <input type="text" id="otp" name="otp" required><br>
            </div>
            <input type="hidden" name="email" value="{{ $emailFromUrl }}">
            <div class=" submit-button">
                <button type="submit" class="submit">Verify OTP</button>
            </div>
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

    @if(Session::has('otp'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.error("{{ session('otp') }}")
    </script>
    @endif
</body>

</html>