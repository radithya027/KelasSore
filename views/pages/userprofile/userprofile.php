<?php
// File: views/pages/userprofile/userprofile.php
// Start the session at the beginning
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: /login.php');
    exit();
}

// Get current user ID from session
$userId = $_SESSION['user_id'];

// Initialize UserController with correct path
include dirname(__FILE__) . '/../../../controllers/UserController.php';
require_once dirname(__FILE__) . '/../../../controllers/BookController.php';
require_once dirname(__FILE__) . '/../../../models/BookModel.php';
require_once dirname(__FILE__) . '/../../../services/database.php';

$userController = new UserController();
$bookController = new BookController();

// Fetch current user's data
$user = $userController->getUserProfile($userId);
$books = $bookController->getAllBooks();

// If user data couldn't be fetched, redirect to login
if (!$user) {
    session_destroy();
    header('Location: /login.php');
    exit();
}

// Default profile picture as SVG (Base64 encoded)
$defaultProfilePicture = 'data:image/svg+xml;base64,' . base64_encode('
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ddd" width="80px" height="80px">
    <circle cx="12" cy="8" r="4" />
    <path d="M12 14c-5 0-9 2.5-9 5v1h18v-1c0-2.5-4-5-9-5z"/>
</svg>
');

// Determine which profile picture to use
$profilePicture = !empty($user['profile_picture']) ? $user['profile_picture'] : $defaultProfilePicture;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f5f6fa;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #333;
            font-size: 24px;
        }
        .search-profile {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .search-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .profile-section {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .profile-header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }
        .btn {
            transition: background 0.3s ease;
        }
        
        /* Book Section Styles */
        .private-courses {
            margin-top: 30px;
        }
        .private-cards-wrapper {
            display: flex;
            overflow-x: auto;
            gap: 20px;
            padding-bottom: 20px;
        }
        .private-card {
            min-width: 250px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .private-card:hover {
            transform: scale(1.05);
        }
        .private-card-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .private-card-content {
            padding: 15px;
        }
        .title {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome, <?php echo htmlspecialchars(explode(' ', $user['name'])[0]); ?></h1>
            <div class="search-profile">
                <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture">
            </div>
        </div>

        <div class="profile-section">
            <div class="profile-header">
                <div class="profile-header-left">
                    <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture" class="profile-image">
                    <div>
                        <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                        <p><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                </div>
            </div>

            <form action="#" method="POST">
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
                </div>
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                </div>
                <div class="form-group mb-3">
                    <label>Phone Number</label>
                    <input type="tel" class="form-control" value="<?php echo htmlspecialchars($user['phone_number']); ?>" readonly>
                </div>

                <!-- Tombol Logout dengan modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Book Section -->
    <div class="container mt-4">
        <h1 class="title">Buku</h1>
        <section class="private-courses">
            <div class="private-container">
                <div class="private-cards-wrapper">
                    <?php foreach($books as $book): ?>
                    <div class="private-card" data-book-id="<?php echo $book['id']; ?>" data-ebook-file="<?php echo htmlspecialchars($book['ebook_file']); ?>">
                        <div class="private-card-image">
                        <?php
                        $imagePath = str_replace('../public', '/public', htmlspecialchars($book['image']));
                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath)) {
                            $imageUrl = $imagePath;
                        } else {
                            $imageUrl = '/public/image-book/6752af8606088_commandermewing.png'; // Fallback image
                        }
                        ?>
                        <img src="<?php echo $imageUrl; ?>" alt="Book Thumbnail">
                        </div>
                        <div class="private-card-content">
                        <h3 class="private-course-title"><?php echo htmlspecialchars($book['title']); ?></h3>
                        <p class="private-instructor-name"><?php echo htmlspecialchars($book['description']); ?></p>
                        <div class="private-card-stats">  
                            <div class="private-students"><?php echo $book['rating']; ?> Rating</div>
                        </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Konfirmasi Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="../userprofile/logout.php" method="POST">
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookCards = document.querySelectorAll('.private-card');
        bookCards.forEach(card => {
            card.addEventListener('click', function() {
                const bookId = this.getAttribute('data-book-id');
                
                if (bookId) {
                    // Create a download link and trigger it
                    window.location.href = '/views/pages/class/dowload-ebook.php?book_id=' + bookId;
                } else {
                    alert('Ebook file not available for this book.');
                }
            });
        });

        // Swipe functionality for book cards
        const privateCardsWrapper = document.querySelector('.private-cards-wrapper');
        let isDown = false;
        let startX;
        let scrollLeft;

        privateCardsWrapper.addEventListener('mousedown', (e) => {
            isDown = true;
            privateCardsWrapper.classList.add('active');
            startX = e.pageX - privateCardsWrapper.offsetLeft;
            scrollLeft = privateCardsWrapper.scrollLeft;
        });

        privateCardsWrapper.addEventListener('mouseleave', () => {
            isDown = false;
            privateCardsWrapper.classList.remove('active');
        });

        privateCardsWrapper.addEventListener('mouseup', () => {
            isDown = false;
            privateCardsWrapper.classList.remove('active');
        });

        privateCardsWrapper.addEventListener('mousemove', (e) => {
            if(!isDown) return;
            e.preventDefault();
            const x = e.pageX - privateCardsWrapper.offsetLeft;
            const walk = (x - startX) * 2; // Scroll-fast
            privateCardsWrapper.scrollLeft = scrollLeft - walk;
        });
    });
    </script>
</body>
</html>