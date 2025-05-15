<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Handle Approve/Reject actions
if (isset($_POST['action']) && isset($_POST['leave_id'])) {
    $leave_id = intval($_POST['leave_id']);
    $action = $_POST['action'];

    $leave_res = $conn->query("SELECT * FROM employee_leave WHERE id = $leave_id");
    $leave = $leave_res->fetch_assoc();

    if ($leave && $leave['status'] == 'Pending') {
        $emp_id = $leave['emp_id'];

        if ($action == 'approve') {
            $from = new DateTime($leave['from_date']);
            $to = new DateTime($leave['to_date']);
            $diff = $to->diff($from)->days + 1;

            $emp_res = $conn->query("SELECT leave_balance FROM employee WHERE id = $emp_id");
            $emp = $emp_res->fetch_assoc();

            if ($emp['leave_balance'] >= $diff) {
                $conn->query("UPDATE employee_leave SET status = 'Approved' WHERE id = $leave_id");
                $new_balance = $emp['leave_balance'] - $diff;
                $conn->query("UPDATE employee SET leave_balance = $new_balance WHERE id = $emp_id");
            } else {
                $_SESSION['error'] = "Insufficient leave balance to approve request ID $leave_id.";
            }
        } elseif ($action == 'reject') {
            $conn->query("UPDATE employee_leave SET status = 'Rejected' WHERE id = $leave_id");
        }
    }

    header("Location: manage_leaves.php");
    exit();
}

// Fetch leave requests with employee info
$leaves = $conn->query("
    SELECT employee_leave.*, employee.emp_name, employee.leave_balance
    FROM employee_leave
    JOIN employee ON employee_leave.emp_id = employee.id
    ORDER BY employee_leave.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Leaves - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background: #121212; color: white; }
    table { background: #1c1c1c; }
    th, td { vertical-align: middle !important; }
    .container { margin-top: 40px; }
  </style>
</head>
<body>
  <div class="container">
    <h2 class="mb-4 text-center">Manage Leave Requests</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert alert-danger">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <table class="table table-bordered table-hover text-white">
      <thead>
        <tr>
          <th>ID</th>
          <th>Employee Name</th>
          <th>Leave Type</th>
          <th>From</th>
          <th>To</th>
          <th>Reason</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $leaves->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['emp_name']) ?></td>
            <td><?= htmlspecialchars($row['leave_type']) ?></td>
            <td><?= htmlspecialchars($row['from_date']) ?></td>
            <td><?= htmlspecialchars($row['to_date']) ?></td>
            <td><?= htmlspecialchars($row['reason']) ?></td>
            <td>
              <?php
                $status = $row['status'];
                $badge_class = 'secondary';
                if ($status == 'Approved') $badge_class = 'success';
                else if ($status == 'Rejected') $badge_class = 'danger';
                else if ($status == 'Pending') $badge_class = 'warning';
              ?>
              <span class="badge bg-<?= $badge_class ?>"><?= $status ?></span>
            </td>
            <td>
              <?php if ($status == 'Pending'): ?>
                <form method="POST" style="display:inline-block;">
                  <input type="hidden" name="leave_id" value="<?= $row['id'] ?>">
                  <button type="submit" name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                </form>
                <form method="POST" style="display:inline-block;">
                  <input type="hidden" name="leave_id" value="<?= $row['id'] ?>">
                  <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Reject</button>
                </form>
              <?php else: ?>
                <em>No actions</em>
              <?php endif; ?>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
