<?php
// File: views/pages/home/publiccourses.php
// Atau gunakan cara alternatif
require_once dirname(__FILE__) . '/../../../controllers/KelasController.php';
$kelasController = new KelasController();

try {
    $courses = $kelasController->getAllKelas();
} catch (Exception $e) {
    $courses = [];
    error_log("Gagal mengambil kursus: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kursus Tersedia</title>
</head>
<body>
    <section class="public-courses">
        <div class="public-container">
            <div class="public-header fade-up">
                <h2 class="public-title">Kursus Bersama</h2>
                <a href="#" class="public-see-all">
                    Lihat semua kursus
                    <span class="arrow-icon">→</span>
                </a>
            </div>
            <div class="public-cards-wrapper fade-in">
                <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                        <div class="public-card">
                            <a href="/views/pages/checkout/index.php?id=<?php echo urlencode($course['id']); ?>" class="public-card-link">
                                <div class="public-card-image">
                                    <?php
                                    $imagePath = !empty($course['image']) 
                                        ? '/public/image-class/' . basename($course['image']) 
                                        : '/assets/images/default-course.svg';
                                    ?>
                                    <img 
                                        src="<?php echo htmlspecialchars($imagePath); ?>" 
                                        alt="Gambar Kelas <?php echo isset($course['name']) ? htmlspecialchars($course['name']) : 'Tidak diketahui'; ?>"
                                        onerror="this.onerror=null; this.src='/assets/images/default-course.svg';"
                                    >
                                </div>
                                <div class="public-card-content">
                                    <h3 class="public-course-title"><?php echo isset($course['name']) ? htmlspecialchars($course['name']) : 'Nama tidak tersedia'; ?></h3>
                                    <p class="public-instructor-name"><?php echo isset($course['name_mentor']) ? htmlspecialchars($course['name_mentor']) : 'Tidak diketahui'; ?></p>
                                    <p class="public-price">Rp <?php echo isset($course['price']) ? number_format($course['price'], 0, ',', '.') : '0'; ?></p>
                                    <p class="public-quota-left">Sisa Kuota: <?php echo isset($course['quota_left']) ? htmlspecialchars($course['quota_left']) : '0'; ?></p>
                                    <p class="public-status">Status: <?php echo isset($course['status']) ? htmlspecialchars($course['status']) : 'Tidak tersedia'; ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada kursus tersedia saat ini. Silakan cek kembali nanti.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</body>
</html>
