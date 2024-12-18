<?php
include dirname(__FILE__) . '/../../../controllers/MentorController.php';
var_dump(class_exists('MentorController'));


session_start();

if (isset($_SESSION['mentor_id'])) {
    header('Location: ../dashboard/dashboard.php');
    exit();
}

$mentorController = new AuthMentorController();

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $message = "Email and password are required.";
    } else {
        $loginMessage = $mentorController->login($email, $password);
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../assets/css/login/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600&display=swap" rel="stylesheet">
    <title>Login Mentor</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" 
                 style="background: #000842;">
                <p class="text-white fs-2" style="font-family: 'Manrope', sans-serif; font-weight: 600;">
                    Selamat Datang Mentor
                </p>
            </div>

            <div class="col-md-5 right-box" style="padding-left: 40px;">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>KelasSore</h2>
                        <p>We are happy to have you back.</p>
                    </div>

                    <?php if (!empty($message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($message) ?>
                        </div>
                    <?php endif; ?>

                    <form action="loginmentor.php" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="email" class="form-control form-control-lg bg-light fs-6" 
                                placeholder="Enter your email address" required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" 
                                placeholder="Enter your password" required>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                        </div>
                    </form>
                    
                    <div class="row">
                        <small>Don't have an account? <a href="../register/register.php">Sign Up</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
