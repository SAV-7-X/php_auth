<?php
// Start the session to access session variables
session_start();

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'users');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if session user_id is set
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["success" => false, "message" => "User not authenticated"]);
        exit();
    }

    // Get and sanitize input data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_id = $_SESSION['user_id'];

    // Prepare and execute the SQL statement
    $sql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssi', $username, $email, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => true, "message" => "Profile updated"]);
    } else {
        echo json_encode(["success" => false, "message" => "Server error"]);
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
