<?php
session_start();
include 'database/db.php'; // Include database connection if necessary for cleanup or other operations

// Check if the user is admin or employee before destroying the session
$isAdmin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Destroy all session variables
session_unset();
session_destroy();

// Redirect based on the user type
if ($isAdmin) {
    // Redirect admin to the admin login page
    header('Location: admin_login.php');
} else {
    // Redirect employees to the main login/registration page
    header('Location: index.php');
}

exit;