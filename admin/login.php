<?php
session_start();
require_once "../includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - Leave Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #1c1c1c; /* Dark background */
      color: #f8f9fa; /* Light text */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-box {
      background: #333; /* Darker card background */
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      width: 400px;
    }

    .login-box h3 {
      color: #f8f9fa;
    }

    .form-label {
      color: #ddd;
    }

    .form-control {
      background-color: #444; /* Dark form fields */
      border: 1px solid #555; /* Lighter border */
      color: #f8f9fa; /* Light text */
    }

    .btn-primary {
      background-color: #007bff; /* Blue button */
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3; /* Darker blue on hover */
    }

    .alert {
      background-color: #e74c3c;
      color: white;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h3 class="text-center mb-4">Admin Login</h3>
    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <form method="POST" action="dashboard.php">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</body>
</html>
