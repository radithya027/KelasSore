document.addEventListener('DOMContentLoaded', function() {
    const privateCardsWrapper = document.querySelector('.private-cards-wrapper');
    let scrollAmount = 0;
    const cardWidth = document.querySelector('.private-card').offsetWidth + 20; 
    
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
        if (scrollAmount < privateCardsWrapper.scrollWidth - privateCardsWrapper.offsetWidth) {
          scrollAmount += cardWidth;
          privateCardsWrapper.scrollTo({
            left: scrollAmount,
            behavior: 'smooth'
          });
        }
      }
  
      if (touchEndX - touchStartX > 50) {
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
  
  