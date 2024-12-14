<?php
session_start();
$path = dirname(__DIR__, 3) . '/controllers/InvoiceController.php';
require_once $path;

// Ambil user_id dari session (simulasi user id 3)
$userId = $_SESSION['user_id'] ?? 3;

$invoicesController = new InvoicesController();

try {
    $purchasedClasses = $invoicesController->getUserPurchasedClasses($userId);

    // Debug: Print hasil kelas yang di-fetch
    echo "<pre>";
    print_r($purchasedClasses);
    echo "</pre>";

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
    <title>Purchased Courses</title>
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
                                <img src="<?php echo htmlspecialchars($class['image_url']); ?>" alt="Class Image">
                                <h3><?php echo htmlspecialchars($class['title']); ?></h3>
                                <p><?php echo htmlspecialchars($class['instructor']); ?></p>
                                <div class="price">$<?php echo number_format($class['price'], 2); ?></div>
                                <div class="meta">
                                    <span>⭐ <?php echo $class['rating']; ?></span>
                                    <span>Purchased on: <?php echo htmlspecialchars($class['purchase_date']); ?></span>
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
