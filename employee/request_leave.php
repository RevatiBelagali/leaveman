<?php
session_start();
include('../includes/db.php');

include '../includes/functions.php';

if (!isset($_SESSION['emp_id'])) {
    header("Location: login.php");
    exit();
}

$emp_id = $_SESSION['emp_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $type = $_POST['leave_type'];
    $from = $_POST['from_date'];
    $to = $_POST['to_date'];
    $reason = trim($_POST['reason']);
    $days = (strtotime($to) - strtotime($from)) / 86400 + 1;

    if ($days <= 0) {
        $error = "Invalid date range.";
    } elseif (!canApplyLeave($emp_id, $days)) {
        $error = "Insufficient leave balance.";
    } else {
        $stmt = $conn->prepare("INSERT INTO employee_leave (emp_id, leave_type, from_date, to_date, leave_days, reason) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssis", $emp_id, $type, $from, $to, $days, $reason);

        if ($stmt->execute()) {
            $success = "✅ Leave request submitted successfully.";
        } else {
            $error = "❌ Error submitting leave request.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request Leave</title>
    <style>
        body {
            background: #121212;
            color: white;
            font-family: Arial;
        }
        .form-box {
            max-width: 400px;
            margin: 80px auto;
            background: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        button {
            background: #007bff;
            color: white;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .msg {
            margin-top: 10px;
            font-weight: bold;
        }
        .msg.error {
            color: #ff4d4d;
        }
        .msg.success {
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Request Leave</h2>
        <form method="post">
            <select name="leave_type" required>
                <option value="Sick">Sick</option>
                <option value="Casual">Casual</option>
                <option value="Earned">Earned</option>
            </select>
            <input type="date" name="from_date" required />
            <input type="date" name="to_date" required />
            <textarea name="reason" placeholder="Reason..." required></textarea>
            <button type="submit">Submit</button>
        </form>

        <div class="msg <?= isset($error) ? 'error' : 'success' ?>">
            <?php if (isset($success)) echo $success; ?>
            <?php if (isset($error)) echo $error; ?>
        </div>
    </div>
</body>
</html>
