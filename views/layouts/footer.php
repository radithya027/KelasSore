<!-- Footer Container -->
<style>
.footer {
    background-color: #F3F7FF;
    width: 100%;
    padding: 48px 24px;
    border-top: 1px solid #e5e7eb;
    position: relative;
}

.footer-container {
    max-width: 1280px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    gap: 48px;
}

.footer-left {
    flex: 0 0 300px;
}

.company-logo {
    font-size: 24px;
    font-weight: bold;
    color: #1a237e;
    margin-bottom: 16px;
}

.company-desc {
    color: #4b5563;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 24px;
}

.footer-social {
    display: flex;
    gap: 16px;
}

.footer-social a {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background-color: #e8eeff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #4b5563;
    transition: all 0.2s;
}

.footer-social a:hover {
    background-color: #1a237e;
    color: white;
}

.footer-right {
    flex: 0 0 300px;
}

.contact-info {
    margin-bottom: 24px;
}

.contact-info h3 {
    font-size: 18px;
    color: #111827;
    margin-bottom: 16px;
}

.contact-info p {
    color: #4b5563;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 8px;
}

.chat-button {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background-color: #1a237e;
    color: white;
    padding: 12px 24px;
    border-radius: 24px;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.chat-button:hover {
    transform: translateY(-2px);
}

.footer-bottom {
    margin-top: 48px;
    padding-top: 24px;
    border-top: 1px solid #e5e7eb;
    text-align: center;
    color: #4b5563;
    font-size: 14px;
}

@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
    }
    
    .footer-left, .footer-right {
        flex: 1;
    }
}
</style>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-left">
            <div class="company-logo">
                KelasSore.com
            </div>
            <div class="company-desc">
                Platform digital education belajar yang memberikan materi seputar dunia pendidikan, karir dan bisnis.
            </div>
            <div class="footer-social">
                <a href="#" aria-label="Facebook"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385h-3.047v-3.47h3.047v-2.642c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953h-1.514c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385c5.737-.9 10.125-5.864 10.125-11.854z"/></svg></a>
                <a href="#" aria-label="YouTube"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg></a>
                <a href="#" aria-label="TikTok"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg></a>
                <a href="#" aria-label="Instagram"><svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
            </div>
        </div>
        
        <div class="footer-right">
            <div class="contact-info">
                <h3>Info Kontak</h3>
                <p>Jl. Turi KM 1, Kepitu, Trimulyo, Kec. Sleman, Kab. Sleman, Yogyakarta 55513</p>
                <p>Tlp : +62 821-3574-3961</p>
                <p>WA : +62 821-3574-3961</p>
                <p>info@kelassore.com</p>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        Copyright © 2024 Kelas Sore | Powered by IT Solution
    </div>
</footer>