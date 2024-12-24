<?php
// File: views/layouts/footer.php
$popularCourses = [
    'Python for Data Science',
    'Digital Marketing Masterclass',
    'Project Management Professional (PMP)',
    'Graphic Design for Beginners',
    'Full-Stack Web Development',
    'Advanced Excel Techniques',
    'Microsoft Power BI Data Analyst',
    'Professional Certification',
    'Product UX Design Certificate',
    'All Courses'
];

$categories = [
    'Technology',
    'IT & Software',
    'Art & Design',
    'Marketing',
    'Health & Fitness',
    'Personal Development',
    'Math & Logic',
    'Language Learning',
    'All Categories'
];

$aboutCompany = [
    'About Us',
    'What We Offer',
    'Careers',
    'Leadership',
    'For Enterprise',
    'Become a Partner',
    'Press & Media',
    'Contact Us',
    'Catalog',
    'Help & Support'
];

$community = [
    'Instructor Community',
    'Learner Stories',
    'Forums & Discussions',
    'Events & Webinars',
    'Partnerships',
    'Affiliate Program'
];
?>

<style>
.footer {
    background-color: #F3F7FF;
    padding: 48px 24px;
    border-top: 1px solid #e5e7eb;
}

.footer-container {
    max-width: 1280px;
    margin: 0 auto;
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 32px;
    margin-bottom: 48px;
}

.footer-column h3 {
    font-weight: 600;
    color: #111827;
    margin-bottom: 16px;
    font-size: 16px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 8px;
}

.footer-links a {
    color: #4b5563;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.2s;
}

.footer-links a:hover {
    color: #111827;
}

.footer-bottom {
    padding-top: 32px;
    margin-top: 32px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

.footer-copyright {
    color: #4b5563;
    font-size: 14px;
    order: 1;
}

.footer-social-links {
    display: flex;
    gap: 24px;
    order: 2;
}

.footer-social-links a {
    color: #4b5563;
    transition: color 0.2s;
    display: inline-flex;
    align-items: center;
}

.footer-social-links a:hover {
    color: #111827;
}

@media (max-width: 1024px) {
    .footer-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .footer-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .footer-grid {
        grid-template-columns: 1fr;
    }
    
    .footer-bottom {
        flex-direction: column;
        gap: 24px;
        text-align: center;
    }
    
    .footer-copyright {
        order: 2;
    }
    
    .footer-social-links {
        order: 1;
        justify-content: center;
        width: 100%;
        flex-wrap: wrap;
    }
}
</style>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-grid">
            <div class="footer-column">
                <h3>Popular Courses</h3>
                <ul class="footer-links">
                    <?php foreach($popularCourses as $course): ?>
                        <li><a href="#"><?php echo $course; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Popular Categories</h3>
                <ul class="footer-links">
                    <?php foreach($categories as $category): ?>
                        <li><a href="#"><?php echo $category; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>About Company</h3>
                <ul class="footer-links">
                    <?php foreach($aboutCompany as $item): ?>
                        <li><a href="#"><?php echo $item; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <div class="footer-column">
                <h3>Community</h3>
                <ul class="footer-links">
                    <?php foreach($community as $item): ?>
                        <li><a href="#"><?php echo $item; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="footer-copyright">
                © <?php echo date('Y'); ?> Kelas Sore All rights reserved.
            </div>
            <div class="footer-social-links">
                <a href="#" aria-label="Instagram"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                <a href="#" aria-label="YouTube"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg></a>
                <a href="#" aria-label="TikTok"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg></a>
                <a href="#" aria-label="Facebook"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385h-3.047v-3.47h3.047v-2.642c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.514c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385c5.737-.9 10.125-5.864 10.125-11.854z"/></svg></a>
                <a href="#" aria-label="Twitter"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a>
                <a href="#" aria-label="GitHub"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg></a>
            </div>
        </div>
    </div>
</footer>