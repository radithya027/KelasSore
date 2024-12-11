<!DOCTYPE html>
<html lang="en">
<header>
    <div class="logo">
        <img src="../../../../assets/images/logo.svg" alt="KelasSore Logo">
    </div>
    <div class="buttons">
        <?php
        session_start(); // Mulai session
        if (!isset($_SESSION['user_id'])) {
            // Jika belum login, tampilkan tombol Log in dan Join
            echo '<a href="/views/pages/login/login.php" class="login">Log in</a>';

            echo '<a href="/viewa/pages/register/register.php" class="join">Join</a>';
        } else {
            // Jika sudah login, tampilkan tombol Log out
            echo '<a href="logout.php" class="login">Log Out</a>';
        }
        ?>
    </div>
</header>
