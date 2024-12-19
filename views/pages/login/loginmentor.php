<?php
include dirname(__FILE__) . '/../../../controllers/MentorController.php';

session_start();

if (isset($_SESSION['mentor_id'])) {
    header('Location: ../../mentor/mentor.php'); 
    exit();
}

$mentorModel = new MentorModel($conn);
$authController = new AuthMentorController($mentorModel);

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $message = "Email dan Password wajib diisi.";
    } else {
        $loginMessage = $authController->login($email, $password);
        if ($loginMessage !== true) {
            $message = $loginMessage;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../assets/css/login/login.css">
    <title>Login Mentor</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 left-box d-flex justify-content-center align-items-center flex-column" 
                 style="background: #000842;">
                <p class="text-white fs-2">Selamat Datang Mentor</p>
            </div>
            <div class="col-md-5 right-box" style="padding-left: 40px;">
                <div class="header-text mb-4">
                    <h2>KelasSore</h2>
                    <p>We are happy to have you back.</p>
                </div>

                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </div>
                </form>

                <small class="d-block mt-3">Belum punya akun? <a href="../register/register.php">Daftar</a></small>
            </div>
        </div>
    </div>
</body>
</html>
