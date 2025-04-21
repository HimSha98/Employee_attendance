<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Attendance System</title>
</head>
<body>
    <h1>Employee Attendance System</h1>
    
    <h2>Register</h2>
    <form action="process.php" method="POST">
        <input type="hidden" name="action" value="register">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required><br>
        <button type="submit">Register</button>
    </form>

    <h2>Login</h2>
    <form action="process.php" method="POST">
        <input type="hidden" name="action" value="login">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color:red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>
</body>
</html>