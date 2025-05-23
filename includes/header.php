<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Employee Attendance System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="py-3 head-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 d-flex align-items-center justify-content-center">
                    <div class="scrolling-text text-center text-white mx-5">
                        <span class="text-uppercase fw-bold" style="letter-spacing: 4px;">Hello Buddy, welcome to our attendance portal</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center justify-content-center my-3" id="navbarNav">
                        <?php
                        // Check if an admin is logged in
                        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                            <span class="text-white me-3">HELLO ADMIN DEVRAJ</span>
                        <?php 
                        // Check if a user is logged in
                        elseif (isset($_SESSION['user_id'])): ?>
                            <span class="text-white me-3">HELLO <?= htmlspecialchars($_SESSION['username']); ?></span>
                            <a href="admin_login.php" class="btn btn-light">Admin Login</a>
                        <?php 
                        // No one is logged in
                        else: 
                            // Determine current page and show the opposite login button
                            $current_page = basename($_SERVER['PHP_SELF']);
                            if ($current_page === 'admin_login.php'): ?>
                                <!-- <a href="user_login.php" class="btn btn-light">User Login</a> -->
                                <div class="admin-login-btn">
                                        <a href="index.php" class="p-3 text-decoration-none border rounded-3 text-white fw-bold">User Login</a>
                                    </div>
                            <?php else: ?>
                                <div class="admin-login-btn">
                                        <a href="admin.php" class="p-3 text-decoration-none border rounded-3 text-white fw-bold">Admin Login</a>
                                    </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>