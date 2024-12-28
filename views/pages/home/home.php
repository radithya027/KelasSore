<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KelasSore.com</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../../../assets/css/home/home.css">
    <link rel="stylesheet" href="../../../../assets/css/home/content.css">
    <link rel="stylesheet" href="../../../../assets/css/home/ourcourses.css">
    <link rel="stylesheet" href="../../../../assets/css/home/privatecourses.css">
    <link rel="stylesheet" href="../../../../assets/css/home/publiccourses.css">
    <link rel="stylesheet" href="../../../../assets/css/home/partner.css">
    <link rel="stylesheet" href="../../../../assets/css/home/animation.css">
    <link rel="stylesheet" href="../../../../assets/css/home/banner.css">
    <link rel="stylesheet" href="../../../../assets/css/home/artikel.css">
    
    <style>
        body {
            font-family: 'Quicksand', sans-serif !important;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../home/home.php">
                <img src="../../../../assets/images/logo.svg" alt="KelasSore Logo" height="40">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
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
                        echo '<a href="/views/pages/dashoardUser/index.php" class="login">Your Class</a>';
                        echo '<li class="nav-item"><a class="nav-link" href="/views/pages/userprofile/userprofile.php">Profile</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="text slide-in-left">
            <h1 style="padding-right: 48px;"><span class="highlight">Selamat Datang di Kelas Sore!</span></h1>
            <p style="font-family: 'Quicksand', sans-serif; padding-right: 48px; margin-top: 24px;">
                Tingkatkan keterampilan Anda bersama Kelas Sore, platform kursus online dengan berbagai pilihan topik menarik, seperti teknologi, pengembangan karier, dan pembelajaran bahasa. Belajar kapan saja dan di mana saja dengan mudah dan fleksibel.
            </p>
            <div class="avatar-stack fade-up">
                <div class="avatars">
                    <img src="../../../../assets/images/homecontent.svg" alt="User 1">
                    <img src="../../../../assets/images/logo.svg" alt="User 2">
                    <img src="../../../../assets/images/logo.svg" alt="User 3">
                    <img src="../../../../assets/images/homecontent.svg" alt="User 4">
                    <img src="../../../../assets/images/logo.svg" alt="User 5">
                    <span class="avatar-count">+20k</span>
                </div>
                <span class="join-text">Join with us</span>
            </div>

            <div class="buttons fade-up">
                <a href="#" style="background-color: #001A45; color: #fff; padding: 10px 20px; border-radius: 50px;">Mulai kursus</a>
                <a href="#" style="background-color: #001A45; color: #fff; padding: 10px 20px; border-radius: 50px;">Cari semua kursus</a>
            </div>
        </div>
        
        <div class="home-images slide-in-right">
            <div class="slide-container">
                <img src="../../../../assets/images/homecontent.svg" alt="Example 4" class="slide">
                <img src="../../../../assets/images/kursus.svg" alt="Example 5" class="slide">
                <img src="../../../../assets/images/logo.svg" alt="Example 6" class="slide">
            </div>
        </div>
    </section>

    <?php include('content.php'); ?>
    <?php include('ourcourses.php'); ?>
    <?php include('privatecourses.php'); ?>
    <?php include('publiccourses.php'); ?>
    <?php include('partner.php'); ?>
    <?php include('artikel.php'); ?>

    <!-- Bottom Hero Section -->
    <section class="hero">
        <div class="text slide-in-left">
            <h1 class="text-bottom">Kelas sore!</h1>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>
        </div>
        <div class="images-bottom slide-in-right">
            <img src="../../../../assets/images/kursus.svg" alt="Example 1">
        </div>
    </section>

    <?php include('/PhpWeb/views/layouts/footer.php'); ?>

    <!-- Scripts -->
    <script src="../../../../assets/js/animation.js"></script>
    <script src="../../../../assets/js/privateslide.js"></script>
    <script src="../../../../assets/js/publicslide.js"></script>
    <script src="../../../../assets/js/homeslide.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>