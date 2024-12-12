<?php
define('BASE_PATH', dirname(__DIR__, 3)); // Define base path

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
    
    // Try multiple path approaches
    $potentialPaths = [
        '/uploads/' . $course['image'],
        '/assets/images/courses/' . $course['image'],
        BASE_PATH . '/public/uploads/' . $course['image']
    ];

    $courseImage = '';
    foreach ($potentialPaths as $path) {
        if (file_exists($path) || file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
            $courseImage = $path;
            break;
        }
    }

    // Fallback if no path found
    if (empty($courseImage)) {
        $courseImage = '/assets/images/default-course.jpg';
        echo "Warning: Image not found. Using default image.<br>";
    }

    $courseImage = htmlspecialchars($courseImage);
} else {
    header("Location: /error.php?msg=Course%20not%20found");
    exit;
}

$isLoggedIn = isset($_SESSION['user_id']);
$redirectUrl = $isLoggedIn ? "/views/pages/payment/payment.php?id=$courseId" : "/views/pages/login/login.php";
?>

<div class="container">
    <div class="course-header">
        <h1><?php echo $courseName; ?></h1>
    </div>

    <div class="course-content">
        <div class="course-details">
            <p><?php echo $courseDescription; ?></p>
            <p><strong>Instructor:</strong> <?php echo $courseInstructor; ?></p>
            <div class="course-rating-enrollment">
                <div class="enrolled">
                    <div class="avatars">
                        <img src="/assets/images/ayam.jpg" alt="Avatar 1">
                        <img src="/assets/images/ayam.jpg" alt="Avatar 2">
                        <img src="/assets/images/ayam.jpg" alt="Avatar 3">
                    </div>
                    <span><?php echo $courseStudents; ?> Students</span>
                </div>
                <p><strong>Quota Left:</strong> <?php echo $courseQuotaLeft . " / " . $courseQuota; ?></p>
            </div>  
            <p class="price">Rp <?php echo number_format($coursePrice, 0, ',', '.'); ?></p>
            <a href="<?php echo $redirectUrl; ?>" class="buy-now">Buy Now</a>
        </div>
        <div class="course-image">
            <img src="<?php echo $courseImage; ?>" alt="Course Preview (Path: <?php echo $courseImage; ?>)">
        </div>
    </div>
</div>