<?php
// Gunakan path absolut atau dirname untuk mencari path controller
require_once dirname(__DIR__, 3) . '/controllers/BookController.php';
require_once dirname(__DIR__, 3) . '/models/BookModel.php';
require_once dirname(__DIR__, 3) . '/services/database.php';

$bookController = new BookController();
$books = $bookController->getAllBooks();
?>

<style>
.private-courses {
    padding: 2rem 0;
    width: 100%;
}

.private-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

.private-cards-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    padding: 1rem;
}

.private-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
    cursor: pointer;
    min-height: 400px;
    display: flex;
    flex-direction: column;
}

.private-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.private-card-image {
    width: 100%;
    height: 250px;
    overflow: hidden;
}

.private-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.private-card:hover .private-card-image img {
    transform: scale(1.05);
}

.private-card-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.private-course-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.private-instructor-name {
    font-size: 1rem;
    color: #666;
    margin-bottom: 1rem;
    line-height: 1.5;
    flex-grow: 1;
}

.private-card-stats {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.private-students {
    font-size: 0.95rem;
    color: #555;
    font-weight: 500;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .private-cards-wrapper {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
    
    .private-card {
        min-height: 350px;
    }
    
    .private-card-image {
        height: 200px;
    }
    
    .private-course-title {
        font-size: 1.25rem;
    }
}
</style>

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const bookCards = document.querySelectorAll('.private-card');
    bookCards.forEach(card => {
        card.addEventListener('click', function() {
            const bookId = this.getAttribute('data-book-id');
            
            if (bookId) {
                window.location.href = '/views/pages/class/dowload-ebook.php?book_id=' + bookId;
            } else {
                alert('Ebook file not available for this book.');
            }
        });
    });
});
</script>