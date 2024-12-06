<?php
// File: controllers/KelasController.php
require_once dirname(__FILE__) . '/../models/KelasModel.php';
require_once dirname(__FILE__) . '/../models/BookModel.php';

class KelasController {
    private $kelasModel;
    private $bookModel;

    public function __construct() {
        $this->kelasModel = new KelasModel();
        $this->bookModel = new BookModel();
    }

    public function getAllKelas() {
        return $this->kelasModel->getAllKelas();
    }

    public function getKelasById($kelasId) {
        return $this->kelasModel->getKelasById($kelasId);
    }

    public function createKelas($data, $imageFile) {
        $imageFileName = uniqid() . '_' . basename($imageFile['name']);
        $imageFilePath = '../public/image-class/' . $imageFileName;
    
        $createdAt = $updatedAt = date('Y-m-d H:i:s');
    
        if (!file_exists('../public/image-class')) mkdir('../public/image-class', 0777, true);
    
        if (!move_uploaded_file($imageFile['tmp_name'], $imageFilePath)) {
            return "Failed to upload image.";
        }
    
        $data['image'] = $imageFilePath;
        $data['created_at'] = $createdAt;
        $data['updated_at'] = $updatedAt;
    
        // Ensure mentor_id is properly handled (set to NULL if empty)
        $data['mentor_id'] = isset($data['mentor_id']) && !empty($data['mentor_id']) ? $data['mentor_id'] : NULL;
    
        // Handle start_date and end_date similar to updateKelas
        $data['start_date'] = !empty($data['start_date']) ? $data['start_date'] : NULL;
        $data['end_date'] = !empty($data['end_date']) ? $data['end_date'] : NULL;
    
        return $this->kelasModel->insertKelas($data);
    }

    public function updateKelas($kelasId, $data, $imageFile) {
        $existingKelas = $this->kelasModel->getKelasById($kelasId);
        
        // Determine image path
        if (!empty($imageFile['name'])) {
            // If a new image is uploaded
            $imageFileName = uniqid() . '_' . basename($imageFile['name']);
            $imageFilePath = '../public/image-class/' . $imageFileName;
    
            if (!file_exists('../public/image-class')) {
                mkdir('../public/image-class', 0777, true);
            }
    
            if (!move_uploaded_file($imageFile['tmp_name'], $imageFilePath)) {
                return "Failed to upload image.";
            }
    
            $data['image'] = $imageFilePath;
        } else {
            // Keep existing image if no new image is uploaded
            $data['image'] = $existingKelas['image'];
        }
    
        return $this->kelasModel->updateKelas($kelasId, $data);
    }

    public function deleteKelas($kelasId) {
        // First, get the existing kelas to retrieve its image path
        $existingKelas = $this->kelasModel->getKelasById($kelasId);
        
        // Delete the record from the database
        $result = $this->kelasModel->deleteKelas($kelasId);
        
        // If deletion from database is successful, remove the image file
        if ($result && !empty($existingKelas['image']) && file_exists($existingKelas['image'])) {
            unlink($existingKelas['image']);
        }
        
        return $result;
    }

    public function createKelasWithBooks($data, $imageFile, $bookIds)
    {
        // Proses upload gambar dan penanganan data kelas
        $kelasId = $this->createKelas($data, $imageFile);

        // Jika proses pembuatan kelas berhasil, tambahkan hubungan buku-kelas
        if ($kelasId) {
            $this->kelasModel->attachBooksToKelas($kelasId, $bookIds);
            return $kelasId;
        }

        return false;
    }

    public function showKelasWithBooks($kelasId) {
        // Ambil data kelas berdasarkan ID
        $kelas = $this->kelasModel->getKelasById($kelasId);

        var_dump($kelas); // Memeriksa data kelas
        
        // Ambil semua buku
        $books = $this->bookModel->getAllBooks();

        // Debugging: Cek apakah data buku ada
        var_dump($books);  // Menampilkan data buku

        // Kirim data kelas dan buku ke tampilan
        include '../views/kelas.php';
    }
}
?>
