<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}
include('../includes/db.php');

include '../includes/functions.php';

$employees = getAllEmployees();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin Dashboard</title>
<style>
    body { background: #121212; color: white; font-family: Arial, sans-serif; margin: 0; }
    header { padding: 20px; background: #1f1f1f; text-align: center; font-size: 24px; }
    table { width: 90%; margin: 20px auto; border-collapse: collapse; }
    th, td { padding: 12px; border: 1px solid #333; text-align: left; }
    th { background: #222; }
    tr:nth-child(even) { background: #1a1a1a; }
    a.button { padding: 8px 12px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
    a.button:hover { background: #0056b3; }
</style>
</head>
<body>
<header>Admin Dashboard</header>

<div style="width: 90%; margin: auto; text-align: right;">
    <a href="add_employee.php" class="button">Add Employee</a>
    <a href="manage_leaves.php" class="button">Manage Leaves</a>
    <a href="logout.php" class="button" style="background:#b33030;">Logout</a>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Leave Balance</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($employees as $emp): ?>
        <tr>
            <td><?= htmlspecialchars($emp['id']) ?></td>
            <td><?= htmlspecialchars($emp['emp_name']) ?></td>
            <td><?= htmlspecialchars($emp['emp_email']) ?></td>
            <td><?= htmlspecialchars($emp['emp_dept']) ?></td>
            <td><?= htmlspecialchars($emp['leave_balance']) ?></td>
            <td><?= htmlspecialchars($emp['created_at']) ?></td>
            <td><a href="update_employee.php?id=<?= $emp['id'] ?>" class="button">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
