<?php
include 'db.php';

// SQL to create the 'users' table
$users_table = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($users_table) === TRUE) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating 'users' table: " . $conn->error . "<br>";
}

// SQL to create the 'attendance' table
$attendance_table = "CREATE TABLE IF NOT EXISTS attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    marked_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)";

if ($conn->query($attendance_table) === TRUE) {
    echo "Table 'attendance' created successfully.<br>";
} else {
    echo "Error creating 'attendance' table: " . $conn->error . "<br>";
}

$conn->close();
?>
