<?php
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);  // Assuming password is stored as MD5

    $query = "SELECT * FROM employee WHERE emp_email = '$email' AND emp_password = '$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['employee'] = $email;
        header("Location: dashboard.php");  // Redirect to employee dashboard
    } else {
        echo "Invalid email or password";
    }
}
?>

<form method="POST">
    Email: <input type="text" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
