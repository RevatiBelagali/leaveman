<?php
session_start();
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // md5 as per your existing DB

    $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_email=? AND admin_password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Email or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Admin Login</title>
<style>
    body { background: #121212; color: white; font-family: Arial, sans-serif; }
    .container { max-width: 400px; margin: 80px auto; padding: 30px; background: #222; border-radius: 8px; }
    input[type="email"], input[type="password"] { width: 100%; padding: 12px; margin: 10px 0; border-radius: 5px; border: none; }
    button { background: #007bff; color: white; padding: 12px; border: none; width: 100%; cursor: pointer; border-radius: 5px; font-size: 16px; }
    button:hover { background: #0056b3; }
    .error { color: #f44336; margin-top: 10px; }
    h2 { text-align: center; }
</style>
</head>
<body>
<div class="container">
    <h2>Admin Login</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Admin Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    </form>
</div>
</body>
</html>
