<?php
session_start();
include 'db.php';

$action = $_POST['action'] ?? null;

if ($action === 'register') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: index.php");
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['error'] = "Registration successful! Please log in.";
    } else {
        $_SESSION['error'] = "Username already exists!";
    }
    $stmt->close();
    header("Location: index.php");
    exit;

} elseif ($action === 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        header("Location: dashboard.php");
    } else {
        $_SESSION['error'] = "Invalid credentials!";
        header("Location: index.php");
    }
    $stmt->close();
    exit;

} elseif ($action === 'mark_attendance') {
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("INSERT INTO attendance (user_id) VALUES (?)");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    $_SESSION['error'] = "Attendance marked successfully!";
    header("Location: dashboard.php");
    exit;
}
?>