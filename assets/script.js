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

// HS CLEAR HISTORY ONLY ON INDEX.PHP
// if (window.location.pathname.endsWith("index.php")) {
//     window.onload = function () {
//         window.history.replaceState(null, null, window.location.href);
//     };
// }