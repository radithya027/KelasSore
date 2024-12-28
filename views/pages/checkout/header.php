<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="../home/home.php">
                <img src="../../../../assets/images/logo.svg" alt="KelasSore Logo" height="40">
            </a>
            
            <!-- Hamburger Menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                    session_start();
                    if (!isset($_SESSION['user_id']) && !isset($_SESSION['mentor_id'])) {
                        echo '<li class="nav-item"><a class="nav-link" href="/views/pages/login/login.php">Log in</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="/views/pages/register/register.php">Join</a></li>';
                    } elseif (isset($_SESSION['mentor_id'])) {
                        echo '<li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>';
                    } elseif (isset($_SESSION['user_id'])) {
                        echo '<li class="nav-item"><a class="nav-link" href="">Your Class</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
