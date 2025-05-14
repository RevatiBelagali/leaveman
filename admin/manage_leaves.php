<?php include('../includes/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Leaves - Leave Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../includes/styles.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Leave Manager</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="add_employee.php">Add Employee</a></li>
        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>
  
  <div class="container mt-5">
    <h2>Manage Leave Requests</h2>
    <div class="list-group">
      <?php
      $leaveRequests = getLeaveRequests();
      foreach ($leaveRequests as $leave) {
        echo "<div class='list-group-item'>";
        echo "<h5>{$leave['leave_type']} Leave</h5>";
        echo "<p>From: {$leave['from_date']} To: {$leave['to_date']}</p>";
        echo "<p>Status: <span class='badge badge-status badge-{$leave['status']}'>" . ucfirst($leave['status']) . "</span></p>";
        echo "<a href='approve_leave.php?id={$leave['id']}' class='btn btn-success'>Approve</a>";
        echo "<a href='reject_leave.php?id={$leave['id']}' class='btn btn-danger'>Reject</a>";
        echo "</div>";
      }
      ?>
    </div>
  </div>
</body>
</html>
