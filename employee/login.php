<!-- /var/www/html/leavemanager/employee/login.php -->
<?php
session_start();
require_once "../includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Login - Leave Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f8f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-box {
      background: white;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      width: 400px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h3 class="text-center mb-4">Employee Login</h3>
    <form method="POST" action="dashboard.php">
      <div class="mb-3">
        <label class="form-label">Email / Username</label>
        <input type="text" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-success w-100">Login</button>
    </form>
  </div>
</body>
</html>
