<?php
session_start();
include('../includes/db.php');

include '../includes/functions.php';

if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit();
}

$emp_id = $_SESSION['emp_id'];
$employee = getEmployeeById($emp_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
    <style>
        body {
            background: #121212;
            color: white;
            font-family: Arial, sans-serif;
        }
        .dashboard {
            width: 400px;
            margin: 80px auto;
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        h2 {
            margin-bottom: 10px;
        }
        .info {
            font-size: 18px;
            margin: 10px 0;
        }
        a {
            color: #007bff;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h2>Welcome, <?= htmlspecialchars($employee['emp_name']) ?></h2>
        <div class="info">Department: <?= htmlspecialchars($employee['emp_dept']) ?></div>
        <div class="info">Leave Balance: <strong><?= (int)$employee['leave_balance'] ?></strong></div>
        <a href="request_leave.php">Apply for Leave</a>
    </div>
</body>
</html>
