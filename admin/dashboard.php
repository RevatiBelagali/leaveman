<?php include('../includes/db.php'); ?>
<?php include('../includes/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Admin Dashboard</h2>

        <h4>Total Employees</h4>
        <?php
            $employees = getAllEmployees();
            echo count($employees);
        ?>

        <h4>Pending Leave Requests</h4>
        <?php
            $leaveRequests = getLeaveRequests();
            echo count(array_filter($leaveRequests, fn($request) => $request['status'] === 'pending'));
        ?>
    </div>
</body>
</html>
