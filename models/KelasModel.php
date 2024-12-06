<?php
// File: models/KelasModel.php
require_once dirname(__FILE__) . '/../services/database.php';

class KelasModel
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllKelas()
    {
        $query = "SELECT * FROM kelas";
        $result = mysqli_query($this->conn, $query);
        $kelasList = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $kelasList[] = $row;
        }
        return $kelasList;
    }

    public function getKelasById($kelasId)
    {
        $query = "SELECT * FROM kelas WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $kelasId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function insertKelas($data)
    {

        $query = "INSERT INTO kelas 
            (mentor_id, name_mentor, name, image, description, category, kurikulum, price, quota, quota_left, start_date, end_date, link_wa, status, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the query
        $stmt = mysqli_prepare($this->conn, $query);

        // If mentor_id is empty, set it to NULL
        $mentor_id = isset($data['mentor_id']) && !empty($data['mentor_id']) ? intval($data['mentor_id']) : NULL;

        // Bind parameters individually
        mysqli_stmt_bind_param(
            $stmt,
            "isssssssiiisssss",  // Bind the parameters type
            $mentor_id,  // This will be NULL if not provided
            $data['name_mentor'],
            $data['name'],
            $data['image'],
            $data['description'],
            $data['category'],
            $data['kurikulum'],
            $data['price'],
            $data['quota'],
            $data['quota_left'],
            $data['start_date'],
            $data['end_date'],
            $data['link_wa'],
            $data['status'],
            $data['created_at'],
            $data['updated_at']
        );

        // Execute the query
        return mysqli_stmt_execute($stmt);
    }

    public function updateKelas($kelasId, $data)
    {
        $query = "UPDATE kelas 
                  SET mentor_id = ?, name_mentor = ?, name = ?, image = ?, description = ?, category = ?, kurikulum = ?, price = ?, quota = ?, quota_left = ?, start_date = ?, end_date = ?, link_wa = ?, status = ?, updated_at = ?
                  WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);

        // Determine mentor_id, use NULL if empty
        $mentor_id = isset($data['mentor_id']) && !empty($data['mentor_id']) ? intval($data['mentor_id']) : NULL;

        // Determine image path
        $image = $data['image'] ?? NULL;

        // Current timestamp for updated_at
        $updated_at = date('Y-m-d H:i:s');

        mysqli_stmt_bind_param(
            $stmt,
            "isssssssiisssssi",  // Updated type definition
            $mentor_id,          // mentor_id
            $data['name_mentor'],
            $data['name'],
            $image,              // image 
            $data['description'],
            $data['category'],
            $data['kurikulum'],
            $data['price'],
            $data['quota'],
            $data['quota_left'],
            $data['start_date'],
            $data['end_date'],
            $data['link_wa'],
            $data['status'],
            $updated_at,         // updated_at
            $kelasId             // id for WHERE clause
        );

        return mysqli_stmt_execute($stmt);
    }

    public function deleteKelas($kelasId)
    {
        $query = "DELETE FROM kelas WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $kelasId);
        return mysqli_stmt_execute($stmt);
    }

    public function attachBooksToKelas($kelasId, $bookIds)
    {
        // Hapus hubungan buku-kelas yang sudah ada sebelumnya
        $this->detachBooksFromKelas($kelasId);

        // Buat hubungan baru antara buku-kelas
        foreach ($bookIds as $bookId) {
            $query = "INSERT INTO book_kelas (book_id, kelas_id) VALUES (?, ?)";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "ii", $bookId, $kelasId);
            mysqli_stmt_execute($stmt);
        }
    }

    public function detachBooksFromKelas($kelasId)
    {
        $query = "DELETE FROM book_kelas WHERE kelas_id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $kelasId);
        mysqli_stmt_execute($stmt);
    }

    
}
