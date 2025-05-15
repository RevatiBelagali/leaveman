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
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Request Leave</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            background: #121212;
            color: #eee;
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .form-box {
            background: #1f1f1f;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.7);
            width: 100%;
            max-width: 420px;
            box-sizing: border-box;
        }
        h2 {
            margin-bottom: 24px;
            font-weight: 600;
            text-align: center;
            color: #f0f0f0;
        }
        select, input[type="date"], textarea {
            width: 100%;
            padding: 14px 16px;
            margin-bottom: 18px;
            background: #2a2a2a;
            border: none;
            border-radius: 8px;
            color: #ddd;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            resize: vertical;
            font-family: 'Poppins', sans-serif;
        }
        select:focus, input[type="date"]:focus, textarea:focus {
            outline: none;
            background: #3a3a3a;
            box-shadow: 0 0 8px #007bff;
            color: #fff;
        }
        textarea {
            min-height: 100px;
        }
        button, .btn-back {
            width: 100%;
            padding: 14px 0;
            border-radius: 30px;
            border: none;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 12px;
            user-select: none;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }
        button {
            background: #007bff;
            color: white;
            box-shadow: 0 5px 15px rgb(0 123 255 / 0.4);
        }
        button:hover {
            background: #0056b3;
            box-shadow: 0 8px 20px rgb(0 86 179 / 0.6);
        }
        .btn-back {
            background: #555;
            color: #ddd;
            margin-top: 10px;
            box-shadow: 0 5px 15px rgb(85 85 85 / 0.4);
        }
        .btn-back:hover {
            background: #777;
            box-shadow: 0 8px 20px rgb(119 119 119 / 0.6);
        }
        .msg {
            margin-top: 15px;
            font-weight: 600;
            text-align: center;
            padding: 12px 15px;
            border-radius: 8px;
            user-select: none;
        }
        .msg.error {
            background: #ff4d4d;
            color: white;
            box-shadow: 0 4px 12px rgb(255 77 77 / 0.6);
        }
        .msg.success {
            background: #28a745;
            color: white;
            box-shadow: 0 4px 12px rgb(40 167 69 / 0.6);
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Request Leave</h2>
        <form method="post" novalidate>
            <select name="leave_type" required>
                <option value="" disabled selected>Select Leave Type</option>
                <option value="Sick" <?= (isset($type) && $type === 'Sick') ? 'selected' : '' ?>>Sick</option>
                <option value="Casual" <?= (isset($type) && $type === 'Casual') ? 'selected' : '' ?>>Casual</option>
                <option value="Earned" <?= (isset($type) && $type === 'Earned') ? 'selected' : '' ?>>Earned</option>
            </select>

            <input type="date" name="from_date" value="<?= isset($from) ? htmlspecialchars($from) : '' ?>" required />

            <input type="date" name="to_date" value="<?= isset($to) ? htmlspecialchars($to) : '' ?>" required />

            <textarea name="reason" placeholder="Reason..." required><?= isset($reason) ? htmlspecialchars($reason) : '' ?></textarea>

            <button type="submit">Submit</button>
        </form>

        <?php if (isset($success)): ?>
            <div class="msg success"><?= htmlspecialchars($success) ?></div>
        <?php elseif (isset($error)): ?>
            <div class="msg error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>
    </div>
</body>
</html>
