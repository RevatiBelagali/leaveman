<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include '../db.php';
include '../functions.php';

$leaveRequests = getLeaveRequests();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leave_id = $_POST['leave_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        approveLeave($leave_id);
    } elseif ($action === 'reject') {
        rejectLeave($leave_id);
    }

    header("Location: manage_leaves.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Leave Requests</title>
    <style>
        body {
            background: #121212;
            color: white;
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #1e1e1e;
        }
        th, td {
            padding: 12px;
            border: 1px solid #333;
            text-align: center;
        }
        th {
            background: #222;
        }
        form {
            display: inline;
        }
        button {
            padding: 8px 14px;
            margin: 2px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button.reject {
            background: #dc3545;
        }
        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <h2>Manage Leave Requests</h2>
    <table>
        <tr>
            <th>Employee Name</th>
            <th>Leave Type</th>
            <th>From</th>
            <th>To</th>
            <th>Days</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($leaveRequests as $leave): ?>
            <tr>
                <td><?= htmlspecialchars($leave['emp_name']) ?></td>
                <td><?= htmlspecialchars($leave['leave_type']) ?></td>
                <td><?= $leave['from_date'] ?></td>
                <td><?= $leave['to_date'] ?></td>
                <td><?= $leave['leave_days'] ?></td>
                <td><?= htmlspecialchars($leave['reason']) ?></td>
                <td><?= $leave['status'] ?></td>
                <td>
                    <?php if ($leave['status'] === 'Pending'): ?>
                        <form method="post">
                            <input type="hidden" name="leave_id" value="<?= $leave['id'] ?>">
                            <button type="submit" name="action" value="approve">Approve</button>
                            <button type="submit" name="action" value="reject" class="reject">Reject</button>
                        </form>
                    <?php else: ?>
                        <?= $leave['status'] ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
