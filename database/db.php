<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'employee_db';

// CREATE CONNECTION
$conn = new mysqli($host, $username, $password, $dbname);

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set timezone globally for PHP
date_default_timezone_set('Asia/Kolkata'); // Replace with your desired timezone

// Set timezone globally for MySQL
$conn->query("SET time_zone = '+05:30'"); // Replace '+05:30' with your timezone offset
?>