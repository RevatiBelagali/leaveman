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
      background: #121212; /* Dark background */
      color: white; /* White text for contrast */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background: #333; /* Dark background for the form */
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      width: 400px;
    }

    .login-box h3 {
      color: #f1f1f1; /* Light heading */
    }

    .form-label {
      color: #f1f1f1; /* Light labels */
    }

    .form-control {
      background: #444; /* Dark input fields */
      color: white; /* White text inside input fields */
      border: 1px solid #555; /* Slightly lighter border */
    }

    .form-control:focus {
      background-color: #555; /* Darker focus state */
      border-color: #008c76; /* Highlight border on focus */
    }

    .btn {
      background-color: #008c76; /* Attractive button color */
      border: none;
      padding: 12px;
      width: 100%;
    }

    .btn:hover {
      background-color: #006f5f; /* Darker shade on hover */
    }

    .alert {
      background-color: #ff4d4d; /* Red alert box */
      color: white;
      border-radius: 10px;
      margin-bottom: 15px;
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
      <button type="submit" class="btn">Login</button>
    </form>
  </div>
</body>
</html>
