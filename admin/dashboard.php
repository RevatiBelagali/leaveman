<!-- /var/www/html/leavemanager/admin/dashboard.php -->
<?php
session_start();
require_once "../includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Leave Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f4f4;
    }
    .container {
      margin-top: 60px;
    }
    .card {
      border-radius: 15px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Admin Dashboard</a>
      <span class="navbar-text text-white">Welcome, Admin</span>
    </div>
  </nav>

  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card text-bg-primary">
          <div class="card-body">
            <h5 class="card-title">Manage Leaves</h5>
            <p class="card-text">Review and approve/reject leave requests.</p>
            <a href="manage_leaves.php" class="btn btn-light">Go</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card text-bg-success">
          <div class="card-body">
            <h5 class="card-title">Add Employee</h5>
            <p class="card-text">Register a new employee into the system.</p>
            <a href="add_employee.php" class="btn btn-light">Add</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card text-bg-warning">
          <div class="card-body">
            <h5 class="card-title">View Employees</h5>
            <p class="card-text">See all registered employees (optional).</p>
            <a href="#" class="btn btn-light disabled">Coming Soon</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
