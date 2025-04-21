<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to your Dashboard</h1>
    <form action="process.php" method="POST">
        <input type="hidden" name="action" value="mark_attendance">
        <button type="submit">Mark Attendance</button>
    </form>

    <h2>Your Attendance Records</h2>
    <ul>
        <?php
        $user_id = $_SESSION['user_id'];
        $result = $conn->query("SELECT marked_at FROM attendance WHERE user_id = $user_id ORDER BY marked_at DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['marked_at']}</li>";
        }
        ?>
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html>