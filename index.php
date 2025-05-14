<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Leave Manager - Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .card {
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .btn {
      width: 100%;
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="card text-center">
    <h2 class="mb-4">Welcome to Leave Manager</h2>
    <a href="admin/login.php" class="btn btn-primary">Admin Login</a>
    <a href="employee/login.php" class="btn btn-success">Employee Login</a>
    <a href="employee/register.php" class="btn btn-warning">New Employee? Register</a>
  </div>
</body>
</html>
