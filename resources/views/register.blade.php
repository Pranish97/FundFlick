<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/register.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <title>Signup</title>
</head>

<body>
    <div class="image-box">
        <img class="background" src="images/fundflick.png">

    </div>
    <div class="reg-right-box">
        <img src="images/money.png" alt="">
        <h3>Register to <br>Fund Flick</h3>
        <p class="new">New Here?</p>
        <form action="{{ route('storeUser') }}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="mb-2">
                <label class="userText">Full Name </label>
                <input type="text" id="name" class="username" name="name" onclick="changeStyleUser()"
                    onkeyup="onKeyUpUser()" />
                <div class="error"></div>
            </div>
            <div class="mb-2">
                <label class="emailText">Email address </label>
                <input type="email" class="email" id="email" name="email" onclick="changeStyleEmail()"
                    onkeyup="onKeyUpEmail()">
                <div class="error"></div>
            </div>
            <div class="mb-2 password-container">
                <label class="passwordText">Password</label>
                <input type="password" name="password" class="password" id="password" onclick="changeStylePassword()"
                    onkeyup="onKeyUpPassword()">
                <img src="images/closed-eye.png"
                    style="width: 36px; cursor:pointer; position: absolute; top: 32.5%; transform: translateY(-50%); height:45px; right:22%"
                    id="eye-icon">
                <div class="error"></div>
            </div>
            <div class="mb-2 password-container">
                <label class="cpasswordText">Confirm Password </label>
                <input type="password" class="cpassword" id="cpassword" name="password_confirmation"
                    onclick="changeStyleCpassword()" onkeyup="changeStyleCpassword()">
                <div class="error"></div>
                <img src="images/closed-eye.png"
                    style="width: 36px;cursor: pointer;position: absolute;margin-left: 558px;top: 34%;height: 45px;transform: translateY(-50%);"
                    id="eye-icon-conf">
            </div>
            <div class="mb-2">
                <label class="country-code" for="country-code">Phone Number</label>
                <select id="country-code" class="select" name="country_code">
                    <option value="" data-country-code="">Select Country</option>
                    <option data-country-code="NP" value="+977"
                        data-content="<span class='flag-icon flag-icon-np'></span> Nepal (+977)">Nepal (+977)</option>
                    <option data-country-code="IN" value="+91"
                        data-content="<span class='flag-icon flag-icon-in'></span> India (+91)">India (+91)</option>
                    <option data-country-code="CN" value="+86"
                        data-content="<span class='flag-icon flag-icon-cn'></span> China (+86)">China (+86)</option>
                    <option data-country-code="PK" value="+92"
                        data-content="<span class='flag-icon flag-icon-pk'></span> Pakistan (+92)">Pakistan (+92)
                    </option>
                    <option data-country-code="FR" value="+33"
                        data-content="<span class='flag-icon flag-icon-fr'></span> France (+33)">France (+33)</option>
                    <option data-country-code="RU" value="+7"
                        data-content="<span class='flag-icon flag-icon-ru'></span> Russia (+7)">Russia (+7)</option>
                </select>
                <input type="text" class="phone" id="phone" name="phone_number" onclick="changeStylePhone()"
                    onkeyup="changeStylePhone()"><br><br>
                <div class="error"></div>
            </div>
            <button type="submit" class="registerButton">Register</button>
            <p class="already">Already Member?<a class="login-link" href="/login"> Login</a></p>
        </form>
    </div>
    <script src="js/register.js"></script>
    @if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</body>

</html>