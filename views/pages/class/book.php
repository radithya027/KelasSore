<?php
// Gunakan path absolut atau dirname untuk mencari path controller
require_once dirname(__DIR__, 3) . '/controllers/BookController.php';
require_once dirname(__DIR__, 3) . '/models/BookModel.php';
require_once dirname(__DIR__, 3) . '/services/database.php';

$bookController = new BookController();
$books = $bookController->getAllBooks();
?>

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

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Existing scroll and swipe code...

    // Add click event listener to book cards for download
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

    // Existing scroll and touch code...
  });
</script>
