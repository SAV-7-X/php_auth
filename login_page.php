<?php
// Start the session
session_start();

// Check if the user is logged in by verifying if the session variable is set
if (isset($_SESSION['user_id'])) {
    header('Location:dashboard.php');
    // If the user is logged in, return a success response
    echo json_encode(["authenticated" => true]);
} else {
    // header('Location:dashboard.php');
    // If the user is not logged in, return a failure response
    // http_response_code(401); // Set HTTP status code to 401 (Unauthorized)
    // echo json_encode(["authenticated" => false, "message" => "User not authenticated"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="container mx-auto relative">
        <div class="rotating-ring"></div>
        <div id="form-container" class="max-w-md mx-auto bg-white rounded-xl shadow-2xl overflow-hidden relative z-10">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Login</h2>
                    <p class="text-sm text-gray-600">Welcome back! Please login to your account.</p>
                </div>
                <form id="loginForm" class="space-y-6">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-envelope text-blue-500"></i>
                        </span>
                        <input type="email" id="email" name="email" required class="pl-10 w-full py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900 placeholder-gray-500" placeholder="Email">
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-lock text-blue-500"></i>
                        </span>
                        <input type="password" id="password" name="password" required class="pl-10 w-full py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-900 placeholder-gray-500" placeholder="Password">
                    </div>
                    <div>
                        <button type="submit" id="submit-btn" class="w-full py-3 px-4 bg-blue-500 hover:bg-blue-600 rounded-lg text-white font-bold transition duration-300 ease-in-out transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </button>
                    </div>
                </form>
                <div id="message" class="mt-6 text-sm text-center text-gray-600"></div>
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">Don't have an account? <a href="#" class="font-medium text-blue-500 hover:text-blue-600">Register</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="login.js"></script>
    <!-- <script src="check_session.js"></script> -->

</body>
</html>
