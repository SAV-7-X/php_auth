<?php
session_start();
if (isset($_SESSION['username']) || isset($_SESSION['user_id']) ) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
    $conn = mysqli_connect('localhost','root','','users');
    $sql =  "SELECT * FROM users WHERE id = $user_id ";
    $result = mysqli_query($conn , $sql);
    $row = mysqli_fetch_assoc($result);
}
else
{
    header("Location: login_page.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional User Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="dashboardstyle.scss">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="bg-gray-900 w-64 h-screen fixed left-0 top-0 overflow-y-auto transition-all duration-300 ease-in-out" id="sidebar">
            <div class="p-6">
                <h1 class="text-white text-2xl font-bold mb-8">Dashboard</h1>
                <nav>
                    <ul>
                        <li class="mb-4">
                            <a href="#" class="text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg transition-all duration-200 flex items-center">
                                <i class="fas fa-user-circle mr-3"></i> Profile
                            </a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg transition-all duration-200 flex items-center">
                                <i class="fas fa-cog mr-3"></i> Settings
                            </a>
                        </li>
                        <li class="mb-4 cursor-pointer" id='logout'>
                            <a  class="text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg transition-all duration-200 flex items-center">
                                <i class="fas fa-sign-out-alt mr-3"></i> Logout
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <header class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Welcome, <?php echo htmlspecialchars($row['username']);  ?></h1>
                <p class="text-gray-600">Manage your account settings and preferences</p>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow-md p-6" data-aos="fade-up">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">User Profile</h2>
                    <form id="userForm">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                            <input type="text" id="name" value="<?php echo htmlspecialchars($row['username'])?>" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($row['email'])?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                        </div>
                        <div id="message" class="mt-6 text-sm text-center text-gray-600"></div>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">Update Profile</button>
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Change Password</h2>
                    <form id="passwordForm">
                        <div class="mb-4">
                            <label for="currentPassword" class="block text-gray-700 font-bold mb-2">Current Password</label>
                            <input type="password" id="currentPassword" name="current_password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                        </div>
                        <div class="mb-4">
                            <label for="newPassword" class="block text-gray-700 font-bold mb-2">New Password</label>
                            <input type="password" id="newPassword" name="new_password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                        </div>
                        <div class="mb-4">
                            <label for="confirmPassword" class="block text-gray-700 font-bold mb-2">Confirm New Password</label>
                            <input type="password" id="confirmPassword" name="confirm_password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200">
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300">Change Password</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="dashboardscript.js"></script>
</body>
</html>