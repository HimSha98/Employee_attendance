<?php
include 'database/db.php';
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<?php include 'includes/header.php'; ?>
    <div class="container">
        <div class="row d-flex justify-content-center min-vh-100">
            <div class="col-lg-3 col-md-2"></div>
            <div class="col-lg-6 col-md-8 my-5">
                <div class="form-card d-none mt-4 p-4 rounded-2 my-form" id="register-form">
                    <h2>Register</h2>
                    <form action="register.php" method="POST">
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

                        <div class="mt-3 links text-end">
                            <a href="#" class="text-dark" id="back-to-login">Back to Login</a>
                        </div>

                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>

                <!-- Login Form -->
                <div class="form-card mt-4 p-4 rounded-2 my-form" id="login-form">
                    <h2>User Login</h2>
                    <form action="login.php" method="POST">
                        <input type="hidden" name="action" value="login">

                        <div class="mb-3">
                            <label for="login-username" class="form-label">Username</label>
                            <input type="text" id="login-username" name="username" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="login-password" class="form-label">Password</label>
                            <input type="password" id="login-password" name="password" class="form-control" required>
                        </div>

                        <div class="mt-3 links d-flex justify-content-between">
                            <a href="admin.php" class="text-dark">Admin Login</a>
                            <a href="#" class="text-dark" id="sign-up-link">Sign Up</a>
                        </div>

                        <div class="submit-btn mt-3">
                            <button type="submit" class="btn btn-success">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>