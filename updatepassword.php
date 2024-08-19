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

    // Get the JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Get and sanitize input data
    $currentPassword = mysqli_real_escape_string($conn, $input['current_password']);
    $newPassword = mysqli_real_escape_string($conn, $input['new_password']);
    $confirmPassword = mysqli_real_escape_string($conn, $input['confirm_password']);
    $user_id = $_SESSION['user_id'];

    // Validate that the new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        echo json_encode(["success" => false, "message" => "New passwords do not match"]);
        exit();
    }

    // Retrieve the current password hash from the database
    $sqlQuery = "SELECT password FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sqlQuery);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Verify the current password
        if (password_verify($currentPassword, $row['password'])) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $updateSql = "UPDATE users SET password = ? WHERE id = ?";
            $updateStmt = mysqli_prepare($conn, $updateSql);
            mysqli_stmt_bind_param($updateStmt, 'si', $hashedPassword, $user_id);

            if (mysqli_stmt_execute($updateStmt)) {
                echo json_encode(["success" => true, "message" => "Password updated successfully"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to update password"]);
            }

            mysqli_stmt_close($updateStmt);
        } else {
            echo json_encode(["success" => false, "message" => "Current password is incorrect"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "User not found"]);
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
