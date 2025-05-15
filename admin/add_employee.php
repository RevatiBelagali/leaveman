<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['emp_name'];
    $email = $_POST['emp_email'];
    $password = password_hash($_POST['emp_password'], PASSWORD_DEFAULT);
    $dept = $_POST['emp_dept'];

    $stmt = $conn->prepare("INSERT INTO employee (emp_name, emp_email, emp_password, emp_dept) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $dept);

    if ($stmt->execute()) {
        $message = "Employee added successfully.";
    } else {
        $message = "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background: #121212;
            color: white;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #222;
            padding: 10px;
        }
        .navbar a {
            color: #00e6e6;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 500px;
            margin: 30px auto;
            background-color: #222;
            padding: 20px;
            border-radius: 8px;
        }
        .back-button {
            margin-bottom: 15px;
        }
        .back-button a {
            background-color: #444;
            color: #00e6e6;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            display: inline-block;
        }
        .back-button a:hover {
            background-color: #333;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 16px;
            border: none;
            border-radius: 4px;
        }
        button {
            background-color: #ffc107;
            color: black;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #e0a800;
        }
        p {
            margin-top: -10px;
            margin-bottom: 10px;
            color: #4CAF50;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="dashboard.php">Dashboard</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <div class="back-button">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>

    <h2>Add Employee</h2>
    
    <?php if ($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>
    
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="emp_name" required>
        
        <label>Email:</label>
        <input type="email" name="emp_email" required>
        
        <label>Password:</label>
        <input type="password" name="emp_password" required>
        
        <label>Department:</label>
        <input type="text" name="emp_dept" required>
        
        <button type="submit">Add Employee</button>
    </form>
</div>

</body>
</html>
