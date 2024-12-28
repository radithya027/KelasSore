<?php
// Path: views/pages/payment/payment.php
define('BASE_PATH', dirname(__DIR__, 3)); // Define base path
include dirname(__FILE__) . '/../../layouts/header.php';

require_once BASE_PATH . '/models/KelasModel.php';
require_once BASE_PATH . '/controllers/InvoiceController.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /views/pages/login/login.php");
    exit;
}

$successMessage = ''; // Flag for success message

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requiredFields = ['course_id', 'course_name', 'course_price', 'bank', 'account_number', 'name', 'transfer_date'];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            header("Location: /error.php?msg=Missing%20required%20fields");
            exit;
        }
    }

    if (!isset($_FILES['transfer_proof']) || $_FILES['transfer_proof']['error'] !== UPLOAD_ERR_OK) {
        header("Location: /error.php?msg=Invalid%20transfer%20proof");
        exit;
    }

    $uploadDir = BASE_PATH . '/public/uploads/transfer_proofs/';
    $maxFileSize = 2 * 1024 * 1024;

    if ($_FILES['transfer_proof']['size'] > $maxFileSize) {
        header("Location: /error.php?msg=File%20too%20large");
        exit;
    }

    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['transfer_proof']['type'], $allowedMimeTypes)) {
        header("Location: /error.php?msg=Invalid%20file%20type");
        exit;
    }

    $fileExtension = pathinfo($_FILES['transfer_proof']['name'], PATHINFO_EXTENSION);
    $uniqueFilename = uniqid('transfer_proof_') . '.' . $fileExtension;
    $uploadPath = $uploadDir . $uniqueFilename;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (!move_uploaded_file($_FILES['transfer_proof']['tmp_name'], $uploadPath)) {
        header("Location: /error.php?msg=File%20upload%20failed");
        exit;
    }

    $invoiceData = [
        'user_id' => $_SESSION['user_id'],
        'kelas_id' => intval($_POST['course_id']),
        'status' => 'pending',
        'name' => htmlspecialchars($_POST['name']),
        'payment_price' => intval($_POST['course_price']),
        'nominal' => intval($_POST['course_price']),
        'no_rekening' => htmlspecialchars($_POST['account_number']),
        'image_pay' => $uniqueFilename,
        'bank_name' => htmlspecialchars($_POST['bank']),
        'transfer_date' => date('Y-m-d', strtotime($_POST['transfer_date'])),
        'approval' => 'waiting',
        'created_at' => date('Y-m-d'),
        'updated_at' => date('Y-m-d')
    ];

    $invoicesController = new InvoicesController();
    $result = json_decode($invoicesController->createInvoice($invoiceData), true);

    if ($result['success']) {
        $successMessage = "Pembayaran Anda berhasil. Tim kami akan segera memverifikasi bukti transfer Anda.";
    } else {
        unlink($uploadPath);
        header("Location: /error.php?msg=Invoice%20creation%20failed");
        exit;
    }
}

// Existing course fetch logic
$courseId = intval($_GET['id']);
$kelasModel = new KelasModel();

try {
    $course = $kelasModel->getKelasById($courseId);
    
    if (!$course) {
        header("Location: /error.php?msg=Course%20not%20found");
        exit;
    }

    $courseName = htmlspecialchars($course['name']);
    $coursePrice = $course['price'];
    $courseInstructor = htmlspecialchars($course['name_mentor']);
} catch (Exception $e) {
    error_log("Failed to fetch course: " . $e->getMessage());
    header("Location: /error.php?msg=Course%20fetch%20error");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
    include_once dirname(__FILE__) . '/../../layouts/header.php';
    ?>
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .transfer-card { 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            padding: 20px; 
            background-color: #fff; 
        }
        .price-box { 
            background-color: #001A45; 
            color: #fff; 
            padding: 20px; 
            border-radius: 8px; 
            text-align: center; 
            font-size: 1.5rem; 
        }
        .important-note { 
            background-color: #FFF3E0; 
            border-left: 4px solid #F57C00; 
            padding: 15px; 
            border-radius: 8px; 
        }
        .btn-orange { 
            background-color: #001A45; 
            color: #fff; 
        }
        .btn-orange:hover { 
            background-color: #001A45; 
        }
        body { 
            height: 100vh; 
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .row {
                margin: 0;
            }
            
            .transfer-card {
                padding: 15px;
                margin-bottom: 15px;
            }
            
            .price-box {
                font-size: 1.2rem;
                padding: 15px;
                margin-bottom: 15px;
            }
            
            .important-note {
                padding: 12px;
                margin: 10px 0;
            }
            
            .form-control, .form-select {
                margin-bottom: 10px;
            }
            
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
            
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 10px;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 5px;
            }
            
            .transfer-card {
                padding: 10px;
            }
            
            .price-box {
                font-size: 1.1rem;
                padding: 12px;
            }
            
            h5 {
                font-size: 1.1rem;
            }
            
            .important-note {
                font-size: 0.9rem;
            }
            
            .form-label {
                font-size: 0.9rem;
            }
        }
    </style>
   
</head>

<body>
<?php renderHeader(); ?>

    <div class="container d-flex justify-content-center align-items-center h-100">
        <div class="row g-4 w-100" style="max-width: 900px;">
        <?php if ($successMessage): ?>
                <div class="alert alert-success text-center" role="alert">
                    <h4 class="alert-heading">Transfer Berhasil</h4>
                    <p><?php echo $successMessage; ?></p>
                    <a href="../home/home.php" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
                </div>
            <?php endif; ?>
            <!-- Left Section -->
            <div class="col-md-6">
                <div class="price-box">
                    <strong>Biaya Kursus</strong>
                    <div>Rp <?php echo number_format($coursePrice, 0, ',', '.'); ?></div>
                </div>
                <div class="transfer-card mt-4">
                    <h5 class="mb-3">Detail Transfer</h5>
                    <p>Lakukan transfer dengan nominal <strong>Rp <?php echo number_format($coursePrice, 0, ',', '.'); ?></strong> ke nomor rekening berikut:</p>
                    <div class="p-3 bg-light rounded">
                        <h4 class="mb-1">0377665116</h4>
                        <p class="mb-1"><strong>BANK BACA</strong></p>
                        <p>a/n <strong>KelasSore</strong></p>
                    </div>
                    <div class="important-note mt-3">
                        <strong>Perhatian!</strong>
                        <p>Mohon pastikan nominal sesuai hingga 3 digit terakhir kode unik. Perbedaan nominal akan menghambat proses verifikasi.</p>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-md-6">
                <div class="transfer-card">
                    <h5 class="mb-3">Form Bukti Transfer</h5>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="course_id" value="<?php echo $courseId; ?>">
                        <input type="hidden" name="course_name" value="<?php echo $courseName; ?>">
                        <input type="hidden" name="course_price" value="<?php echo $coursePrice; ?>">

                        <div class="mb-3">
                            <label for="bank" class="form-label">Bank</label>
                            <select id="bank" name="bank" class="form-select" required>
                                <option value="" disabled selected>Pilih Bank</option>
                                <option value="bca">BCA</option>
                                <option value="mandiri">Mandiri</option>
                                <option value="bni">BNI</option>
                                <option value="bri">BRI</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="account_number" class="form-label">Nomor Rekening</label>
                            <input type="text" id="account_number" name="account_number" class="form-control" placeholder="Nomor Rekening" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="transfer_date" class="form-label">Tanggal</label>
                            <input type="date" id="transfer_date" name="transfer_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="transfer_proof" class="form-label">Bukti Transfer</label>
                            <input type="file" id="transfer_proof" name="transfer_proof" class="form-control" accept="image/*" required>
                            <small class="text-muted">Foto atau screenshot bukti transfer, max 2MB</small>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-light">Batalkan</button>
                            <button type="submit" class="btn btn-orange">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            if (!confirm('Apakah anda yakin ingin membayar kursus ini?')) {
                event.preventDefault();
                const alertPlaceholder = document.createElement('div');
                alertPlaceholder.className = 'alert alert-warning alert-dismissible fade show mt-3';
                alertPlaceholder.role = 'alert';
                alertPlaceholder.innerHTML = `
                    <strong>Perhatian!</strong> Pembayaran dibatalkan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                document.querySelector('.transfer-card').appendChild(alertPlaceholder);
            }
        });
    </script>
    
</body>
<footer>
    <?php
    include_once dirname(__FILE__) . '/../../layouts/footer.php';
    ?>
</footer>
</html>