<?php
// Start the session
session_start();

// Destroy all session data
session_unset();  // Unset all session variables
session_destroy();  // Destroy the session

// Redirect to the login page or home page after logout
echo json_encode(["success"=>"Logged out successfully"]);
exit();
?>
