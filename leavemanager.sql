-- Create Database
CREATE DATABASE IF NOT EXISTS leavemanager;
USE leavemanager;

-- Create User (if not exists)
CREATE USER IF NOT EXISTS 'leavemanager_user'@'localhost' IDENTIFIED BY 'shreyas';

-- Grant permissions
GRANT ALL PRIVILEGES ON leavemanager.* TO 'leavemanager_user'@'localhost';
FLUSH PRIVILEGES;

-- Create Admin Table
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert Sample Admin
INSERT INTO admin (username, password)
VALUES ('admin', MD5('admin123'));

-- Create Employees Table
CREATE TABLE IF NOT EXISTS employee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emp_name VARCHAR(100) NOT NULL,
    emp_email VARCHAR(100) NOT NULL,
    emp_password VARCHAR(255) NOT NULL,
    emp_dept VARCHAR(100) NOT NULL,
    leave_balance INT DEFAULT 10
);


-- Create Leave Table
CREATE TABLE IF NOT EXISTS employee_leave (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emp_id INT,
    leave_type VARCHAR(50),
    from_date DATE,
    to_date DATE,
    reason TEXT,
    status VARCHAR(20) DEFAULT 'Pending',
    FOREIGN KEY (emp_id) REFERENCES employee(id)
);
