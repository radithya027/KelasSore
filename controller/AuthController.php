<?php
include 'services/database.php'; // Pastikan koneksi database sudah terinclude
include 'models/AuthModel.php'; // Menggunakan model AuthModel

class AuthController {
    protected $authModel;

    public function __construct() {
        $this->authModel = new AuthModel(); // Inisialisasi model
    }

    // Fungsi untuk login
    public function login($email, $password) {
        $result = $this->authModel->getUserByEmail($email);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            // Verifikasi password menggunakan bcrypt
            if (password_verify($password, $user['password'])) {
                return "Login berhasil!";
            } else {
                return "Password salah!";
            }
        } else {
            return "Email tidak ditemukan!";
        }
    }

    // Fungsi untuk registrasi
    public function register($email, $name, $password, $password_confirm) {
        if ($password === $password_confirm) {
            // Cek apakah email sudah terdaftar
            $result = $this->authModel->getUserByEmail($email);
            if (mysqli_num_rows($result) > 0) {
                return "Email sudah terdaftar!";
            } else {
                // Buat pengguna baru
                if ($this->authModel->createUser($email, $name, $password)) {
                    return "Pendaftaran berhasil, silakan login!";
                } else {
                    return "Terjadi kesalahan saat pendaftaran!";
                }
            }
        } else {
            return "Password tidak cocok!";
        }
    }
}
?>
