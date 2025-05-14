<?php
session_start();
include('../includes/db.php');
include('../includes/functions.php');

// Check if the employee is logged in
if (!isset($_SESSION['employee_id'])) {
    header('Location: login.php');
    exit();
}

$employee_id = $_SESSION['employee_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $leave_type = $_POST['leave_type'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $reason = $_POST['reason'];

    // Insert leave request into the database
    $stmt = $conn->prepare("INSERT INTO employee_leave (emp_id, leave_type, from_date, to_date, reason) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('issss', $employee_id, $leave_type, $from_date, $to_date, $reason);
    $stmt->execute();

    echo "<script>alert('Leave request submitted successfully!'); window.location.href = 'dashboard.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Leave - Leave Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #121212;
            color: white;
        }
        .card {
            background: #1c1c1c;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="my-4 text-center">Request Leave</h2>

        <div class="card">
            <form action="request_leave.php" method="POST">
                <div class="mb-3">
                    <label for="leave_type" class="form-label">Leave Type</label>
                    <select class="form-select" id="leave_type" name="leave_type" required>
                        <option value="Sick Leave">Sick Leave</option>
                        <option value="Casual Leave">Casual Leave</option>
                        <option value="Earned Leave">Earned Leave</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="from_date" class="form-label">From Date</label>
                    <input type="date" class="form-control" id="from_date" name="from_date" required>
                </div>

                <div class="mb-3">
                    <label for="to_date" class="form-label">To Date</label>
                    <input type="date" class="form-control" id="to_date" name="to_date" required>
                </div>

                <div class="mb-3">
                    <label for="reason" class="form-label">Reason</label>
                    <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100">Submit Leave Request</button>
            </form>
        </div>
    </div>
</body>
</html>
