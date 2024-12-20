<?php
// Include necessary files for database connection and authentication
include dirname(__FILE__) . '/../../../services/database.php';
include dirname(__FILE__) . '/../../../models/MentorModel.php';
include dirname(__FILE__) . '/../../../controllers/InvoiceController.php';
include dirname(__FILE__) . '/../../../controllers/AuthController.php';

// Start session to get mentor ID
session_start();

// Check if mentor is logged in
if (!isset($_SESSION['mentor_id'])) {
    header('Location: login.php');
    exit();
}

// Create instances of required models/controllers
$mentorModel = new MentorModel();
$invoicesController = new InvoicesController();
$authController = new AuthController();

// Get mentor details
$mentorId = $_SESSION['mentor_id'];
$mentorDetails = $mentorModel->getMentorById($mentorId);

// Get mentor's classes
$mentorClasses = $invoicesController->getmentorkelas($mentorId);

// Extract salary information
$salaryReceived = $mentorDetails['salary_recived'] ?? 0;
$salaryRemaining = $mentorDetails['salary_remaining'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Sore</title>
    <link rel="stylesheet" href="../../../../assets/css/mentor/mentor.css"> 
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .logout-btn {
            padding: 0.5rem 1rem;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        
        .logout-btn:hover {
            background-color: #c82333;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .mentor-name {
            font-weight: 500;
        }
    </style>
</head>
<body>

<!-- Add Header with Logout -->
<header class="header">
    <h1>Mentor Dashboard</h1>
    <div class="header-right">
        <span class="mentor-name">Welcome, <?= htmlspecialchars($mentorDetails['name'] ?? 'Mentor') ?></span>
        <a href="logiut.php" class="logout-btn">Logout</a>
    </div>
</header>

<section class="your-class">
    <div class="container">
        <div class="section-header">
            <h2>Your Class</h2>
        </div>
        <div class="class-grid">
            <?php if (!empty($mentorClasses)): ?>
                <?php foreach ($mentorClasses as $class): ?>
                    <div class="class-card">
                        <img src="../../../../assets/images/uploads/<?= htmlspecialchars($class['image']) ?>" 
                             alt="<?= htmlspecialchars($class['name']) ?>" 
                             onerror="this.src='../../../../assets/images/kursus.svg'">
                        <h3><?= htmlspecialchars($class['name']) ?></h3>
                        <p>Mentor: <?= htmlspecialchars($class['name_mentor']) ?></p>
                        <div class="class-details">
                            <p>Category: <?= htmlspecialchars($class['category']) ?></p>
                            <p>Price: Rp <?= number_format($class['price'], 0, ',', '.') ?></p>
                            <p>Schedule: <?= htmlspecialchars($class['start_date']) ?> - <?= htmlspecialchars($class['end_date']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-classes">
                    <p>No classes found. Start creating your first class!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="salary-status">
    <div class="container">
        <div class="section-header">
            <h2>Status Gaji</h2>
        </div>
        <div class="salary-grid">
            <div class="salary-card received">
                <h3>Gaji Diterima</h3>
                <p>Rp <?= number_format($salaryReceived, 0, ',', '.') ?></p>
            </div>
            <div class="salary-card pending">
                <h3>Gaji Belum Diterima</h3>
                <p>Rp <?= number_format($salaryRemaining, 0, ',', '.') ?></p>
            </div>
        </div>
    </div>
</section>

</body>
</html>