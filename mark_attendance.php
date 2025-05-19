<?php
include 'database/db.php';
session_start();

// Include the header
include 'includes/header.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    echo "<div class='container text-center mt-5'>";
    echo "<div class='row'>";
    echo "<div class='col-lg-3 col-md-2'></div>";
    echo "<div class='col-lg-6 col-md-8 my-5'>";
    echo "<div class='access-denied-popup p-3'>";
    echo "<h1 class='text-danger mt-4'>Access Denied</h1>";
    echo "<p class='text-dark fw-bold'>You are logged out. Please log in again to mark your attendance.</p>";
    echo "<div class='login-btns my-5 d-flex flex-column flex-wrap'>";
    echo "<a href='index.php' class='btn btn-primary mx-5'>Go to User Login Page</a>";
    echo "<a href='admin_login.php' class='btn btn-primary mt-4 mx-5'>Go to Admin Login Page</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "<div class='col-lg-3 col-md-2'></div>";
    echo "</div>";
    echo "</div>";
    include 'includes/footer.php';
    exit();
}

// Process the POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the attendance action (check-in or check-out)
    $type = $_POST['type'];
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $date = date('Y-m-d');
    $time = date('Y-m-d H:i:s');

    // Prepare SQL query based on the action type
    if ($type === 'check_in') {
        $query = "INSERT INTO attendance (user_id, username, check_in_time, date) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isss", $user_id, $username, $time, $date);
        $message = "Check-in successful!";
    } elseif ($type === 'check_out') {
        $query = "UPDATE attendance SET check_out_time = ? WHERE user_id = ? AND date = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sis", $time, $user_id, $date);
        $message = "Check-out successful!";
    } else {
        echo "<div class='container text-center mt-5'>";
        echo "<h1 class='text-danger'>Invalid Request</h1>";
        echo "<p>Invalid attendance action specified.</p>";
        echo "<a href='dashboard.php' class='btn btn-primary'>Go Back to Dashboard</a>";
        echo "</div>";
        include 'includes/footer.php';
        exit();
    }

    // Execute the query
    if ($stmt->execute()) {
        echo "<div class='container text-center mt-5'>";
        echo "<h1 class='text-success'>$message</h1>";
        echo "<p>Your attendance has been recorded successfully.</p>";
        echo "<a href='dashboard.php' class='btn btn-primary'>Go Back to Dashboard</a>";
        echo "</div>";
    } else {
        echo "<div class='container text-center mt-5'>";
        echo "<h1 class='text-danger'>Error</h1>";
        echo "<p>Something went wrong: " . htmlspecialchars($conn->error) . "</p>";
        echo "<a href='dashboard.php' class='btn btn-primary'>Go Back to Dashboard</a>";
        echo "</div>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "<div class='container text-center mt-5'>";
    echo "<h1 class='text-danger'>Invalid Request</h1>";
    echo "<p>This page can only be accessed through the appropriate form submission.</p>";
    echo "<a href='dashboard.php' class='btn btn-primary'>Go Back to Dashboard</a>";
    echo "</div>";
}

// Include the footer
include 'includes/footer.php';
?>
