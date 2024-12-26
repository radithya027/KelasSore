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

<header>
    <link rel="stylesheet" href="../../../assets/css/dashboard/header.css">
    <div class="logo">
        <a href="../home/home.php"> <!-- Ganti "/index.php" dengan URL halaman home/dashboard Anda -->
            <img src="../../../../assets/images/logo.svg" alt="KelasSore Logo">
        </a>
    </div>
    <div class="buttons">
        <?php
        if (!isset($_SESSION['user_id'])) {
            // Jika belum login, tampilkan tombol Log in dan Join
            echo '<a href="/views/pages/login/login.php" class="login">Log in</a>';
        } else {
            // Jika sudah login, tampilkan tombol Log out
            echo '<a href="/views/pages/userprofile/userprofile.php" class="register" style="background-color: #FF5722; color: #fff; padding: 10px 20px; border-radius: 50px; margin-left: 10px;">Profile</a>';
        }
        ?>
    </div>
    
</header>
<!-- <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/dashboard/dashbod.css">
</head> -->
<body>
    <section class="courses">
        <div class="container">
            <div class="section-header">
                <h2 class="memer">Kelas Anda</h2>
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
                        <span>Sesi Kelas di Mulai: <?php echo htmlspecialchars($class['schedule']); ?></span>
                    </div>
                  
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada kelas yang terbayarkan.</p>
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