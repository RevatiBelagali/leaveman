<?php
function getAllEmployees() {
    global $conn;
    $sql = "SELECT * FROM employee";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getLeaveRequests() {
    global $conn;
    $sql = "SELECT * FROM employee_leave";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function approveLeave($leave_id) {
    global $conn;
    return $conn->query("UPDATE employee_leave SET status='Approved' WHERE id=$leave_id");
}

function rejectLeave($leave_id) {
    global $conn;
    return $conn->query("UPDATE employee_leave SET status='Rejected' WHERE id=$leave_id");
}
?>
