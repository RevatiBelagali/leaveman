<?php
session_start();
include('../includes/db.php');
include('../includes/functions.php');

// Check if the employee is logged in
if (!isset($_SESSION['emp_id'])) {
    header('Location: login.php');
    exit();
}

$employee_id = $_SESSION['emp_id'];

// Get employee details
$employee = $conn->query("SELECT * FROM employee WHERE id = $employee_id")->fetch_assoc();

// Get leave balance
$leave_balance = 10; // Example: Total leave balance (can be updated based on your system)

// Get employee leave requests and their status
$leave_requests = $conn->query("SELECT * FROM employee_leave WHERE emp_id = $employee_id");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Dashboard - Leave Manager</title>
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
        .btn {
            width: 100%;
            margin-top: 15px;
        }
        table {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="my-4 text-center">Welcome, <?php echo $employee['emp_name']; ?></h2>

        <div class="card">
            <h3 class="text-center">Leave Balance: <?php echo $leave_balance; ?> Days</h3>
            <a href="request_leave.php" class="btn btn-warning">Apply for Leave</a>
        </div>

        <div class="card mt-4">
            <h4 class="text-center">Leave Requests Status</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Leave Type</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($leave = $leave_requests->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $leave['leave_type']; ?></td>
                            <td><?php echo $leave['from_date']; ?></td>
                            <td><?php echo $leave['to_date']; ?></td>
                            <td>
                                <?php echo $leave['status'] == 'Pending' ? 'Pending' : ($leave['status'] == 'Approved' ? 'Approved' : 'Rejected'); ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
