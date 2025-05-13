<?php
include('../includes/db.php');
include('../includes/functions.php');

// Handle approval/rejection
if (isset($_GET['approve'])) {
    approveLeave($_GET['approve']);
}
if (isset($_GET['reject'])) {
    rejectLeave($_GET['reject']);
}

// Get all leave requests with employee names
$sql = "SELECT el.id, el.leave_type, el.from_date, el.to_date, el.reason, el.status,
               e.emp_name
        FROM employee_leave el
        JOIN employee e ON el.emp_id = e.id";
$result = $conn->query($sql);
$leave_requests = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Leaves</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Manage Leave Requests</h2>
    <table class="table table-bordered mt-3">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>Leave Type</th>
                <th>From</th>
                <th>To</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($leave_requests as $leave): ?>
                <tr>
                    <td><?= $leave['id'] ?></td>
                    <td><?= htmlspecialchars($leave['emp_name']) ?></td>
                    <td><?= htmlspecialchars($leave['leave_type']) ?></td>
                    <td><?= $leave['from_date'] ?></td>
                    <td><?= $leave['to_date'] ?></td>
                    <td><?= htmlspecialchars($leave['reason']) ?></td>
                    <td><?= $leave['status'] ?></td>
                    <td>
                        <?php if ($leave['status'] == 'Pending'): ?>
                            <a href="?approve=<?= $leave['id'] ?>" class="btn btn-success btn-sm">Approve</a>
                            <a href="?reject=<?= $leave['id'] ?>" class="btn btn-danger btn-sm">Reject</a>
                        <?php else: ?>
                            <span class="badge bg-secondary">No Action</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
