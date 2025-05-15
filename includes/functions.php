<?php
function getAllEmployees() {
    global $conn;
    $sql = "SELECT * FROM employee";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getEmployeeById($emp_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM employee WHERE id = ?");
    $stmt->bind_param("i", $emp_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getLeaveRequests() {
    global $conn;
    $sql = "SELECT employee_leave.*, employee.emp_name FROM employee_leave JOIN employee ON employee_leave.emp_id = employee.id";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function approveLeave($leave_id) {
    global $conn;

    // Get leave details first
    $stmt = $conn->prepare("SELECT emp_id, leave_days FROM employee_leave WHERE id = ?");
    $stmt->bind_param("i", $leave_id);
    $stmt->execute();
    $leave = $stmt->get_result()->fetch_assoc();

    if (!$leave) return false;

    $emp_id = $leave['emp_id'];
    $leave_days = $leave['leave_days'];

    // Get employee leave balance
    $emp = getEmployeeById($emp_id);
    if (!$emp) return false;

    $current_balance = $emp['leave_balance'];

    // Check if employee has enough leave balance
    if ($current_balance < $leave_days) {
        return false; // Not enough leave balance, cannot approve
    }

    // Deduct leave balance
    $new_balance = $current_balance - $leave_days;

    // Update leave status and employee leave balance atomically (transaction)
    $conn->begin_transaction();

    $q1 = $conn->query("UPDATE employee_leave SET status='Approved' WHERE id=$leave_id");
    $q2 = $conn->query("UPDATE employee SET leave_balance=$new_balance WHERE id=$emp_id");

    if ($q1 && $q2) {
        $conn->commit();
        return true;
    } else {
        $conn->rollback();
        return false;
    }
}

function rejectLeave($leave_id) {
    global $conn;
    return $conn->query("UPDATE employee_leave SET status='Rejected' WHERE id=$leave_id");
}

// Check if employee has enough leave balance to apply
function canApplyLeave($emp_id, $requested_days) {
    $emp = getEmployeeById($emp_id);
    if (!$emp) return false;
    return $emp['leave_balance'] >= $requested_days;
}
?>
