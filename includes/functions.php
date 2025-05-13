<?php
// Function to get all employees
function getAllEmployees() {
    global $conn;
    $sql = "SELECT * FROM employees";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to get leave requests
function getLeaveRequests() {
    global $conn;
    $sql = "SELECT * FROM leaves";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to approve a leave request
function approveLeave($leave_id) {
    global $conn;
    $sql = "UPDATE leaves SET status='approved' WHERE id=$leave_id";
    return $conn->query($sql);
}

// Function to reject a leave request
function rejectLeave($leave_id) {
    global $conn;
    $sql = "UPDATE leaves SET status='rejected' WHERE id=$leave_id";
    return $conn->query($sql);
}
?>
