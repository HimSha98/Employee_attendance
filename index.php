<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance System</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1>Employees Attendance System</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 my-5">

                <div class="form-card d-none">
                    <h2>Register</h2>
                    <form action="process.php" method="POST">
                        <input type="hidden" name="action" value="register">
                        <div class="mb-3">
                            <label for="register-username" class="form-label">Username</label>
                            <input type="text" id="register-username" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="register-password" class="form-label">Password</label>
                            <input type="password" id="register-password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="register-confirm-password" class="form-label">Confirm Password</label>
                            <input type="password" id="register-confirm-password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>

                <div class="form-card mt-4 border p-5 rounded-5">
                    <h2>Login</h2>
                    <form action="process.php" method="POST">
                        <input type="hidden" name="action" value="login">
                        <div class="mb-3">
                            <label for="login-username" class="form-label">Username</label>
                            <input type="text" id="login-username" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="login-password" class="form-label">Password</label>
                            <input type="password" id="login-password" name="password" class="form-control" required>
                        </div>
                        <div class="mt-3 links">
                            <a href="">Forgot Password</a>
                            <a href="#">Sign Up</a>
                        </div>
                        <div class="submit-btn mt-3">
                            <button type="submit" class="btn btn-success">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>