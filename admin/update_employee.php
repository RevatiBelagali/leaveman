<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include '../db_connect.php';

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['emp_id'];
    $name = $_POST['emp_name'];
    $email = $_POST['emp_email'];
    $dept = $_POST['emp_dept'];

    $stmt = $conn->prepare("UPDATE employee SET emp_name = ?, emp_email = ?, emp_dept = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $dept, $id);

    if ($stmt->execute()) {
        $success = "Employee updated successfully.";
    } else {
        $error = "Update failed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Update Employee</title>
    <style>
        body {
            background: #121212;
            color: white;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #222;
            padding: 20px;
            border-radius: 8px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }
        button {
            background: #ffc107;
            color: black;
            padding: 12px;
            border: none;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #e0a800;
        }
        .success {
            color: #4CAF50;
            margin-top: 10px;
        }
        .error {
            color: #f44336;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Employee Details</h2>
        <form method="post">
            <input type="number" name="emp_id" placeholder="Employee ID" required />
            <input type="text" name="emp_name" placeholder="Name" required />
            <input type="email" name="emp_email" placeholder="Email" required />
            <input type="text" name="emp_dept" placeholder="Department" required />
            <button type="submit">Update Employee</button>
        </form>

        <?php if ($success): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
