<?php
// File: logout.php

// Absolute path to AuthController.php
include 'D:/PhpWeb/controllers/AuthController.php'; // Adjust this path accordingly

// Create an instance of AuthController
$authController = new AuthController();

// Call the logout method to destroy the session and redirect
$authController->logout();
?>
