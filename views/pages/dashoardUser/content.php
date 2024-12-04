<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Sore</title>
    <link rel="stylesheet" href="assets/css/dashboard/dashbod.css"> <!-- Include CSS File -->
</head>
<body>

    <!-- Courses Section -->
    <section class="courses">
        <div class="container">
            <div class="section-header">
                <h2 class="memer">Courses</h2>
            </div>

            <!-- Slider Wrapper -->
            <div class="slider-wrapper">
                <button class="slider-btn left-btn" onclick="slideLeft()">&#10094;</button>
                <div class="class-grid">
                    <?php for ($i = 0; $i < 4; $i++): ?> <!-- Looping through 5 courses -->
                        <div class="class-card">
                            <img src="assets/images/kursus.svg" alt="Class Image">
                            <h3>The Complete 2023 PHP Full Stack Web Developer Bootcamp</h3>
                            <p>Sarah Lee</p>
                            <div class="price">$109.99</div>
                            <div class="meta">
                                <span>⭐ 4.9</span>
                                <span>20,459+</span>
                                <div class="users">
                                    <img src="assets/images/user1.svg" alt="User 1">
                                    <img src="assets/images/user2.svg" alt="User 2">
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
                <button class="slider-btn right-btn" onclick="slideRight()">&#10095;</button>
            </div>
        </div>
    </section>

    <script>
        // Function to slide left
        function slideLeft() {
            const grid = document.querySelector(".class-grid");
            grid.scrollBy({ left: -300, behavior: "smooth" });  // Scroll left by 300px
        }

        // Function to slide right
        function slideRight() {
            const grid = document.querySelector(".class-grid");
            grid.scrollBy({ left: 300, behavior: "smooth" });  // Scroll right by 300px
        }
    </script>

</body>
</html>
