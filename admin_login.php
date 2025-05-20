<?php
session_start();

// Define the admin credentials
$admin_username = "devraj";
$admin_password = password_hash("devraj_123", PASSWORD_DEFAULT); // Change "your_secure_password" to your desired password

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $admin_username && password_verify($password, $admin_password)) {
        // Successful login
        $_SESSION['admin_logged_in'] = true;
        header("Location: Admin.php");
        exit;
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<?php include 'includes/header.php'; ?>
<div class="container ">
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <div class="row d-flex justify-content-center min-vh-100">
        <div class="col-xl-4 col-lg-3 col-md-2"></div>
        <div class="col-xl-4 col-lg-6 col-md-8 my-5">
            <div class="mt-4 p-4 rounded-2 admin-form">
                <h2>Admin Login</h2> 
                <form method="POST" class="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="mt-3 links d-flex justify-content-between">
                        <a href="index.php" class="text-dark">User Login</a>
                    </div>
                    <div class="submit-btn mt-3">
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xl-4 col-lg-3 col-md-2"></div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>