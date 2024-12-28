<?php
// Path: views/pages/checkout/features.php
require_once dirname(__FILE__) . '/../../../controllers/KelasController.php';

// Initialize KelasController
$kelasController = new KelasController();

$kelasId = $_GET['id'] ?? null; // Get the class ID from the URL query parameter
$kelas = null;
$mentor = null;

try {
    if ($kelasId) {
        // Fetch specific class by ID
        $kelas = $kelasController->getKelasById($kelasId);
        $mentor = $kelasController->getmentorbykelasid($kelasId);
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
                <?php if (!empty($kelas['what_will_learn_1'])): ?>
                    <details class="kelas-item">
                        <summary>
                            <h5>Apa yang kamu Pelajari</h5>
                        </summary>
                        <div class="list-items">
                            <p><?= htmlspecialchars($kelas['what_will_learn_1']); ?></p>
                        </div>
                    </details>
                <?php endif; ?>
                <?php if (!empty($kelas['what_will_learn_2'])): ?>
                    <details class="kelas-item">
                        <summary>
                            <h5>Apa yang kamu Pelajari</h5>
                        </summary>
                        <div class="list-items">
                            <p><?= htmlspecialchars($kelas['what_will_learn_2']); ?></p>
                        </div>
                    </details>
                <?php endif; ?>
                <?php if (!empty($kelas['what_will_learn_3'])): ?>
                    <details class="kelas-item">
                        <summary>
                            <h5>Apa yang kamu Pelajari</h5>
                        </summary>
                        <div class="list-items">
                            <p><?= htmlspecialchars($kelas['what_will_learn_3']); ?></p>
                        </div>
                    </details>
                <?php endif; ?>
            <?php else: ?>
                <p>No class details available.</p>
            <?php endif; ?>
        </div>

        <!-- Cards Section -->
        <div class="card-container">
            <!-- Course Features -->
           

            <div class="card-container">
            <?php if ($mentor): ?>
                <div class="card-coursesfeature1">
                    <h4>Instructor Profile</h4>
                    <div class="avatar-text">
                        <div class="avatar-container">
                            <img class="avatar"
                                src="<?= !empty($mentor['profile_picture'])
                                            ? 'path_to_images/' . htmlspecialchars($mentor['profile_picture'])
                                            : 'default-avatar.jpg'; ?>"
                                alt="Avatar">
                        </div>
                        <div class="text">
                            <p><strong><?= htmlspecialchars($kelas['name_mentor']); ?></strong></p>
                        </div>
                    </div>
                    <ul class="list-itemscolumn">
                        <li>Email: <?= htmlspecialchars($mentor['email'] ?? 'No Email Provided'); ?></li>
                        <li>Phone: <?= htmlspecialchars($mentor['phone_number'] ?? 'N/A'); ?></li>
                    </ul>   
                </div>
            <?php else: ?>
                <p>Mentor data not found for this class.</p>
            <?php endif; ?>
        </div>
        </div>
    </div>
</body>
</html>
