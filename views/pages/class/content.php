<?php
define('BASE_PATH', dirname(__DIR__, 3)); 

require_once BASE_PATH . '/models/KelasModel.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$kelasModel = new KelasModel();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /error.php?msg=Invalid%20Course%20ID");
    exit;
}

$courseId = intval($_GET['id']);

try {
    $course = $kelasModel->getKelasById($courseId);
} catch (Exception $e) {
    error_log("Failed to fetch course: " . $e->getMessage());
    header("Location: /error.php?msg=Course%20not%20found");
    exit;
}

if ($course) {
    $courseName = htmlspecialchars($course['name']);
    $courseDescription = htmlspecialchars($course['description']);
    $courseInstructor = htmlspecialchars($course['name_mentor']);
    $courseStudents = $course['quota'] - $course['quota_left'];
    $courseQuotaLeft = $course['quota_left'];
    $courseQuota = $course['quota'];
    $coursePrice = $course['price'];
    $courseSchedule = htmlspecialchars($course['schedule'] ?? 'Schedule not available');
    
    // Simplified image path handling
    $courseImage = '/public/image-class/' . $course['image'];
    
    // Check if image exists, otherwise use default
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $courseImage)) {
        $courseImage = '/assets/images/default-course.jpg';
        error_log("Course image not found: {$course['image']}");
    }

    $courseImage = htmlspecialchars($courseImage);
} else {
    header("Location: /error.php?msg=Course%20not%20found");
    exit;
}

$isLoggedIn = isset($_SESSION['user_id']);
// Replace payment page with WhatsApp Group URL
$waGroupUrl = !empty($course['link_wa']) 
    ? htmlspecialchars($course['link_wa']) 
    : '#';

$joinButtonClass = !empty($course['link_wa']) 
    ? 'join-group' 
    : 'join-group disabled';

$joinButtonText = !empty($course['link_wa']) 
    ? 'Join Group WA' 
    : 'Group Link Unavailable';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            font-size: 15px;
            font-weight: 400;
        }
        .course-header h1 {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
        }
        .course-content p {
            text-align: justify;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem 1rem 1rem 2rem;
            background: #F1F4FF;
            border-radius: 32px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="course-header">
            <h1><?php echo $courseName; ?></h1>
        </div>

        <div class="course-content">
            <div class="course-details">
                <p><?php echo $courseDescription; ?></p>
                <p><strong>Instructor:</strong> <?php echo $courseInstructor; ?></p>
            
                <div class="course-schedule">
                    <p><strong>Jadwal:</strong> <?php echo $courseSchedule; ?></p>
                </div>

                <a href="<?php echo $waGroupUrl; ?>" 
                   class="<?php echo $joinButtonClass; ?>" 
                   <?php echo empty($course['link_wa']) ? 'disabled' : 'target="_blank"'; ?>>
                   <?php echo $joinButtonText; ?>
                </a>
            </div>
            <div class="course-image">
                <img src="<?php echo $courseImage; ?>" alt="Course Preview">
            </div>
        </div>
    </div>
</body>
</html>