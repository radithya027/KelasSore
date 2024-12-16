<?php
session_start();
include dirname(__FILE__) . '/../../../controllers/InvoiceController.php';

$userId = $_SESSION['user_id'] ?? 3; // Default ke 3 jika session tidak diatur
$invoicesController = new InvoicesController();

try {
    // Ambil kelas yang sudah dibeli user
    $purchasedClasses = $invoicesController->getkelasuser($userId) ?? [];
} catch (Exception $e) {
    $purchasedClasses = [];
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <name>Purchased Courses</name>
    <link rel="stylesheet" href="assets/css/dashboard/dashbod.css">
</head>
<body>
    <section class="courses">
        <div class="container">
            <div class="section-header">
                <h2 class="memer">Purchased Courses</h2>
            </div>
            <div class="slider-wrapper">
                <button class="slider-btn left-btn" onclick="slideLeft()">&#10094;</button>
                <div class="class-grid">
                    <?php if (!empty($purchasedClasses)): ?>
                        <?php foreach ($purchasedClasses as $class): ?>
                            <div class="class-card">
                                <img src="<?php echo htmlspecialchars($class['image']); ?>" alt="Class Image">
                                <h3><?php echo htmlspecialchars($class['name']); ?></h3>
                                <p>Instructor: <?php echo htmlspecialchars($class['name_mentor']); ?></p>
                                <div class="price">Rp <?php echo number_format($class['price'], 0, ',', '.'); ?></div>
                                <div class="meta">
                                    <span>Start class: <?php echo htmlspecialchars($class['start_date']); ?></span>
                                </div>
                                <div class="meta">
                                    <span>End class: <?php echo htmlspecialchars($class['end_date']); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No purchased courses available.</p>
                    <?php endif; ?>
                </div>
                <button class="slider-btn right-btn" onclick="slideRight()">&#10095;</button>
            </div>
        </div>
    </section>

    <script>
        function slideLeft() {
            document.querySelector(".class-grid").scrollBy({ left: -300, behavior: "smooth" });
        }
        function slideRight() {
            document.querySelector(".class-grid").scrollBy({ left: 300, behavior: "smooth" });
        }
    </script>
</body>
</html>
