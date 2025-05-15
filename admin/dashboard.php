<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';
require_once '../includes/functions.php';
$employees = getAllEmployees();
$leave_requests = getLeaveRequests();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
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
    <table border="1" width="100%">
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Dept</th><th>Leave Balance</th></tr>
        <?php foreach ($employees as $emp): ?>
        <tr>
            <td><?= $emp['id'] ?></td>
            <td><?= $emp['emp_name'] ?></td>
            <td><?= $emp['emp_email'] ?></td>
            <td><?= $emp['emp_dept'] ?></td>
            <td><?= $emp['leave_balance'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h3>Pending Leave Requests</h3>
    <table border="1" width="100%">
        <tr><th>Emp Name</th><th>Type</th><th>From</th><th>To</th><th>Status</th></tr>
        <?php foreach ($leave_requests as $leave): ?>
        <tr>
            <td><?= $leave['emp_name'] ?></td>
            <td><?= $leave['leave_type'] ?></td>
            <td><?= $leave['from_date'] ?></td>
            <td><?= $leave['to_date'] ?></td>
            <td><?= $leave['status'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
