<?php
// Include the KelasModel class and database connection using the correct relative path
require_once dirname(__FILE__) . '/../../../models/KelasModel.php';  // Adjusted path

// Create an instance of the KelasModel class
$kelasModel = new KelasModel();

// Get the course ID from the URL (dynamically)
if (isset($_GET['id'])) {
    $courseId = $_GET['id'];
} else {
    echo "Course ID is missing!";
    exit;
}

// Get course data by ID
$course = $kelasModel->getKelasById($courseId);



if ($course) {
    // Extract course data
    $courseName = htmlspecialchars($course['name']);
    $courseDescription = htmlspecialchars($course['description']);
    $courseInstructor = htmlspecialchars($course['name_mentor']);
    $courseStudents = $course['quota'] - $course['quota_left']; 
    $courseQuotaLeft = $course['quota_left'];
    $courseQuota = $course['quota'];
    $coursePrice = $course['price'];
    $courseImage = htmlspecialchars($course['image']);
} else {
    echo "Course not found!";
    exit;
}
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
                        <!-- Example student avatars, update dynamically if needed -->
                        <img src="../../../../assets/images/ayam.jpg" alt="Avatar 1">
                        <img src="../../../../assets/images/ayam.jpg" alt="Avatar 2">
                        <img src="../../../../assets/images/ayam.jpg" alt="Avatar 3">
                    </div>
                    <span><?php echo $courseStudents; ?> Students</span>
                </div>
                <p><strong>Quota Left:</strong> <?php echo $courseQuotaLeft . " / " . $courseQuota; ?></p>
            </div>
            <p class="price">Rp <?php echo number_format($coursePrice, 0, ',', '.'); ?></p>
            <a href="/views/pages/register/register.php" class="buy-now">Buy Now</a>
        </div>
        <div class="course-image">
            <img src="<?php echo $courseImage; ?>" alt="Course Preview">
        </div>
    </div>
</div>
