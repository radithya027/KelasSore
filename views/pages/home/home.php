<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KelasSore.com</title>
    <link rel="stylesheet" href="assets/css/home/home.css">
    <link rel="stylesheet" href="assets/css/home/content.css">
    <link rel="stylesheet" href="assets/css/home/ourcourses.css">
    <link rel="stylesheet" href="assets/css/home/privatecourses.css">
    <link rel="stylesheet" href="assets/css/home/publiccourses.css">
    <link rel="stylesheet" href="assets/css/home/partner.css">
    <link rel="stylesheet" href="assets/css/home/feedback.css">
    <link rel="stylesheet" href="assets/css/home/animation.css">
</head>
<body>

<header class="fade-in">
    <div class="logo">
        <img src="assets/images/logo.svg" alt="KelasSore Logo">
    </div>
    <div class="buttons">
        <a href="#" class="login">Log in</a>
        <a href="#" class="join">Join for Free</a>
    </div>
</header>

<nav class="fade-in">
    <a href="#" class="stagger-delay-1">Technology & Software</a>
    <a href="#" class="stagger-delay-2">Partner Kami</a>
    <a href="#" class="stagger-delay-3">Kategori Kursus</a>
    <a href="#" class="stagger-delay-4">Health & Wellness</a>
    <a href="#" class="stagger-delay-5">Language Learning</a>
    <a href="#">See All Categories</a>
</nav>

<section class="hero">
    <div class="text slide-in-left">
        <h1><span class="highlight">Boost Your Career</span> with Industry-Recognized Skills</h1>
        <p>
            Flexible, affordable courses designed to help you achieve your goals, whether you're at home, on the go, or anywhere in between.
        </p>
        
        <div class="avatar-stack fade-up">
            <div class="avatars">
                <img src="assets/images/homecontent.svg" alt="User 1">
                <img src="assets/images/logo.svg" alt="User 2">
                <img src="assets/images/logo.svg" alt="User 3">
                <img src="assets/images/homecontent.svg" alt="User 4">
                <img src="assets/images/logo.svg" alt="User 5">
                <span class="avatar-count">+20k</span>
            </div>
            <span class="join-text">Join with us</span>
        </div>

        <div class="buttons fade-up">
            <a href="#" style="background-color: #001A45; color: #fff; padding: 10px 20px; border-radius: 50px;">Start Your Certification</a>
            <a href="#" style="background-color: #001A45; color: #fff; padding: 10px 20px; border-radius: 50px;">Browse All Courses</a>
        </div>
    </div>
    <div class="images slide-in-right">
        <img src="image1.jpg" alt="Example 1">
        <img src="image2.jpg" alt="Example 2">
        <img src="image3.jpg" alt="Example 3">
        <img src="image4.jpg" alt="Example 4">
        <img src="image5.jpg" alt="Example 5">
        <img src="image6.jpg" alt="Example 6">
    </div>
</section>

<?php include('content.php'); ?>
<?php include('ourcourses.php'); ?>
<?php include('privatecourses.php'); ?>
<?php include('publiccourses.php'); ?>
<?php include('partner.php'); ?>
<?php include('feedback.php'); ?>



<script src="assets/js/animation.js"></script>
<script src="assets/js/privateslide.js"></script>
<script src="assets/js/publicslide.js"></script>
<script src="assets/js/partnerslide.js"></script>

</body>
</html>