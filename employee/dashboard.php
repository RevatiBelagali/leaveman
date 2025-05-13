<?php include('../includes/db.php'); ?>
<?php include('../includes/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Employee Dashboard</h2>

        <h4>Leave Balance</h4>
        <?php
            // Assume the employee is logged in, with ID 1 (for now)
            $employee_id = 1;
            // Query to get leave balance (remaining leaves, etc.)
            $sql = "SELECT * FROM employees WHERE id = $employee_id";
            $result = $conn->query($sql);
            $employee = $result->fetch_assoc();
            echo "Remaining Leaves: " . $employee['leave_balance'];
        ?>
    </div>
</body>
</html>
