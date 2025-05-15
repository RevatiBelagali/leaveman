<?php
session_start();
include('../includes/db.php');
include('../includes/functions.php');

// Check if employee is logged in
if (!isset($_SESSION['emp_id'])) {
    header('Location: login.php');
    exit();
}

$employee_id = $_SESSION['emp_id'];

// Fetch employee details
$employee = $conn->query("SELECT * FROM employee WHERE id = $employee_id")->fetch_assoc();

// Fetch current leave balance
$leave_balance = $employee['leave_balance'] ?? 0;

// Fetch leave requests for this employee
$leave_requests = $conn->query("SELECT * FROM employee_leave WHERE emp_id = $employee_id ORDER BY from_date DESC");
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
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }
        table {
            color: white;
        }
        thead th {
            border-bottom: 1px solid #444;
        }
        tbody tr:hover {
            background-color: #333;
        }
        a.btn-warning {
            color: #000;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h2 class="mb-4 text-center">Welcome, <?php echo htmlspecialchars($employee['emp_name']); ?></h2>

        <div class="card text-center">
            <h3>Leave Balance: <span style="color:#ffd700;"><?php echo $leave_balance; ?> Days</span></h3>
            <a href="request_leave.php" class="btn btn-warning mt-3">Apply for Leave</a>
        </div>

        <div class="card mt-5">
            <h4 class="text-center mb-4">Leave Requests Status</h4>
            <div class="table-responsive">
                <table class="table table-dark table-striped text-center">
                    <thead>
                        <tr>
                            <th>Leave Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($leave_requests->num_rows > 0): ?>
                            <?php while ($leave = $leave_requests->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($leave['leave_type']); ?></td>
                                    <td><?php echo htmlspecialchars($leave['from_date']); ?></td>
                                    <td><?php echo htmlspecialchars($leave['to_date']); ?></td>
                                    <td>
                                        <?php 
                                            $status = $leave['status'];
                                            if ($status == 'Pending') {
                                                echo '<span style="color:#ffc107;">Pending</span>';
                                            } elseif ($status == 'Approved') {
                                                echo '<span style="color:#28a745;">Approved</span>';
                                            } else {
                                                echo '<span style="color:#dc3545;">Rejected</span>';
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No leave requests found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
