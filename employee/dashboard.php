<?php
session_start();
if (!isset($_SESSION['emp_id'])) {
    header("Location: ../index.php");
    exit();
}
require_once '../includes/db.php';
require_once '../includes/functions.php';

$emp_id = $_SESSION['emp_id'];
$emp = getEmployeeById($emp_id);

// Get employee leaves
$stmt = $conn->prepare("SELECT * FROM employee_leave WHERE emp_id = ?");
$stmt->bind_param("i", $emp_id);
$stmt->execute();
$leaves = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Employee Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        /* Reset & base */
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background: #f0f2f5;
            color: #333;
        }
        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar */
        .navbar {
            background-color: #2c3e50;
            padding: 12px 24px;
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
        }
        .navbar a {
            color: #ecf0f1;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .navbar a:hover {
            background-color: #34495e;
        }

        /* Container */
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Header Cards Container */
        .header-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        .card {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.1);
            flex: 1;
            min-width: 280px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .card h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
        }
        .card p {
            margin-top: 8px;
            font-size: 1.2rem;
            color: #7f8c8d;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgb(0 0 0 / 0.1);
        }
        th, td {
            padding: 14px 18px;
            text-align: center;
        }
        thead {
            background-color: #2980b9;
            color: #fff;
        }
        tbody tr:nth-child(even) {
            background-color: #f7f9fc;
        }
        tbody tr:hover {
            background-color: #d1e7fd;
            cursor: default;
        }

        /* Logout Button */
        .logout-btn {
            display: inline-block;
            margin: 40px auto 0;
            background-color: #e74c3c;
            color: white;
            font-weight: 600;
            padding: 14px 36px;
            border-radius: 30px;
            text-align: center;
            transition: background-color 0.3s ease;
            box-shadow: 0 5px 15px rgb(231 76 60 / 0.4);
            user-select: none;
        }
        .logout-btn:hover {
            background-color: #c0392b;
            box-shadow: 0 8px 20px rgb(192 57 43 / 0.6);
        }
        .logout-wrapper {
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .header-cards {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="request_leave.php">Request Leave</a>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <div class="header-cards">
        <div class="card">
            <h2>Welcome, <?= htmlspecialchars($emp['emp_name']) ?></h2>
            <p>Glad to see you back!</p>
        </div>
        <div class="card">
            <h2><?= htmlspecialchars($emp['leave_balance']) ?></h2>
            <p>Leave Balance</p>
        </div>
    </div>

    <h3>Your Leave Requests</h3>
    <table>
        <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Type</th>
                <th>Days</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($leaves) === 0): ?>
                <tr>
                    <td colspan="5" style="padding: 20px; color: #888;">No leave requests found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($leaves as $lv): ?>
                    <tr>
                        <td><?= htmlspecialchars($lv['from_date']) ?></td>
                        <td><?= htmlspecialchars($lv['to_date']) ?></td>
                        <td><?= htmlspecialchars($lv['leave_type']) ?></td>
                        <td><?= htmlspecialchars($lv['leave_days']) ?></td>
                        <td><?= htmlspecialchars($lv['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="logout-wrapper">
        <a href="logout.php" class="logout-btn">🚪 Logout</a>
    </div>
</div>

</body>
</html>
