<?php
// File: courses.php
include dirname(__FILE__) . '/../../../controllers/KelasController.php';

// Initialize the KelasController
$kelasController = new KelasController();

// Fetch all courses
$courses = $kelasController->getAllKelas();
?>

<section class="public-courses">
  <div class="public-container">
    <div class="public-header fade-up">
      <h2 class="public-title">Kursus bersama</h2>
      <a href="#" class="public-see-all">
        Lihat semua kursus
        <span class="arrow-icon">→</span>
      </a>
    </div>

    <div class="public-cards-wrapper fade-in">
      <?php foreach ($courses as $course): ?>
        <div class="public-card">
          <div class="public-card-image">
            <img src="<?php echo htmlspecialchars($course['image'] ?? 'assets/images/kursus.svg'); ?>" alt="Course Thumbnail">
          </div>
          <div class="public-card-content">
            <h3 class="public-course-title"><?php echo htmlspecialchars($course['name']); ?></h3>
            <p class="public-instructor-name"><?php echo htmlspecialchars($course['name_mentor']); ?></p>
            <p class="public-price">Rp <?php echo number_format($course['price'], 0, ',', '.'); ?></p>
            <div class="public-card-stats">
              <div class="public-rating">
                <span>⭐</span>4.9
              </div>
              <div class="public-students">20,459+</div>
              <div class="public-avatars">
                <img src="assets/images/kursus.svg" alt="Student 1">
                <img src="assets/images/kursus.svg" alt="Student 2">
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

      <?php if (empty($courses)): ?>
        <p>Tidak ada kursus tersedia saat ini.</p>
      <?php endif; ?>
    </div>
  </div>
</section>