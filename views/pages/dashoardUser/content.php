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

                
            <div class="class-grid">
    <?php if (!empty($purchasedClasses)): ?>
        <?php foreach ($purchasedClasses as $class): ?>
            <a href="../class/index.php?id=<?php echo urlencode($class['id']); ?>" class="class-card-link">
                <div class="class-card">
                    <?php
                    $imagePath = !empty($class['image']) 
                        ? '/public/image-class/' . basename($class['image']) 
                        : '/assets/images/default-course.svg';
                    ?>
                    <img 
                        src="<?php echo htmlspecialchars($imagePath); ?>" 
                        alt="Gambar Kelas <?php echo isset($class['image']) ? htmlspecialchars($class['image']) : 'Tidak diketahui'; ?>"
                        onerror="this.onerror=null; this.src='/assets/images/default-course.svg';"
                    >   
                    <h3><?php echo htmlspecialchars($class['name']); ?></h3>
                    <p>Instructor: <?php echo htmlspecialchars($class['name_mentor']); ?></p>
                    <div class="price">Rp <?php echo number_format($class['price'], 0, ',', '.'); ?></div>
                    <div class="meta" style="text-align: left; margin-bottom: 5px;">
                        <span>Kelas di Mulai: <?php echo htmlspecialchars($class['start_date']); ?></span>
                    </div>
                    <div class="meta">
                        <span>Kelas Selesai: <?php echo htmlspecialchars($class['end_date']); ?></span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No purchased courses available.</p>
    <?php endif; ?>
</div>

</div>

     
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