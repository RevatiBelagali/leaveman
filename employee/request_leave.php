<?php include('../includes/db.php'); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = 1; // Assume logged-in employee with ID 1
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $reason = $_POST['reason'];

    $sql = "INSERT INTO leaves (employee_id, leave_type, start_date, end_date, reason, status) 
            VALUES ($employee_id, '$leave_type', '$start_date', '$end_date', '$reason', 'pending')";
    if ($conn->query($sql) === TRUE) {
        echo "Leave request submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Leave</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Request Leave</h2>
        <form method="POST">
            <div class="form-group">
                <label for="leave_type">Leave Type</label>
                <select name="leave_type" class="form-control">
                    <option value="sick">Sick</option>
                    <option value="vacation">Vacation</option>
                    <option value="personal">Personal</option>
                </select>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason</label>
                <textarea name="reason" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Request Leave</button>
        </form>
    </div>
</body>
</html>
