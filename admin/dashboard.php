<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard - Leave Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background: #121212; color: white; }
    .container { margin-top: 50px; max-width: 600px; }
    .btn { margin-bottom: 15px; width: 100%; }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mb-4 text-center">Admin Dashboard</h2>

    <a href="add_employee.php" class="btn btn-primary">Add New Employee</a>
    <a href="update_employee.php" class="btn btn-warning">Update Employee Details</a>
    <a href="manage_leaves.php" class="btn btn-success">View Leave Requests</a>
  </div>
</body>
</html>
