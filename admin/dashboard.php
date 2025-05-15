<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Fetch employees and leave requests
$employees = getAllEmployees();
$leave_requests = getLeaveRequests();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .navbar { background: #333; color: white; padding: 15px; display: flex; justify-content: space-between; }
        .navbar .nav-links a { color: white; margin-left: 20px; text-decoration: none; }
        .container { padding: 30px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 40px; background: white; }
        th, td { padding: 12px; text-align: left; border: 1px solid #ddd; }
        th { background-color: #007bff; color: white; }
    </style>
</head>
<body>

<div class="navbar">
    <div class="logo">Admin Panel</div>
    <div class="nav-links">
        <a href="add_employee.php">➕ Add Employee</a>
        <a href="manage_leaves.php">📋 Manage Leaves</a>
        <a href="logout.php">🚪 Logout</a>
    </div>
</div>

<div class="container">
    <h2>Welcome, Admin</h2>

    <h3>All Employees</h3>
    <?php if (!empty($employees)): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Dept</th>
            <th>Leave Balance</th>
        </tr>
        <?php foreach ($employees as $emp): ?>
        <tr>
            <td><?= htmlspecialchars($emp['id']) ?></td>
            <td><?= htmlspecialchars($emp['emp_name']) ?></td>
            <td><?= htmlspecialchars($emp['emp_email']) ?></td>
            <td><?= htmlspecialchars($emp['emp_dept']) ?></td>
            <td><?= htmlspecialchars($emp['leave_balance']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>No employees found.</p>
    <?php endif; ?>

    <h3>Pending Leave Requests</h3>
    <?php if (!empty($leave_requests)): ?>
    <table>
        <tr>
            <th>Emp Name</th>
            <th>Type</th>
            <th>From</th>
            <th>To</th>
            <th>Status</th>
        </tr>
        <?php foreach ($leave_requests as $leave): ?>
        <tr>
            <td><?= htmlspecialchars($leave['emp_name']) ?></td>
            <td><?= htmlspecialchars($leave['leave_type']) ?></td>
            <td><?= htmlspecialchars($leave['from_date']) ?></td>
            <td><?= htmlspecialchars($leave['to_date']) ?></td>
            <td><?= htmlspecialchars($leave['status']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>No leave requests available.</p>
    <?php endif; ?>
</div>

</body>
</html>
