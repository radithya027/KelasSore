<?php
// Start the session at the beginning
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: /login.php');
    exit();
}

// Get current user ID from session
$userId = $_SESSION['user_id'];

// Initialize UserController with correct path
include dirname(__FILE__) . '/../../../controllers/UserController.php';
$userController = new UserController();

// Fetch current user's data
$user = $userController->getUserProfile($userId);

// If user data couldn't be fetched, redirect to login
if (!$user) {
    session_destroy();
    header('Location: /login.php');
    exit();
}

// Default profile picture as SVG (Base64 encoded)
$defaultProfilePicture = 'data:image/svg+xml;base64,' . base64_encode('
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ddd" width="80px" height="80px">
    <circle cx="12" cy="8" r="4" />
    <path d="M12 14c-5 0-9 2.5-9 5v1h18v-1c0-2.5-4-5-9-5z"/>
</svg>
');

// Determine which profile picture to use
$profilePicture = !empty($user['profile_picture']) ? $user['profile_picture'] : $defaultProfilePicture;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background-color: #f5f6fa;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #333;
            font-size: 24px;
        }
        .search-profile {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .search-profile input {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 200px;
        }
        .search-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-section {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .profile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .profile-header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-info h2 {
            margin-bottom: 5px;
            color: #333;
        }
        .profile-info p {
            color: #666;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-size: 14px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
            color: #666;
        }
        .form-group:last-child {
            margin-bottom: 0;
        }
        .form-group input[type="file"] {
            padding: 8px;
            background: white;
        }
        .btn {
            background: #4a90e2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #357abd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome, <?php echo htmlspecialchars(explode(' ', $user['name'])[0]); ?></h1>
            <div class="search-profile">
                <input type="search" placeholder="Search">
                <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture">
            </div>
        </div>

        <div class="profile-section">
            <div class="profile-header">
                <div class="profile-header-left">
                    <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture" class="profile-image">
                    <div class="profile-info">
                        <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                        <p><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                </div>
            </div>

            <form action="update-profile.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter your name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone_number" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($user['phone_number']); ?>">
                </div>
                <button type="submit" class="btn">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
