<?php include('../includes/db.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Employee Dashboard</h2>
        <?php
            $emp_id = 1; // Simulated login
            $sql = "SELECT * FROM employee WHERE id = $emp_id";
            $result = $conn->query($sql);
            $employee = $result->fetch_assoc();
            echo "<h4>Welcome, " . $employee['emp_name'] . "</h4>";
            echo "<p>Department: " . $employee['emp_dept'] . "</p>";
        ?>
    </div>
</body>
</html>
