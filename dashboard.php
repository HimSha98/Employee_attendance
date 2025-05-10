<?php
include 'database/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$date = date('Y-m-d');

$query = "SELECT * FROM attendance WHERE user_id = ? AND date = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $user_id, $date);
$stmt->execute();
$result = $stmt->get_result();
$attendance = $result->fetch_assoc();

?>

<?php include 'includes/header.php'; ?>
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-3"></div>
            <div class="col-6 my-5">
                <h1 class="text-center">Welcome, <span class="text-uppercase"><?= $_SESSION['username']; ?></span></h1>
                <div class="attendance-mark-container border-1 rounded-2 border-light bg-white p-3 position-relative">
                    <?php if (!$attendance): ?>
                        <form action="mark_attendance.php" method="POST" class="attendance_form mt-4">
                            <div class="">
                                <h4 class="text-dark">Happy Good Morning  <i class="text-uppercase"><?= $_SESSION['username']; ?></i></h4>
                                <h5 class="text-dark check-head">
                                    Dear Sir, Register Your Check-In Time :
                                </h5>
                                <input type="hidden" name="type" value="check_in">
                                <button class="btn btn-sm btn-success p-3 py-2 w-25 mt-3" type="submit">Check In</button>
                            </div>
                        </form>
                    <?php elseif (!$attendance['check_out_time']): ?>
                        <form action="mark_attendance.php" method="POST" class="attendance_form mt-4">
                            <div class="">
                                <h5 class="text-dark check-head">
                                    Dear Sir, Register Your Check-Out Time :
                                </h5>
                                <input type="hidden" name="type" value="check_out">
                                <button class="btn btn-sm btn-warning p-3 py-2 w-25 mt-3" type="submit">Check Out</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <h4 class="text-dark">Good Bye Stay Blessed  <i class="text-uppercase"><?= $_SESSION['username']; ?></i></h4>
                        <p>Attendance already marked for today!</p>
                    <?php endif; ?>
                    <a href="logout.php" class="mt-1 me-2 position-absolute top-0 end-0"><i class="fa-solid fa-power-off text-danger fs-5" title="LOGGED OUT"></i></a>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
<?php include 'includes/footer.php'; ?>