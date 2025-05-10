<?php
include 'database/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $date = date('Y-m-d');
    $time = date('Y-m-d H:i:s');

    if ($type === 'check_in') {
        $query = "INSERT INTO attendance (user_id, username, check_in_time, date) VALUES (?, ?, ?, ?)";
    } else {
        $query = "UPDATE attendance SET check_out_time = ? WHERE user_id = ? AND date = ?";
    }

    $stmt = $conn->prepare($query);

    if ($type === 'check_in') {
        $stmt->bind_param("isss", $user_id, $username, $time, $date);
    } else {
        $stmt->bind_param("sis", $time, $user_id, $date);
    }

    if ($stmt->execute()) {
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>