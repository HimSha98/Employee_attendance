// function showRegister() {
//     document.getElementById("register-form").style.display = "block";
//     document.getElementById("login-form").style.display = "none";
// }
// function showLogin() {
//     document.getElementById("register-form").style.display = "none";
//     document.getElementById("login-form").style.display = "block";
// }
// Toggle between the Register and Login forms
document.getElementById('sign-up-link').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('register-form').classList.remove('d-none');
    document.getElementById('login-form').classList.add('d-none');
});

document.getElementById('back-to-login').addEventListener('click', function(event) {
    event.preventDefault();
    document.getElementById('register-form').classList.add('d-none');
    document.getElementById('login-form').classList.remove('d-none');
});