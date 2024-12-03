// Function to handle intersection observer callback
function handleIntersection(entries, observer) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Element is in view, add the 'show' class and remove 'fade-out'
            entry.target.classList.add('show');
            entry.target.classList.remove('fade-out');
        } else {
            // Element is out of view, add the 'fade-out' class and remove 'show'
            entry.target.classList.add('fade-out');
            entry.target.classList.remove('show');
        }
    });
}

// Create the Intersection Observer
const options = {
    root: null, // Use the viewport as the root
    rootMargin: '0px',
    threshold: 0.1 // Trigger when 10% of the element is visible
};

const observer = new IntersectionObserver(handleIntersection, options);

// Observe all elements with animation classes
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.fade-up, .fade-in, .slide-in-left, .slide-in-right');
    
    animatedElements.forEach(element => {
        observer.observe(element);
    });
});
