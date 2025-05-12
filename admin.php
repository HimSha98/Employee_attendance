<?php
session_start(); // Start session

// Check if the user is logged in as admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to the admin login page
    header("Location: admin_login.php");
    exit;
}

include 'database/db.php'; // Include database connection
?>
<?php include 'includes/header.php'; ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Employee Attendance Records</h1>
        <!-- Logout Button -->
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <hr>
    <h1 class="text-center mb-4">Employee Attendance Records</h1>

    <!-- Filter Form -->
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="month" class="form-label">Month</label>
                <select id="month" name="month" class="form-select">
                    <option value="">All Months</option>
                    <?php
                    for ($m = 1; $m <= 12; $m++) {
                        $monthName = date('F', mktime(0, 0, 0, $m, 10));
                        $selected = (isset($_GET['month']) && $_GET['month'] == $m) ? 'selected' : '';
                        echo "<option value='$m' $selected>$monthName</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="day" class="form-label">Day</label>
                <select id="day" name="day" class="form-select">
                    <option value="">All Days</option>
                    <?php
                    $daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    foreach ($daysOfWeek as $index => $day) {
                        $selected = (isset($_GET['day']) && $_GET['day'] == $day) ? 'selected' : '';
                        echo "<option value='$day' $selected>$day</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="date" class="form-label">Specific Date</label>
                <div class="input-group">
                    <input type="date" id="date" name="date" value="<?php echo $_GET['date'] ?? ''; ?>" class="form-control">
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('date').value = '';">Clear</button>
                </div>
            </div>

            <div class="col-md-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $_GET['username'] ?? ''; ?>" class="form-control" placeholder="Enter Username">
            </div>
        </div>
        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <!-- Attendance Table -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Employee ID</th>
            <th>Username</th>
            <th>Date</th>
            <th>Day</th>
            <th>Check-In Time</th>
            <th>Check-Out Time</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Build Query Based on Filters
        $filters = [];
        if (!empty($_GET['month'])) {
            $filters[] = "MONTH(check_in_time) = " . intval($_GET['month']);
        }
        if (!empty($_GET['day'])) {
            $filters[] = "DAYNAME(check_in_time) = '" . $conn->real_escape_string($_GET['day']) . "'";
        }
        if (!empty($_GET['date'])) {
            $filters[] = "DATE(check_in_time) = '" . $_GET['date'] . "'";
        }
        if (!empty($_GET['username'])) {
            $username = $conn->real_escape_string($_GET['username']);
            $filters[] = "username = '$username'";
        }

        $filterQuery = !empty($filters) ? "WHERE " . implode(' AND ', $filters) : "";

        // Fetch Attendance Records
        $query = "SELECT user_id, username, 
                  DATE(check_in_time) AS date, 
                  DAYNAME(check_in_time) AS day, 
                  check_in_time, 
                  check_out_time
                  FROM attendance
                  $filterQuery
                  ORDER BY check_in_time DESC";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['user_id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['date']}</td>
                        <td>{$row['day']}</td>
                        <td>{$row['check_in_time']}</td>
                        <td>{$row['check_out_time']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>No records found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<?php include 'includes/footer.php'; ?>