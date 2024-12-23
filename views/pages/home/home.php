<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quick+Sans:wght@500&display=swap">
    <!-- // home.php -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KelasSore.com</title>
    <link rel="stylesheet" href="../../../../assets/css/home/home.css">
    <link rel="stylesheet" href="../../../../assets/css/home/content.css">
    <link rel="stylesheet" href="../../../../assets/css/home/ourcourses.css">
    <link rel="stylesheet" href="../../../../assets/css/home/privatecourses.css">
    <link rel="stylesheet" href="../../../../assets/css/home/publiccourses.css">
    <link rel="stylesheet" href="../../../../assets/css/home/partner.css">
    <link rel="stylesheet" href="../../../../assets/css/home/animation.css"> 
    <link rel="stylesheet" href="../../../../assets/css/home/banner.css">
</head>
<body>

<header>
    <!-- // file ini berisi tag <head> yang berisi meta tag, title, dan link CSS -->
    <div class="logo">
        <img src="../../../../assets/images/logo.svg" alt="KelasSore Logo">
    </div>
    <div class="buttons">
        <?php
        session_start(); // Mulai session
        if (!isset($_SESSION['user_id'])) {
            // Jika belum login, tampilkan tombol Log in dan Join
            echo '<a href="/views/pages/login/login.php" class="login">Log in</a>';
        } else {
            // Jika sudah login, tampilkan tombol Log out
            echo '<a href="/views//pages/dashoardUser/index.php" class="login">Your Class</a>';
            echo '<a href="/views/pages/userprofile/userprofile.php" class="register" style="background-color: #FF5722; color: #fff; padding: 10px 20px; border-radius: 50px; margin-left: 10px;">Profile</a>';
        }
        ?>
    </div>
    
</header>


<section class="hero">
    <div class="text slide-in-left">
        <h1><span class="highlight">Selamat Datang di Kelas Sore!</span></h1>
        <p>
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
            <!-- <img src="../../../../assets/images/ayam.jpg" alt="Example 1" class="slide active">
            <img src="../../../../assets/images/kodok.jpg" alt="Example 2" class="slide">
            <img src="../../../../assets/images/ayam.jpg" alt="Example 3" class="slide"> -->
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

<section class="hero">
    <div class="text slide-in-left">
        <h1 class="text-bottom">Kelas sore!</h1>
        <p>
             Soooo tak perlu ragu lagi, Lets Join Us!
        </p>
    </div>
    <div class="images-bottom slide-in-right">
        <img src="../../../../assets/images/kursus.svg" alt="Example 1">
    </div>
</section>

<?php include('/PhpWeb/views/layouts/footer.php'); ?>


<script src="../../../../assets/js/animation.js"></script>
<script src="../../../../assets/js/privateslide.js"></script>
<script src="../../../../assets/js/publicslide.js"></script>
<script src="../../../../assets/js/homeslide.js"></script>

</body>
</html>
