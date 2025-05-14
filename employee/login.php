<?php
session_start();
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = md5($_POST["password"]); // Assuming you're using MD5 for password hashing

    // Check if the user exists in the database
    $query = "SELECT * FROM employee WHERE emp_email = ? AND emp_password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION["emp_id"] = $user["id"];
        $_SESSION["emp_name"] = $user["emp_name"];
        $_SESSION["emp_email"] = $user["emp_email"];
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Invalid email or password!";
    }
}
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
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?= $error_message ?></div>
    <?php endif; ?>
    <form method="POST" action="">
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
