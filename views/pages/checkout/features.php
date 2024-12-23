<?php
// Path: views/pages/checkout/features.php
require_once dirname(__FILE__) . '/../../../controllers/KelasController.php';

// Initialize KelasController
$kelasController = new KelasController();

$kelasId = $_GET['id'] ?? null; // Get the class ID from the URL query parameter
$kelas = null;

try {
    if ($kelasId) {
        // Fetch specific class by ID
        $kelas = $kelasController->getKelasById($kelasId);
    } else {
        throw new Exception("Class ID not provided.");
    }
} catch (Exception $e) {
    $kelas = null;
    error_log("Failed to fetch class: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Features</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const details = document.querySelectorAll('details');

            details.forEach((detail) => {
                const content = detail.querySelector('.list-items');
                const summary = detail.querySelector('summary');

                content.style.transition = 'all 0.3s ease';

                summary.addEventListener('click', (e) => {
                    e.preventDefault();

                    if (detail.hasAttribute('open')) {
                        content.style.maxHeight = '0';
                        content.style.opacity = '0';

                        setTimeout(() => {
                            detail.removeAttribute('open');
                        }, 300);
                        return;
                    }

                    details.forEach((otherDetail) => {
                        if (otherDetail !== detail && otherDetail.hasAttribute('open')) {
                            const otherContent = otherDetail.querySelector('.list-items');
                            otherContent.style.maxHeight = '0';
                            otherContent.style.opacity = '0';

                            setTimeout(() => {
                                otherDetail.removeAttribute('open');
                            }, 300);
                        }
                    });

                    detail.setAttribute('open', '');
                    content.getBoundingClientRect();
                    content.style.maxHeight = content.scrollHeight + 'px';
                    content.style.opacity = '1';
                });

                if (!detail.hasAttribute('open')) {
                    content.style.maxHeight = '0';
                    content.style.opacity = '0';
                }
            });
        });
    </script>
</head>
<body>
    <div class="row-container">
        <!-- Accordion Section -->
        <div class="accordion">
            <?php if ($kelas): ?>
                <details class="kelas-item">
    <summary>
        <h4><?= htmlspecialchars($kelas['name']); ?></h4>
    </summary>
    <div class="list-items">
        <ul>
            <?php if (!empty($kelas['what_will_learn_1'])): ?>
                <li><?= htmlspecialchars($kelas['what_will_learn_1']); ?></li>
            <?php endif; ?>
            <?php if (!empty($kelas['what_will_learn_2'])): ?>
                <li><?= htmlspecialchars($kelas['what_will_learn_2']); ?></li>
            <?php endif; ?>
            <?php if (!empty($kelas['what_will_learn_3'])): ?>
                <li><?= htmlspecialchars($kelas['what_will_learn_3']); ?></li>
            <?php endif; ?>
        </ul>
    </div>
</details>

            <?php else: ?>
                <p>No class details available.</p>
            <?php endif; ?>
        </div>

        <!-- Cards Section -->
        <div class="card-container">
            <!-- Course Features -->
            <div class="card-coursesfeature">
                <h4 class="hai">Course Features</h4>
                <ul>
                    <li><i class="bi bi-pin-fill pinned-icon"></i> Beginner to Advanced</li>
                    <li><i class="bi bi-pin-fill pinned-icon"></i> 80+ hours of video content</li>
                    <li><i class="bi bi-pin-fill pinned-icon"></i> 15 modules with over 150 lessons</li>
                    <li><i class="bi bi-pin-fill pinned-icon"></i> Professional Certificate upon completion</li>
                </ul>
                <button class="buy-now">Buy Now</button>
            </div>

            <div class="card-coursesfeature1">
                <h4>Instructor Profile</h4>
                <div class="avatar-text">
                    <div class="avatar-container">
                        <img class="avatar" src="assets/images/1fdd264b4b531494b306bf6994d7448c.jpg" alt="Avatar">
                    </div>
                    <div class="text">
                        <p><strong>Angela Yu</strong></p>
                        <p>Lead Instructor, Software Engineer</p>
                    </div>
                </div>
                <ul class="list-itemscolumn">
                    <li>10+ years Experience <span class="divider"></span></li>
                    <li>20,450+ Reviews <span class="divider"></span></li>
                    <li>25+ Courses <span class="divider"></span></li>
                    <li><a href="#">Follow on LinkedIn</a></li>
                </ul>
                <button class="buy-nowcek">Learn More about</button>
            </div>
        </div>
    </div>
</body>
</html>
