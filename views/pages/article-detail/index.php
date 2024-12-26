<?php
// Start the session to check login status
session_start();

// Include your article controller
require_once dirname(__FILE__) . '/../../../controllers/ArtikelController.php';
$artikelController = new ArtikelController();

// Check if the article ID is provided via URL
if (isset($_GET['id'])) {
    $artikelId = $_GET['id'];
    // Get article details by ID
    $article = $artikelController->getArtikelById($artikelId);
} else {
    // Handle case where article ID is not provided
    echo "Artikel tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Artikel</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        /* Apply Roboto font for header */
        header, .article-header h1, .article-subtitle h3 {
            font-family: 'Roboto', sans-serif;
        }

        /* Apply Quicksand font for paragraph and other text */
        body, .article-content p {
            font-family: 'Quicksand', sans-serif;
            font-size: larger;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        
        }
        .article-header h1 {
            text-align: center;
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
            color: #001A45;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 10%;
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
        }

        header .logo img {
            max-height: 50px;
        }

        header .buttons {
            display: flex;
            gap: 10px;
        }

        header .buttons a {
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        header .buttons .join {
            background-color: #001A45;
            color: #fff;
        }

        header .buttons .login {
            background-color: #fff;
            border: 2px solid #001A45;
            color: #001A45;
        }

        header .buttons .logout {
            background-color: #fff;
            border: 2px solid #f44336;
            color: #f44336;
        }
        

        header .buttons a:hover {
            opacity: 0.8;
        }

        .article-header {
            margin-bottom: 20px;
        }

       
.article-content {
    font-family: 'Quicksand', sans-serif;
    font-weight: 500;
}
        .article-header .text-muted
         {
            text-align: center;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
            }

            .hero .text {
                max-width: 100%;
                margin-bottom: 20px;
            }

            .hero .images {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="logo">
            <a href="../home/home.php">
                <img src="../../../../assets/images/logo.svg" alt="KelasSore Logo">
            </a>
        </div>
        <div class="buttons">
            <?php
            if (!isset($_SESSION['user_id']) && !isset($_SESSION['mentor_id'])) {
                // If not logged in, display "Log In" and "Join" buttons
                echo '<a href="/views/pages/login/login.php" class="login">Log in</a>';
                echo '<a href="/views/pages/register/register.php" class="join">Join</a>';
            } elseif (isset($_SESSION['mentor_id']) || isset($_SESSION['user_id'])) {
                // If logged in, display "Log Out" button
                echo '<a href="logout.php" class="logout">Log Out</a>';
            }
            ?>
        </div>
    </header>

    <!-- Main Content Section -->
    <div class="container mt-5">
        <div class="row">
            <!-- Article Column -->
            <div class="col-md-8 mx-auto">
                <!-- Article Header -->
                <div class="article-header mb-4 ">
                    <h1 class="display-4"><?php echo htmlspecialchars($article['title']); ?></h1>
                    <p class="text-muted">Dipublikasikan: <?php echo date('d M Y', strtotime($article['created_at'])); ?></p>
                </div>

                <!-- Article Image -->
                <div class="article-image mb-4">
                    <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="Gambar Artikel" class="img-fluid w-100">
                </div>

                <!-- Article Subtitle -->
                <div class="article-subtitle mb-4">
                    <h3 class="h4"><?php echo htmlspecialchars($article['subtitle']); ?></h3>
                </div>

                <!-- Divider -->
                <div class="my-4 border-top"></div>

                <!-- Article Content -->
                <div class="article-content">
                    <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
                </div>

               
        </div>
        
    </div>
</div>

    <!-- Bootstrap JS (Optional for Bootstrap components like dropdowns, modals, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
<footer>
<?php
    include_once dirname(__FILE__) . '/../../layouts/footer.php'; 
?>
</footer>
</html>
