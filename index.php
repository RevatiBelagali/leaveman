<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Leave Manager</title>
    <style>
        body {
            background: #121212;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0 20px;
            text-align: center;
        }
        h1 {
            margin-bottom: 50px;
            font-weight: 700;
            font-size: 2.5rem;
            text-shadow: 0 0 10px rgba(0,123,255,0.7);
        }
        .btn {
            display: inline-block;
            margin: 12px;
            padding: 14px 36px;
            font-size: 18px;
            font-weight: 600;
            color: white;
            background: #007bff;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.5);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            user-select: none;
        }
        .btn:hover {
            background: #0056b3;
            box-shadow: 0 6px 20px rgba(0, 86, 179, 0.7);
        }
        /* Responsive for smaller screens */
        @media (max-width: 480px) {
            h1 {
                font-size: 1.8rem;
            }
            .btn {
                padding: 12px 28px;
                font-size: 16px;
                margin: 10px 8px;
            }
        }
    </style>
</head>
<body>
    <h1>Welcome to LeaveManager</h1>
    <a href="admin/login.php" class="btn">Manager Login</a>
    <a href="employee/login.php" class="btn">Employee Login</a>
    <a href="employee/register.php" class="btn">Register Employee</a>
</body>
</html>
