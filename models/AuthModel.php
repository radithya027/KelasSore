<?php
class AuthModel {
    // Fungsi untuk mendapatkan user berdasarkan email
    public function getUserByEmail($email) {
        global $conn;
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    // Fungsi untuk mendaftar user baru
    public function createUser($email, $name, $password) {
        global $conn;
        // Hash password menggunakan bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $created_at = date("Y-m-d H:i:s");
        $updated_at = $created_at;
        
        $query = "INSERT INTO users (email, name, password, created_at, updated_at) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $email, $name, $hashedPassword, $created_at, $updated_at);
        return mysqli_stmt_execute($stmt);
    }
}
?>
