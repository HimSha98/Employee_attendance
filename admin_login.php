<?php
session_start();

// Define the admin credentials
$admin_username = "hansraj";
$admin_password = password_hash("hansraj", PASSWORD_DEFAULT); // Change "your_secure_password" to your desired password

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
<div class="container mt-5">
    <h1 class="text-center">Admin Login</h1>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form method="POST" class="mx-auto" style="max-width: 400px;">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
<?php include 'includes/footer.php'; ?>