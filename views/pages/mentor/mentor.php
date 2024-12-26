<?php
// Include necessary files for database connection and authentication
include dirname(__FILE__) . '/../../../services/database.php';
include dirname(__FILE__) . '/../../../models/MentorModel.php';
include dirname(__FILE__) . '/../../../controllers/InvoiceController.php';
include dirname(__FILE__) . '/../../../controllers/AuthController.php';
include dirname(__FILE__) . '/../../../controllers/BookController.php';
include dirname(__FILE__) . '/../../../controllers/CatatanController.php';

// Start session to get mentor ID
session_start();

// Check if mentor is logged in
if (!isset($_SESSION['mentor_id'])) {
    header('Location: login.php');
    exit();
}

// Create instances of required models/controllers
$mentorModel = new MentorModel();
$invoicesController = new InvoicesController();
$authController = new AuthController();
$bookController = new BookController();
$catatanController = new CatatanController();

// Get mentor details
$mentorId = $_SESSION['mentor_id'];
$mentorDetails = $mentorModel->getMentorById($mentorId);

// Get mentor's classes
$mentorClasses = $invoicesController->getmentorkelas($mentorId);

// Get all catatan
$catatanList = $catatanController->getAllCatatan();

// Extract salary information
$salaryReceived = $mentorDetails['salary_recived'] ?? 0;
$salaryRemaining = $mentorDetails['salary_remaining'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas Sore</title>
    <!-- Import Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../../assets/css/mentor/mentor.css">
    <link rel="stylesheet" href="../../../../assets/css/mentor/header.css">
    <style>
    /* General Style */
    body {
        font-family: 'Quicksand', sans-serif;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Roboto', sans-serif;
        font-weight: 600;
    }

    p {
        font-family: 'Quicksand', sans-serif;
        font-weight: 500;
        color: #333;
    }

    /* Header Style */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .logout-btn {
        padding: 0.5rem 1rem;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
    }
    
    .logout-btn:hover {
        background-color: #c82333;
    }

    /* Class Section Styles */
    .class-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
        padding: 1rem;
    }

    .class-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.2s;
    }

    .class-card img {
        width: 100%;
        height: auto;
    }
    .section-header h2 {
            font-family: 'Roboto', sans-serif;
        }

  /* Salary Section Styles */
.salary-status {
    padding: 2rem;
}

.salary-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem; /* Increased gap between cards */
    max-width: 1200px; /* Increased max-width */
    margin: 0 auto;
    padding: 0 4rem; /* Added horizontal padding */
}

.salary-card {
    background: white;
    padding: 2rem; /* Increased internal padding */
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    text-align: center;
    width: 100%;
}

.salary-card h3 {
    font-family: 'Roboto', sans-serif;
    margin-bottom: 1rem; /* Add space between title and amount */
}

.salary-card.received {
    border-left: 4px solid #28a745;
}

.salary-card.pending {
    border-left: 4px solid #ffc107;
}

/* Responsive adjustment */
@media (max-width: 768px) {
    .salary-grid {
        grid-template-columns: 1fr;
        padding: 0 2rem; /* Reduced padding on mobile */
    }
}
    /* Catatan Section Styles */
    .catatan-section {
        padding: 2rem;
    }

    .section-header {
        margin-top: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .section-header h2 {
        color: #333;
        font-family: 'Roboto', sans-serif;

        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }

    .carousel-container {
            position: relative;
            max-width: 1200px;
            margin: 2rem auto;
            overflow: hidden;
        }

        .carousel-track {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .catatan-card {
            flex: 0 0 300px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-right: 1rem;
            padding: 1rem;
            text-align: left;
        }

        .catatan-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .catatan-card p {
            font-size: 0.9rem;
            color: #555;
        }

        .catatan-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s;
        }

        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            z-index: 10;
        }

      

        .carousel-btn:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .no-catatan {
            text-align: center;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 8px;
            color: #666;
        }




.carousel-btn:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

/* No Catatan Style */
.no-catatan {
    text-align: center;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 8px;
    color: #666;
}

/* Responsive Design */
@media (max-width: 768px) {
    .catatan-card {
        flex: 0 0 80%; /* Smaller width for mobile */
    }
}


    .no-catatan {
        grid-column: 1 / -1;
        text-align: center;
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 8px;
        color: #666;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            align-items: flex-start;
        }

        .salary-grid {
            grid-template-columns: 1fr;
        }

        .class-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .catatan-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <a href="../mentor/mentor.php">
                <img src="../../../../assets/images/logo.svg" alt="KelasSore Logo">
            </a>
        </div>
        <div class="buttons">
            <?php if (!isset($_SESSION['user_id']) && !isset($_SESSION['mentor_id'])): ?>
                <a href="/views/pages/login/login.php" class="login">Log in</a>
                <a href="/views/pages/register/register.php" class="join">Join</a>
            <?php elseif (isset($_SESSION['mentor_id'])): ?>
                <a href="logout.php" class="logout">Log Out</a>
                <a href="profile.php" class="Profile">Profile</a>
            <?php elseif (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="logout">Log Out</a>
                
            <?php endif; ?>
        </div>
    </header>

    <section class="your-class">
        <div class="container">
            <div class="section-header">
                <h2>Your Class</h2>
            </div>
            <div class="class-grid">
                <?php if (!empty($mentorClasses)): ?>
                    <?php foreach ($mentorClasses as $class): ?>
                        <a href="../class/index.php?id=<?= urlencode($class['id']); ?>" class="class-card-link">
                            <div class="class-card">
                                <img src="../../../../assets/images/uploads/<?= htmlspecialchars($class['image']) ?>" 
                                     alt="<?= htmlspecialchars($class['name']) ?>" 
                                     onerror="this.src='../../../../assets/images/kursus.svg'">
                                <h3><?= htmlspecialchars($class['name']) ?></h3>
                                <div class="class-details">
                                    <p>Category: <?= htmlspecialchars($class['category']) ?></p>
                                    <p>Jadwal: <?= htmlspecialchars($class['schedule']) ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-classes">
                        <p>No classes found. Start creating your first class!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="salary-status">
        <div class="container">
            <div class="section-header">
                <h2>Status Gaji</h2>
            </div>
            <div class="salary-grid">
                <div class="salary-card received">
                    <h3>Gaji Diterima</h3>
                    <p>Rp <?= number_format($salaryReceived, 0, ',', '.') ?></p>
                </div>
                <div class="salary-card pending">
                    <h3>Gaji Belum Diterima</h3>
                    <p>Rp <?= number_format($salaryRemaining, 0, ',', '.') ?></p>
                </div>
            </div>
        </div>
    </section>
    <section>
    <div class="section-header">
        <h2>Catatan dari Murid</h2>
    </div>

    <div class="carousel-container">
        <div class="carousel-track">
            <?php if (!empty($catatanList)): ?>
                <?php foreach ($catatanList as $catatan): ?>
                    <div class="catatan-card">
                        <h3><?= htmlspecialchars($catatan['title']) ?></h3>
                        <p><?= nl2br(htmlspecialchars($catatan['content'])) ?></p>
                        <small><?= date('d M Y', strtotime($catatan['created_at'])) ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-catatan">
                    <p>Belum ada catatan tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

    
</section>



    <?php include('/PhpWeb/views/layouts/footer.php'); ?>
    <script>
        const track = document.querySelector('.carousel-track');
        const prevButton = document.querySelector('.prev-btn');
        const nextButton = document.querySelector('.next-btn');

        let currentIndex = 0;

        function updateCarousel() {
            const cardWidth = document.querySelector('.catatan-card').offsetWidth + 16; // Card width + margin
            track.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        }


        // Auto-scroll every 5 seconds
        setInterval(() => {
            const cardCount = document.querySelectorAll('.catatan-card').length;
            currentIndex = (currentIndex + 1) % cardCount;
            updateCarousel();
        }, 5000);
    </script>
    
</body>
</html>