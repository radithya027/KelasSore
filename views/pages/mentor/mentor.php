<?php
// Include necessary files for database connection and authentication
require_once '../../../../config/database.php'; // Adjust path as needed
require_once '../../../../models/AuthModel.php'; // Adjust path as needed

// Start session to get mentor ID
session_start();

// Check if mentor is logged in
if (!isset($_SESSION['mentor_id'])) {
    // Redirect to login page or handle unauthorized access
    header('Location: login.php');
    exit();
}

// Create an instance of MentorModel
$mentorModel = new MentorModel();

// Get mentor details
$mentorId = $_SESSION['mentor_id'];
$mentorDetails = $mentorModel->getMentorById($mentorId);

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
</head>
<body>

<!-- // Include content.php -->
<section class="your-class">
    <div class="container">
        <div class="section-header">
            <h2>Your Class</h2>
        </div>
        <div class="class-grid">
            <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="class-card">
                    <img src="../../../../assets/images/kursus.svg" alt="Class Image">
                    <h3>The Complete 2023 PHP Full Stack Web Developer Bootcamp</h3>
                    <p>Sarah Lee</p>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>

<section class="your-class">
    <div class="container">
        <div class="section-header">
            <h2>Informasi Terkini</h2>
        </div>
        <div class="class-grid">
            <?php for ($i = 0; $i < 4; $i++): ?>
                <div class="class-card">
                    <img src="../../../../assets/images/brita.svg" alt="Class Image">
                    <h3>The Complete 2023 PHP Full Stack Web Developer Bootcamp</h3>
                    <p>Sarah Lee</p>
                </div>
            <?php endfor; ?>
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
