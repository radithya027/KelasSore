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
    <title>Kelas Anda - KelasSore</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/dashboard/header.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../home/home.php">
                <img src="../../../../assets/images/logo.svg" alt="KelasSore Logo" height="40">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                    if (!isset($_SESSION['user_id']) && !isset($_SESSION['mentor_id'])) {
                        echo '<li class="nav-item"><a class="nav-link" href="../../login/login.php">Log in</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="../../register/register.php">Join</a></li>';
                    } elseif (isset($_SESSION['mentor_id'])) {
                        echo '<li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>';
                    } elseif (isset($_SESSION['user_id'])) {
                
                        echo '<li class="nav-item"><a class="nav-link" href="../../userprofile/userprofile.php">Profile</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

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
    </section>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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