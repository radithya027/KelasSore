<?php
// Kode saat ini hanya secara langsung memasukkan halaman home
// Ini memiliki beberapa kelemahan:
// 1. Tidak fleksibel untuk navigasi antar halaman
// 2. Tidak mendukung mekanisme routing dinamis
// 3. Tidak dapat menangani berbagai halaman berbeda

// Solusi yang lebih baik:
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

$allowedPages = ['home', 'checkout', 'login', 'register', 'userprofile', 'mentor', 'loginmentor'];

if (in_array($page, $allowedPages)) {
    // Konstruksi path file secara dinamis
    $pagePath = "views/pages/{$page}/{$page}.php";
    
    if (file_exists($pagePath)) {
        include $pagePath;
    } else {
        // Tangani jika halaman tidak ditemukan
        echo "Halaman tidak ditemukan";
    }
} else {
    include "views/pages/home/home.php";
}
?>