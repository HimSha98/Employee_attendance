<?php
include 'database/db.php';
session_start();

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$filters = [
    'day' => $_GET['day'] ?? null,
    'date' => $_GET['date'] ?? null,
    'year' => $_GET['year'] ?? null,
];

// Build query dynamically based on filters
$query = "SELECT * FROM attendance WHERE user_id = ?";
$params = [$user_id];
$types = "i";

if ($filters['day']) {
    $query .= " AND DAYNAME(date) = ?";
    $params[] = $filters['day'];
    $types .= "s";
}
if ($filters['date']) {
    $query .= " AND DATE(date) = ?";
    $params[] = $filters['date'];
    $types .= "s";
}
if ($filters['year']) {
    $query .= " AND YEAR(date) = ?";
    $params[] = $filters['year'];
    $types .= "i";
}

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
$attendance_records = $result->fetch_all(MYSQLI_ASSOC);
?>

<?php include 'includes/header.php'; ?>
<div class="container">
    <h1 class="mt-4">My Attendance</h1>
    <form class="row g-3 my-4">
        <div class="col-md-3">
            <label for="day" class="form-label">Filter by Day</label>
            <select id="day" name="day" class="form-select">
                <option value="">Select Day</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="date" class="form-label">Filter by Date</label>
            <input type="date" id="date" name="date" class="form-control">
        </div>
        <div class="col-md-3">
            <label for="year" class="form-label">Filter by Year</label>
            <input type="number" id="year" name="year" class="form-control" placeholder="2025">
        </div>
        <div class="col-md-3 align-self-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Day</th>
                <th>Check-In Time</th>
                <th>Check-Out Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attendance_records as $record): ?>
                <tr>
                    <td><?= htmlspecialchars($record['date']); ?></td>
                    <td><?= htmlspecialchars(date('l', strtotime($record['date']))); ?></td>
                    <td><?= htmlspecialchars($record['check_in_time'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($record['check_out_time'] ?? 'N/A'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include 'includes/footer.php'; ?>
