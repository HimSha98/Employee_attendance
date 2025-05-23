<?php
include 'database/db.php';
session_start();

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['user_id']); // Check if the session exists

$user_id = $isLoggedIn ? $_SESSION['user_id'] : null;
$username = $isLoggedIn ? htmlspecialchars($_SESSION['username']) : "Guest";
$date = date('Y-m-d');

// Retrieve attendance data if logged in
if ($isLoggedIn) {
    $query = "SELECT * FROM attendance WHERE user_id = ? AND date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $user_id, $date);
    $stmt->execute();
    $result = $stmt->get_result();
    $attendance = $result->fetch_assoc();
} else {
    $attendance = null;
}
?>

<?php include 'includes/header.php'; ?>
<div class="container">
    <div class="row d-flex justify-content-center min-vh-100">
        <div class="col-3"></div>
        <div class="col-6 my-5">
            <!-- <h1 class="text-center text-dark">Welcome, <span class="text-uppercase"><?= $username; ?></span></h1> -->
            <!-- <div class="attendance-mark-container rounded-2 p-4 mt-4 position-relative">
                <?php if (!$isLoggedIn): ?>
                    <p class="text-danger">You are logged out. Please log in again to mark your attendance.</p>
                <?php else: ?>
                    <?php if ($isLoggedIn && !$attendance): ?>
                        <form action="mark_attendance.php" method="POST" class="attendance_form mt-4">
                            <h4 class="text-dark">Happy Good Morning <i class="text-uppercase"><?= $username; ?></i></h4>
                            <h5 class="text-dark check-head">Dear Sir, Register Your Check-In Time:</h5>
                            <input type="hidden" name="type" value="check_in">
                            <button class="btn btn-sm btn-success p-3 py-2 w-25 mt-3" type="submit">Check In</button>
                        </form>
                    <?php //endif; ?>
                    <?php elseif (!$attendance['check_out_time']): ?>
                        <form action="mark_attendance.php" method="POST" class="attendance_form mt-4">
                            <h5 class="text-dark check-head">Dear Sir, Register Your Check-Out Time:</h5>
                            <input type="hidden" name="type" value="check_out">
                            <button class="btn btn-sm btn-warning p-3 py-2 w-25 mt-3" type="submit">Check Out</button>
                        </form>
                    <?php else: ?>
                        <h4 class="text-dark">Goodbye! Stay Blessed <i class="text-uppercase"><?= $username; ?></i></h4>
                        <p>Attendance already marked for today!</p>
                    <?php endif; ?>
                <?php endif; ?>
                <a href="logout.php" class="mt-1 me-2 position-absolute top-0 end-0">
                    <i class="fa-solid fa-power-off text-danger fs-5" title="LOGGED OUT"></i>
                </a>
            </div> -->
            <div class="attendance-mark-container rounded-2 p-4 mt-4 position-relative">
    <?php if (!$isLoggedIn): ?>
        <p class="text-danger">You are logged out. Please log in again to mark your attendance.</p>
    <?php else: ?>
        <?php if ($isLoggedIn && !$attendance): ?>
            <form action="mark_attendance.php" method="POST" class="attendance_form mt-4">
                <h4 class="text-white">Happy Good Morning <i class="text-uppercase"><?= $username; ?></i></h4>
                <h5 class="text-white check-head">Dear Sir, Register Your Check-In Time:</h5>
                <input type="hidden" name="type" value="check_in">
                <button class="btn btn-sm btn-success p-3 py-2 w-25 mt-3" type="submit">Check In</button>
            </form>
        <?php elseif (!$attendance['check_out_time']): ?>
            <form action="mark_attendance.php" method="POST" class="attendance_form mt-4">
                <h5 class="text-white check-head">Dear Sir, Register Your Check-Out Time:</h5>
                <input type="hidden" name="type" value="check_out">
                <button class="btn btn-sm btn-warning p-3 py-2 w-25 mt-3" type="submit">Check Out</button>
            </form>
        <?php else: ?>
            <h4 class="text-white">Goodbye! Stay Blessed <i class="text-uppercase"><?= $username; ?></i></h4>
            <p>Attendance already marked for today!</p>
        <?php endif; ?>
        <!-- Add View Attendance Button -->
        <a href="my_attendance.php" class="btn btn-primary mt-4">View Attendance</a>
    <?php endif; ?>
    <a href="logout.php" class="mt-1 me-2 position-absolute top-0 end-0">
        <i class="fa-solid fa-power-off text-danger fs-5" title="LOGGED OUT"></i>
    </a>
</div>

        </div>
        <div class="col-3"></div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>