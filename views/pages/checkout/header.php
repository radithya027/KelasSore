<!DOCTYPE html>
<html lang="en">
<header>
    <!-- File ini berisi tag <head> yang berisi meta tag, title, dan link CSS -->
    <div class="logo">
        <a href="../home/home.php"> <!-- Ganti "/index.php" dengan URL halaman home/dashboard Anda -->
            <img src="../../../../assets/images/logo.svg" alt="KelasSore Logo">
        </a>
    </div>
    <div class="buttons">
        <?php
        session_start(); // Mulai session
        if (!isset($_SESSION['user_id']) && !isset($_SESSION['mentor_id'])) {
            // Jika belum login, tampilkan tombol Log in dan Join
            echo '<a href="/views/pages/login/login.php" class="login">Log in</a>';
            echo '<a href="/views/pages/register/register.php" class="join">Join</a>';
        } elseif (isset($_SESSION['mentor_id'])) {
            echo '<a href="logout.php" class="logout">Log Out</a>';
        } elseif (isset($_SESSION['user_id'])) {

            echo '<a href="logout.php" class="logout">Log Out</a>';
        }
        ?>
    </div>
</header>
