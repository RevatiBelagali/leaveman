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
    $name = trim($_POST['emp_name']);
    $email = trim($_POST['emp_email']);
    $password = md5(trim($_POST['emp_password'])); // Note: For production use password_hash()
    $dept = trim($_POST['emp_dept']);
    $leave_balance = 10; // Default leave balance

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM employee WHERE emp_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Employee with this email already exists.";
    } else {
        // Insert new employee
        $stmt = $conn->prepare("INSERT INTO employee (emp_name, emp_email, emp_password, emp_dept, leave_balance) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $name, $email, $password, $dept, $leave_balance);

        if ($stmt->execute()) {
            $success = "Employee added successfully.";
        } else {
            $error = "Failed to add employee.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <style>
        body {
            background: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 400px;
            margin: 60px auto;
            background-color: #1f1f1f;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        h2 {
            text-align: center;
            color: #00bcd4;
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background: #333;
            color: white;
        }
        input::placeholder {
            color: #aaa;
        }
        button {
            background-color: #00bcd4;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #0097a7;
        }
        .msg {
            margin-top: 15px;
            text-align: center;
        }
        .success {
            color: #4CAF50;
        }
        .error {
            color: #f44336;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Employee</h2>
        <form method="POST">
            <input type="text" name="emp_name" placeholder="Full Name" required />
            <input type="email" name="emp_email" placeholder="Email" required />
            <input type="password" name="emp_password" placeholder="Password" required />
            <input type="text" name="emp_dept" placeholder="Department" required />
            <button type="submit">Add Employee</button>
        </form>
        <div class="msg">
            <?php if (!empty($success)) echo "<div class='success'>$success</div>"; ?>
            <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
        </div>
    </div>
</body>
</html>
