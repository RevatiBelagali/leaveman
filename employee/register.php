<?php
include('../includes/db.php');

$name = $email = $password = $dept = "";
$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $dept = trim($_POST["dept"]);

    // Check if email already exists
    $check = $conn->prepare("SELECT * FROM employee WHERE emp_email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $error = "Email already registered!";
    } else {
        $hashedPassword = md5($password);
        $stmt = $conn->prepare("INSERT INTO employee (emp_name, emp_email, emp_password, emp_dept) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $dept);

        if ($stmt->execute()) {
            $success = "Registration successful! You can now <a href='login.php'>login</a>.";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Employee Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #121212;
      color: white;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .card {
      background: #1c1c1c;
      padding: 30px;
      border-radius: 15px;
      width: 100%;
      max-width: 450px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .btn {
      background-color: #007bff;
      color: white;
      width: 100%;
      margin-top: 15px;
      border: none;
      padding: 12px;
    }
    .btn:hover {
      background-color: #0056b3;
    }
    .form-label {
      font-weight: bold;
    }
    .alert {
      margin-bottom: 15px;
    }
    p {
      color: #ccc;
    }
  </style>
</head>
<body>
  <div class="card">
    <h3 class="mb-4 text-center">Employee Registration</h3>
    <?php if ($success): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" action="">
      <div class="mb-3 text-white">
        <label for="name" class="form-label text-white">Full Name</label>
        <input type="text" name="name" class="form-control text-white" required>
      </div>
      <div class="mb-3 text-white">
        <label for="email" class="form-label text-white">Email Address</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3 text-white">
        <label for="dept" class="form-label text-white">Department</label>
        <input type="text" name="dept" class="form-control text-white" required>
      </div>
      <div class="mb-3 text-white">
        <label for="password" class="form-label text-white">Password</label>
        <input type="password" name="password" class="form-control text-white" required>
      </div>
      <button type="submit" class="btn ">Register</button>
      <p class="mt-3 text-center text-white">Already registered? <a href="login.php" class="text-white">Login here</a></p>
    </form>
  </div>
</body>
</html>
