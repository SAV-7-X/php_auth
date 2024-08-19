<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";  // Use your actual MySQL password
$dbname = "users";  // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an empty array to hold error messages
$errors = [];

// Handle the login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // If there are no validation errors, proceed with login
    if (empty($errors)) {
        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if the email exists
        if ($stmt->num_rows > 0) {
            // Bind the result to variables
            $stmt->bind_result($id, $username, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, start a session
                session_start();
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;

                echo json_encode(["success" => true, "message" => "Login successful!"]);
            } else {
                $errors[] = "Invalid email or password.";
            }
        } else {
            $errors[] = "Invalid email or password.";
        }

        $stmt->close();
    }

    // Return errors if there are any
    if (!empty($errors)) {
        echo json_encode(["success" => false, "message" => implode("<br>", $errors)]);
    }
}

$conn->close();
?>
