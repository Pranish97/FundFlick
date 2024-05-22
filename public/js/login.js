function changeStyleEmail() {
    var emailInput = document.getElementById('email');
    emailInput.classList.add('clicked-style');
}
function onKeyUpEmail(){
    var emailInput = document.getElementById('email');
    emailInput.classList.add('clicked-style');
}

function changeStylePassword() {
    var passwordInput = document.getElementById('password');
    passwordInput.classList.add('clicked-style');
}
function onKeyUpPassword(){
    var passwordInput = document.getElementById('password');
    passwordInput.classList.add('clicked-style');
}
//showw Password 
let eyeIcon = document.getElementById('eye-icon');
eyeIcon.onclick = function() {
    if (password.type == "password") {
        password.type = "text";
        eyeIcon.src = "images/eye-open.png"
    } else {
        password.type = "password";
        eyeIcon.src = "images/closed-eye.png"
    }
}