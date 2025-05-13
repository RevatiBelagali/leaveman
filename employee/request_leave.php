<?php include('../includes/db.php'); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $emp_id = 1; // Assume logged-in employee ID
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO employee_leave (emp_id, leave_type, from_date, to_date, reason, status)
            VALUES ($emp_id, '$leave_type', '$start_date', '$end_date', '$reason', 'Pending')";
    if ($conn->query($sql) === TRUE) {
        echo "Leave request submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Request Leave</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Request Leave</h2>
        <form method="POST">
            <div class="form-group">
                <label>Leave Type</label>
                <select name="leave_type" class="form-control">
                    <option value="Sick">Sick</option>
                    <option value="Vacation">Vacation</option>
                    <option value="Personal">Personal</option>
                </select>
            </div>
            <div class="form-group">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Reason</label>
                <textarea name="reason" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Leave</button>
        </form>
    </div>
</body>
</html>
