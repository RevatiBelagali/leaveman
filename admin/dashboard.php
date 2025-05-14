<?php include('../includes/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Leave Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../includes/styles.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Leave Manager</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="manage_leaves.php">Manage Leaves</a></li>
        <li class="nav-item"><a class="nav-link" href="add_employee.php">Add Employee</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>
  
  <div class="container mt-5">
    <div class="card">
      <h5 class="card-header">Admin Dashboard</h5>
      <div class="card-body">
        <p class="card-text">Welcome, Admin! You can manage employee leaves and add new employees from here.</p>
        <a href="manage_leaves.php" class="btn btn-primary">View Leave Requests</a>
      </div>
    </div>
  </div>
</body>
</html>
