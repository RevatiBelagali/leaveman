<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['emp_name'];
    $email = $_POST['emp_email'];
    $password = md5($_POST['emp_password']);
    $leave_balance = 10; // initial leave balance

    // Insert new employee
    $stmt = $conn->prepare("INSERT INTO employee (emp_name, emp_email, emp_password, leave_balance) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $email, $password, $leave_balance);

    if ($stmt->execute()) {
        $success = "Employee added successfully!";
    } else {
        $error = "Error adding employee: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Employee - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>body {background:#121212;color:white;} .container { margin-top:50px; }</style>
</head>
<body>
  <div class="container">
    <h2>Add New Employee</h2>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Employee Name</label>
        <input type="text" name="emp_name" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="emp_email" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="emp_password" class="form-control" required />
      </div>
      <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>
  </div>
</body>
</html>
