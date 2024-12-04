<!-- <h1 class="title">Buku</h1>
<section class="private-courses">
  <div class="private-container">
    <div class="private-cards-wrapper">
      <div class="private-card">
        <div class="private-card-image">
          <img src="assets/images/kursus.svg" alt="Course Thumbnail">
        </div>
        <div class="private-card-content">
          <h3 class="private-course-title">Internet and Web Development Fundamentals</h3>
          <p class="private-instructor-name">Sarah Lee</p>
          <p class="private-price">$79.99</p>
          <div class="private-card-stats">
            <div class="private-rating">
              <span>⭐</span>4.9
            </div>
            <div class="private-students">20,459+</div>
            <div class="private-avatars">
              <img src="assets/images/kursus.svg" alt="Student 1">
              <img src="assets/images/kursus.svg" alt="Student 2">
            </div>
          </div>
        </div>
      </div>
      <div class="private-card">
        <div class="private-card-image">
          <img src="assets/images/kursus.svg" alt="Course Thumbnail">
        </div>
        <div class="private-card-content">
          <h3 class="private-course-title">Internet and Web Development Fundamentals</h3>
          <p class="private-instructor-name">Sarah Lee</p>
          <p class="private-price">$79.99</p>
          <div class="private-card-stats">
            <div class="private-rating">
              <span>⭐</span>4.9
            </div>
            <div class="private-students">20,459+</div>
            <div class="private-avatars">
              <img src="assets/images/kursus.svg" alt="Student 1">
              <img src="assets/images/kursus.svg" alt="Student 2">
            </div>
          </div>
        </div>
      </div>
      <div class="private-card">
        <div class="private-card-image">
          <img src="assets/images/kursus.svg" alt="Course Thumbnail">
        </div>
        <div class="private-card-content">
          <h3 class="private-course-title">Internet and Web Development Fundamentals</h3>
          <p class="private-instructor-name">Sarah Lee</p>
          <p class="private-price">$79.99</p>
          <div class="private-card-stats">
            <div class="private-rating">
              <span>⭐</span>4.9
            </div>
            <div class="private-students">20,459+</div>
            <div class="private-avatars">
              <img src="assets/images/kursus.svg" alt="Student 1">
              <img src="assets/images/kursus.svg" alt="Student 2">
            </div>
          </div>
        </div>
      </div>
      <div class="private-card">
        <div class="private-card-image">
          <img src="assets/images/kursus.svg" alt="Course Thumbnail">
        </div>
        <div class="private-card-content">
          <h3 class="private-course-title">Internet and Web Development Fundamentals</h3>
          <p class="private-instructor-name">Sarah Lee</p>
          <p class="private-price">$79.99</p>
          <div class="private-card-stats">
            <div class="private-rating">
              <span>⭐</span>4.9
            </div>
            <div class="private-students">20,459+</div>
            <div class="private-avatars">
              <img src="assets/images/kursus.svg" alt="Student 1">
              <img src="assets/images/kursus.svg" alt="Student 2">
            </div>
          </div>
        </div>
      </div>
      <div class="private-card">
        <div class="private-card-image">
          <img src="assets/images/kursus.svg" alt="Course Thumbnail">
        </div>
        <div class="private-card-content">
          <h3 class="private-course-title">Internet and Web Development Fundamentals</h3>
          <p class="private-instructor-name">Sarah Lee</p>
          <p class="private-price">$79.99</p>
          <div class="private-card-stats">
            <div class="private-rating">
              <span>⭐</span>4.9
            </div>
            <div class="private-students">20,459+</div>
            <div class="private-avatars">
              <img src="assets/images/kursus.svg" alt="Student 1">
              <img src="assets/images/kursus.svg" alt="Student 2">
            </div>
          </div>
        </div>
      </div>
      <div class="private-card">
        <div class="private-card-image">
          <img src="assets/images/kursus.svg" alt="Course Thumbnail">
        </div>
        <div class="private-card-content">
          <h3 class="private-course-title">Internet and Web Development Fundamentals</h3>
          <p class="private-instructor-name">Sarah Lee</p>
          <p class="private-price">$79.99</p>
          <div class="private-card-stats">
            <div class="private-rating">
              <span>⭐</span>4.9
            </div>
            <div class="private-students">20,459+</div>
            <div class="private-avatars">
              <img src="assets/images/kursus.svg" alt="Student 1">
              <img src="assets/images/kursus.svg" alt="Student 2">
            </div>
          </div>
        </div>
      </div>
  </div>
</section>

<script>
 document.addEventListener('DOMContentLoaded', function() {
  const privateCardsWrapper = document.querySelector('.private-cards-wrapper');
  let scrollAmount = 0;
  const cardWidth = document.querySelector('.private-card').offsetWidth + 20; // Card width + margin/padding

  // Auto-slide setiap 3 detik
  setInterval(() => {
    if (scrollAmount < privateCardsWrapper.scrollWidth - privateCardsWrapper.offsetWidth) {
      scrollAmount += cardWidth;
      privateCardsWrapper.scrollTo({
        left: scrollAmount,
        behavior: 'smooth'
      });
    } else {
      scrollAmount = 0;
      privateCardsWrapper.scrollTo({
        left: scrollAmount,
        behavior: 'smooth'
      });
    }
  }, 3000);

  // Fitur swipe di perangkat mobile
  let touchStartX = 0;
  let touchEndX = 0;

  privateCardsWrapper.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
  });

  privateCardsWrapper.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
  });

  function handleSwipe() {
    if (touchStartX - touchEndX > 50) {
      // Geser ke kanan
      if (scrollAmount < privateCardsWrapper.scrollWidth - privateCardsWrapper.offsetWidth) {
        scrollAmount += cardWidth;
        privateCardsWrapper.scrollTo({
          left: scrollAmount,
          behavior: 'smooth'
        });
      }
    }

    if (touchEndX - touchStartX > 50) {
      // Geser ke kiri
      if (scrollAmount > 0) {
        scrollAmount -= cardWidth;
        privateCardsWrapper.scrollTo({
          left: scrollAmount,
          behavior: 'smooth'
        });
      }
    }
  }
});

</script> -->