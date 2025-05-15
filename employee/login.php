<?php
session_start();
include('../includes/db.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // ❗Note: MD5 is outdated — consider better hashing

    $stmt = $conn->prepare("SELECT * FROM employee WHERE emp_email = ? AND emp_password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $_SESSION['emp_id'] = $user['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Login</title>
    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 40px 30px;
            width: 360px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            text-align: center;
        }
        h2 {
            margin-bottom: 30px;
            font-weight: 700;
            letter-spacing: 1.2px;
        }
        input {
            width: 100%;
            padding: 14px 12px;
            margin: 10px 0 20px 0;
            border-radius: 6px;
            border: none;
            outline: none;
            font-size: 16px;
            transition: 0.3s ease;
        }
        input:focus {
            box-shadow: 0 0 8px #00bfff;
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        button {
            width: 100%;
            padding: 14px 0;
            font-size: 18px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            color: white;
            background: #007bff;
        }
        button:hover {
            background: #0056b3;
        }
        .nav-btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 25px;
            color: #007bff;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .nav-btn:hover {
            background: #007bff;
            color: white;
        }
        .error {
            color: #ff6b6b;
            margin-top: 15px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Employee Login</h2>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>

        <a href="../index.php" class="nav-btn">← Back to Home</a>

        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>
</body>
</html>
