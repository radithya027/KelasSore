<?php
require_once dirname(__FILE__) . '/../../../controllers/KelasController.php';
// Inisialisasi KelasController
$kelasController = new KelasController();

try {
    // Ambil semua kursus
    $kelasList = $kelasController->getAllKelas();
} catch (Exception $e) {
    $kelasList = [];
    error_log("Gagal mengambil kursus: " . $e->getMessage());
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
        document.addEventListener('DOMContentLoaded', function() {
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
        <?php if (!empty($kelasList)): ?>
    <?php foreach ($kelasList as $kelas): ?>
        <details class="kelas-item">
            <summary>
                <h4><?= htmlspecialchars($kelas['name']); ?></h4>
            </summary>
            <div class="list-items">
                <ul>
                    <?php foreach ($kelas['what_will_learn'] as $learn): ?>
                        <?php if (!empty($learn)): ?>
                            <li><?= htmlspecialchars($learn); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </details>
    <?php endforeach; ?>
<?php else: ?>
    <p>No classes available.</p>
<?php endif; ?>

</div>

        <!-- Cards Section -->
        <div class="card-container">
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
