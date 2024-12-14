<?php
// Pastikan file AuthController dapat diakses
include dirname(__FILE__) . '/../../../controllers/AuthController.php';

// Buat instance AuthController
$authController = new AuthController();

// Panggil method logout
$authController->logout();
