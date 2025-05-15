<?php
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['emp_name']);
    $email = trim($_POST['emp_email']);
    $password = md5($_POST['emp_password']);  // You might consider using password_hash in future
    $dept = trim($_POST['emp_dept']);
    $balance = 10;

    $stmt = $conn->prepare("INSERT INTO employee (emp_name, emp_email, emp_password, emp_dept, leave_balance) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $name, $email, $password, $dept, $balance);

    if ($stmt->execute()) {
        $success = "✅ Registered successfully";
    } else {
        $error = "❌ Registration failed. Email might already exist.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            background: #121212;
            color: white;
            font-family: Arial, sans-serif;
        }
        .form-box {
            max-width: 400px;
            margin: 80px auto;
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }
        button, .nav-btn {
            background: #007bff;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            text-align: center;
            text-decoration: none;
            margin-top: 10px;
            font-weight: bold;
        }
        button:hover, .nav-btn:hover {
            background: #0056b3;
        }
        .msg {
            margin-top: 10px;
            color: #28a745;
        }
        .msg.error {
            color: #ff4d4d;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Register</h2>
        <form method="post">
            <input type="text" name="emp_name" placeholder="Name" required />
            <input type="email" name="emp_email" placeholder="Email" required />
            <input type="password" name="emp_password" placeholder="Password" required />
            <input type="text" name="emp_dept" placeholder="Department" required />
            <button type="submit">Register</button>
        </form>

        <!-- ✅ Navigation Buttons -->
        <a class="nav-btn" href="../index.php">← Back to Home</a>
        <a class="nav-btn" href="login.php">🔐 Go to Login</a>

        <div class="msg <?= isset($error) ? 'error' : '' ?>">
            <?php if (isset($success)) echo $success; ?>
            <?php if (isset($error)) echo $error; ?>
        </div>
    </div>
</body>
</html>
