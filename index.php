<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KelasSore.com</title>
    <!-- Tambahkan CSS di sini -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 10%;
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
        }
        header .logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        header nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }
        header .buttons {
            display: flex;
            gap: 10px;
        }
        header .buttons a {
            text-decoration: none;
            padding: 10px 15px;
            border: 1px solid #333;
            border-radius: 5px;
            font-weight: 600;
        }
        header .buttons .join {
            background-color: #333;
            color: #fff;
        }
        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 50px 10%;
        }
        .hero .text {
            max-width: 50%;
        }
        .hero .text h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }
        .hero .text p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #555;
        }
        .hero .text .buttons a {
            margin: 0 10px;
        }
        .hero .images {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            align-items: center;
        }
        .hero .images img {
            width: 100%;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">KelasSore.com</div>
    <nav>
        <a href="#">Technology & Software</a>
        <a href="#">Partner Kami</a>
        <a href="#">Kategori Kursus</a>
        <a href="#">Health & Wellness</a>
        <a href="#">Language Learning</a>
        <a href="#">See All Categories</a>
    </nav>
    <div class="buttons">
        <a href="#">Log in</a>
        <a href="#" class="join">Join for Free</a>
    </div>
</header>

<section class="hero">
    <div class="text">
        <h1>Boost Your Career with Industry-Recognized Skills</h1>
        <p>
            Flexible, affordable courses designed to help you achieve your goals, whether you're at home, on the go, or anywhere in between.
        </p>
        <div class="buttons">
            <a href="#" style="background-color: #333; color: #fff; padding: 10px 20px; border-radius: 5px;">Start Your Certification</a>
            <a href="#" style="text-decoration: underline; color: #333;">Browse All Courses</a>
        </div>
    </div>
    <div class="images">
        <img src="image1.jpg" alt="Example 1">
        <img src="image2.jpg" alt="Example 2">
        <img src="image3.jpg" alt="Example 3">
        <img src="image4.jpg" alt="Example 4">
        <img src="image5.jpg" alt="Example 5">
        <img src="image6.jpg" alt="Example 6">
    </div>
</section>

</body>
</html>
