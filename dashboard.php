<!-- <?php
// session_start();
// include 'db.php';

// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit;
// }
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
        // $user_id = $_SESSION['user_id'];
        // $result = $conn->query("SELECT marked_at FROM attendance WHERE user_id = $user_id ORDER BY marked_at DESC");
        // while ($row = $result->fetch_assoc()) {
        //     echo "<li>{$row['marked_at']}</li>";
        // }
        ?>
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html> -->

<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get today's date
$today = date("Y-m-d");

// Check if the user has already marked attendance today
$attendance_check_query = $conn->prepare("SELECT COUNT(*) as count FROM attendance WHERE user_id = ? AND DATE(marked_at) = ?");
$attendance_check_query->bind_param("is", $user_id, $today);
$attendance_check_query->execute();
$attendance_check_result = $attendance_check_query->get_result();
$attendance_data = $attendance_check_result->fetch_assoc();
$has_marked_attendance = $attendance_data['count'] > 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to your Dashboard</h1>

    <?php if ($has_marked_attendance): ?>
        <p>You have already marked your attendance for today.</p>
    <?php else: ?>
        <form action="process.php" method="POST">
            <input type="hidden" name="action" value="mark_attendance">
            <button type="submit">Mark Attendance</button>
        </form>
    <?php endif; ?>

    <h2>Your Attendance Records</h2>
    <ul>
        <?php
        $result = $conn->query("SELECT marked_at FROM attendance WHERE user_id = $user_id ORDER BY marked_at DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['marked_at']}</li>";
        }
        ?>
    </ul>

    <a href="logout.php">Logout</a>
</body>
</html>