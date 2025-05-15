<?php
session_start();
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Matches your DB stored MD5 password

    $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_email=? AND admin_password=?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['id']; // ✅ Corrected to 'id' as per your table
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
    body { background: #121212; color: white; font-family: Arial, sans-serif; height: 100vh; display: flex; justify-content: center; align-items: center; margin: 0; }
    .container { max-width: 400px; margin: 0 auto; padding: 30px; background: #222; border-radius: 8px; width: 360px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); text-align: center; }
    input[type="email"], input[type="password"] { width: 100%; padding: 12px; margin: 10px 0; border-radius: 5px; border: none; font-size: 16px; outline: none; transition: background-color 0.3s ease; }
    input[type="email"]:focus, input[type="password"]:focus { background-color: #333; }
    button { background: #007bff; color: white; padding: 12px; border: none; width: 100%; cursor: pointer; border-radius: 5px; font-size: 16px; margin-top: 10px; font-weight: 600; transition: background-color 0.3s ease; }
    button:hover { background: #0056b3; }
    .error { color: #f44336; margin-top: 10px; font-weight: 600; }
    .nav-btn { display: inline-block; margin-top: 25px; padding: 12px 25px; color: #007bff; background: rgba(255, 255, 255, 0.15); border-radius: 6px; text-decoration: none; font-weight: 600; transition: background-color 0.3s ease, color 0.3s ease; }
    .nav-btn:hover { background: #007bff; color: white; }
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

    <a href="../index.php" class="nav-btn">← Back to Home</a>
</div>
</body>
</html>
