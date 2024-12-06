<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Features</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&display=swap" rel="stylesheet">
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const details = document.querySelectorAll('details');
    
    details.forEach((detail) => {
        const content = detail.querySelector('.list-items');
        const summary = detail.querySelector('summary');
        
        // Add transition properties to content
        content.style.transition = 'all 0.3s ease';
        
        summary.addEventListener('click', (e) => {
            e.preventDefault();
            
            // If already open, close with animation
            if (detail.hasAttribute('open')) {
                content.style.maxHeight = '0';
                content.style.opacity = '0';
                
                setTimeout(() => {
                    detail.removeAttribute('open');
                }, 300);
                return;
            }
            
            // Close all other details with animation
            details.forEach((otherDetail) => {
                if (otherDetail !== detail && otherDetail.hasAttribute('open')) {
                    const otherContent = otherDetail.querySelector('.list-items');
                    otherContent.style.maxHeight = '0';
                    otherContent.style.opacity = '0';
                    
                    setTimeout(() => {
                        otherDetail.removeAttribute('open');
                    }, 300);
                }
            });
            detail.setAttribute('open', '');
            content.getBoundingClientRect();
            content.style.maxHeight = content.scrollHeight + 'px';
            content.style.opacity = '1';
        });
        
        if (!detail.hasAttribute('open')) {
            content.style.maxHeight = '0';
            content.style.opacity = '0';
        }
    });
});
    </script>
</head>
<body>
    <div class="row-container">
        <!-- Accordion Section -->
        <div class="accordion">
            <details>
                <summary>
                    <span class="summary-text">What you'll Learn</span>
                    <span class="arrow-icon">▼</span>
                </summary>
                <ul class="list-items">
                    <li><span class="checkmark">✓</span> Prepare for Industry Certification Exam</li>
                    <li><span class="checkmark">✓</span> Over 25 Engaging Lab Exercises</li>
                    <li><span class="checkmark">✓</span> Comprehensive Coverage of HTML and CSS</li>
                    <li><span class="checkmark">✓</span> Dozens of Code Examples to Download and Study</li>
                    <li><span class="checkmark">✓</span> Hours and Hours of Video Instruction</li>
                    <li><span class="checkmark">✓</span> Earn Certification that is Proof of your Competence</li>
                </ul>
            </details>
            <h2>Course Curriculum Breakdown</h2>
            <details>
                <summary>
                    <span class="summary-text">Module 1: Introduction to Web Development</span>
                    <span class="arrow-icon">▼</span>
                </summary>
                <ul class="list-items">
                    <li><span class="checkmark">✓</span> Prepare for Industry Certification Exam</li>
                    <li><span class="checkmark">✓</span> Over 25 Engaging Lab Exercises</li>
                    <li><span class="checkmark">✓</span> Comprehensive Coverage of HTML and CSS</li>
                    <li><span class="checkmark">✓</span> Dozens of Code Examples to Download and Study</li>
                    <li><span class="checkmark">✓</span> Hours and Hours of Video Instruction</li>
                    <li><span class="checkmark">✓</span> Earn Certification that is Proof of your Competence</li>
                </ul>
            </details>
            <details>
                <summary>
                    <span class="summary-text">Module 1: Introduction to Web Development</span>
                    <span class="arrow-icon">▼</span>
                </summary>
                <ul class="list-items">
                    <li><span class="checkmark">✓</span> Prepare for Industry Certification Exam</li>
                    <li><span class="checkmark">✓</span> Over 25 Engaging Lab Exercises</li>
                    <li><span class="checkmark">✓</span> Comprehensive Coverage of HTML and CSS</li>
                    <li><span class="checkmark">✓</span> Dozens of Code Examples to Download and Study</li>
                    <li><span class="checkmark">✓</span> Hours and Hours of Video Instruction</li>
                    <li><span class="checkmark">✓</span> Earn Certification that is Proof of your Competence</li>
                </ul>
            </details>
            <details>
                <summary>
                    <span class="summary-text">Module 1: Introduction to Web Development</span>
                    <span class="arrow-icon">▼</span>
                </summary>
                <ul class="list-items">
                    <li><span class="checkmark">✓</span> Prepare for Industry Certification Exam</li>
                    <li><span class="checkmark">✓</span> Over 25 Engaging Lab Exercises</li>
                    <li><span class="checkmark">✓</span> Comprehensive Coverage of HTML and CSS</li>
                    <li><span class="checkmark">✓</span> Dozens of Code Examples to Download and Study</li>
                    <li><span class="checkmark">✓</span> Hours and Hours of Video Instruction</li>
                    <li><span class="checkmark">✓</span> Earn Certification that is Proof of your Competence</li>
                </ul>
            </details>
            <details>
                <summary>
                    <span class="summary-text">Module 1: Introduction to Web Development</span>
                    <span class="arrow-icon">▼</span>
                </summary>
                <ul class="list-items">
                    <li><span class="checkmark">✓</span> Prepare for Industry Certification Exam</li>
                    <li><span class="checkmark">✓</span> Over 25 Engaging Lab Exercises</li>
                    <li><span class="checkmark">✓</span> Comprehensive Coverage of HTML and CSS</li>
                    <li><span class="checkmark">✓</span> Dozens of Code Examples to Download and Study</li>
                    <li><span class="checkmark">✓</span> Hours and Hours of Video Instruction</li>
                    <li><span class="checkmark">✓</span> Earn Certification that is Proof of your Competence</li>
                </ul>
            </details>
            <details>
                <summary>
                    <span class="summary-text">Module 1: Introduction to Web Development</span>
                    <span class="arrow-icon">▼</span>
                </summary>
                <ul class="list-items">
                    <li><span class="checkmark">✓</span> Prepare for Industry Certification Exam</li>
                    <li><span class="checkmark">✓</span> Over 25 Engaging Lab Exercises</li>
                    <li><span class="checkmark">✓</span> Comprehensive Coverage of HTML and CSS</li>
                    <li><span class="checkmark">✓</span> Dozens of Code Examples to Download and Study</li>
                    <li><span class="checkmark">✓</span> Hours and Hours of Video Instruction</li>
                    <li><span class="checkmark">✓</span> Earn Certification that is Proof of your Competence</li>
                </ul>
            </details>
            <details>
                <summary>
                    <span class="summary-text">Module 1: Introduction to Web Development</span>
                    <span class="arrow-icon">▼</span>
                </summary>
                <ul class="list-items">
                    <li><span class="checkmark">✓</span> Prepare for Industry Certification Exam</li>
                    <li><span class="checkmark">✓</span> Over 25 Engaging Lab Exercises</li>
                    <li><span class="checkmark">✓</span> Comprehensive Coverage of HTML and CSS</li>
                    <li><span class="checkmark">✓</span> Dozens of Code Examples to Download and Study</li>
                    <li><span class="checkmark">✓</span> Hours and Hours of Video Instruction</li>
                    <li><span class="checkmark">✓</span> Earn Certification that is Proof of your Competence</li>
                </ul>
            </details>
            <details>
                <summary>
                    <span class="summary-text">Module 1: Introduction to Web Development</span>
                    <span class="arrow-icon">▼</span>
                </summary>
                <ul class="list-items">
                    <li><span class="checkmark">✓</span> Prepare for Industry Certification Exam</li>
                    <li><span class="checkmark">✓</span> Over 25 Engaging Lab Exercises</li>
                    <li><span class="checkmark">✓</span> Comprehensive Coverage of HTML and CSS</li>
                    <li><span class="checkmark">✓</span> Dozens of Code Examples to Download and Study</li>
                    <li><span class="checkmark">✓</span> Hours and Hours of Video Instruction</li>
                    <li><span class="checkmark">✓</span> Earn Certification that is Proof of your Competence</li>
                </ul>
            </details>
            
        </div>

        <!-- Cards Section -->
        <div class="card-container">
            <!-- Course Features -->
            <div class="card-coursesfeature">
                <h4 class="hai">Course Features</h4>
                <ul>
        <li><i class="bi bi-pin-fill pinned-icon"></i> Beginner to Advanced</li>
        <li><i class="bi bi-pin-fill pinned-icon"></i> 80+ hours of video content</li>
        <li><i class="bi bi-pin-fill pinned-icon"></i> 15 modules with over 150 lessons</li>
        <li><i class="bi bi-pin-fill pinned-icon"></i> Professional Certificate upon completion</li>
        <li><i class="bi bi-pin-fill pinned-icon"></i> Professional Certificate upon completion</li>
        <li><i class="bi bi-pin-fill pinned-icon"></i> Professional Certificate upon completion</li>
        <li><i class="bi bi-pin-fill pinned-icon"></i> Professional Certificate upon completion</li>
        <li><i class="bi bi-pin-fill pinned-icon"></i> Professional Certificate upon completion</li>
        <li><i class="bi bi-pin-fill pinned-icon"></i> Professional Certificate upon completion</li>
        <li><i class="bi bi-pin-fill pinned-icon"></i> Professional Certificate upon completion</li>
        <li><i class="bi bi-pin-fill pinned-icon"></i> Professional Certificate upon completion</li>
    </ul>

                <button class="buy-now">Buy Now</button>
            </div>

            <div class="card-coursesfeature1">
    <h4>Instructor Profile</h4>
    <div class="avatar-text">
        <div class="avatar-container">
            <img class="avatar" src="assets/images/1fdd264b4b531494b306bf6994d7448c.jpg" alt="Avatar">
        </div>
        <div class="text">
            <p><strong>Angela Yu</strong></p>
            <p>Lead Instructor, Software Engineer</p>
        </div>
    </div>
    <ul class="list-itemscolumn">
    <li>
        10+ years Experience 
        <span class="divider"></span>
    </li>
    <li>
        20,450+ Reviews
        <span class="divider"></span>
    </li>
    <li>
        25+ Courses
        <span class="divider"></span>
    </li>
    <li><a href="#">Follow on LinkedIn</a></li>
</ul>
    <button class="buy-nowcek">Learn More about</button>
</div>
        </div>
    </div>
</body>


</html>

