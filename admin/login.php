<?php
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);  // Assuming the password is stored as MD5

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['admin'] = $username;
        header("Location: dashboard.php");  // Redirect to admin dashboard
    } else {
        echo "Invalid username or password";
    }
}
?>

<form method="POST">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
