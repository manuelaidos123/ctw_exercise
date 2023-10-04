<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'ctw';

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $sql = "SELECT * FROM users WHERE username = ? AND password = ? AND role = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $password, $role);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Login successful, redirect to a secure page
            header("Location: secure_page.php");
            exit();
        } else {
            // Invalid login credentials
            $error = "Invalid username, password, or role.";
        }
    } elseif (isset($_POST['signup'])) {
            $username = $_POST['new_username'];
            $password = $_POST['new_password'];
            $role = $_POST['new_role']; 
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $username, $hashedPassword, $role);

            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
    }
}
?>