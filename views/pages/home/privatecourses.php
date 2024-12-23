<?php
// File: views/pages/home/privatecourses.php
require_once dirname(__FILE__) . '/../../../controllers/KelasController.php';
$kelasController = new KelasController();

try {
    // Using the new showPrivateKelas() method
    $courses = $kelasController->showPrivateKelas();
} catch (Exception $e) {
    $courses = [];
    error_log("Gagal mengambil kursus private: " . $e->getMessage());
}
?>

<section class="private-courses">
  <div class="private-container">
    <div class="private-header fade-up">
      <h2 class="private-title">Kursus Private</h2>
      <a href="#" class="private-see-all">
        Lihat semua kursus
        <span class="arrow-icon">→</span>
      </a>
    </div>
    
    <div class="private-cards-wrapper fade-in">
        <?php if (!empty($courses)): ?>
            <?php foreach ($courses as $course): ?>
                <div class="private-card">
                    <a href="/views/pages/checkout/index.php?id=<?php echo urlencode($course['id']); ?>" class="private-card-link">
                        <div class="private-card-image">
                        <?php
                                    // New image path handling
                                    if (!empty($course['image'])) {
                                        // Extract just the filename from the path
                                        $filename = basename($course['image']);
                                        // Construct the correct path
                                        $imagePath = "/public/image-class/" . $filename;
                                    } else {
                                        $imagePath = '/assets/images/default-course.svg';
                                    }
                                    ?>
                                    <img 
                                        src="<?php echo htmlspecialchars($imagePath); ?>" 
                                        alt="Gambar Kelas <?php echo isset($course['name']) ? htmlspecialchars($course['name']) : 'Tidak diketahui'; ?>"
                                        onerror="this.onerror=null; this.src='/assets/images/default-course.svg';"
                                    >
                        </div>
                        <div class="private-card-content">
                            <h3 class="private-course-title"><?php echo isset($course['name']) ? htmlspecialchars($course['name']) : 'Nama tidak tersedia'; ?></h3>
                            <p class="private-instructor-name"><?php echo isset($course['name_mentor']) ? htmlspecialchars($course['name_mentor']) : 'Tidak diketahui'; ?></p>
                            <p class="private-price">Rp <?php echo isset($course['price']) ? number_format($course['price'], 0, ',', '.') : '0'; ?></p>
                            <div class="private-card-stats">
                                <div class="private-students">Kuota: <?php echo isset($course['quota_left']) ? $course['quota_left'] : '0'; ?>/<?php echo isset($course['quota']) ? $course['quota'] : '0'; ?></div>
                                <p class="private-status">Status: <?php echo isset($course['status']) ? htmlspecialchars($course['status']) : 'Tidak tersedia'; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-courses-message">Tidak ada kursus private tersedia saat ini. Silakan cek kembali nanti.</p>
        <?php endif; ?>
    </div>
  </div>
</section>