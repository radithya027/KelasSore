<?php
// File: models/InvoiceModel.php
require_once dirname(__FILE__) . '/../services/database.php';

class InvoiceModel
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllInvoices()
    {
        $query = "SELECT * FROM invoices";
        $result = mysqli_query($this->conn, $query);
        $invoicesList = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $invoicesList[] = $row;
        }
        return $invoicesList;
    }

    public function getInvoiceById($invoiceId)
    {
        $query = "SELECT * FROM invoices WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $invoiceId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function insertInvoice($data)
    {
        // Cek apakah koneksi berhasil
        if (!$this->conn) {
            error_log("Connection failed: " . mysqli_connect_error());
            return false;
        }

        // Tentukan waktu default untuk created_at dan updated_at
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');

        // Tentukan nilai default untuk created_at dan updated_at jika tidak ada dalam data
        $data['created_at'] = $data['created_at'] ?? $created_at;
        $data['updated_at'] = $data['updated_at'] ?? $updated_at;

        // Mulai transaksi
        mysqli_begin_transaction($this->conn);

        try {
            // Query untuk memasukkan data ke tabel invoices
            $query = "INSERT INTO invoices (user_id, kelas_id, name, payment_price, nominal, no_rekening, image_pay, bank_name, transfer_date, approval, created_at, updated_at)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($this->conn, $query);
            if (!$stmt) {
                throw new Exception("Prepare statement failed for invoices: " . mysqli_error($this->conn));
            }

            // Binding parameter untuk query invoices
            mysqli_stmt_bind_param(
                $stmt,
                "iissdsssssss",
                $data['user_id'],
                $data['kelas_id'],
                $data['name'],
                $data['payment_price'],
                $data['nominal'],
                $data['no_rekening'],
                $data['image_pay'],
                $data['bank_name'],
                $data['transfer_date'],
                $data['approval'],
                $data['created_at'],
                $data['updated_at']
            );

            // Eksekusi query untuk invoices
            $executeResult = mysqli_stmt_execute($stmt);
            if (!$executeResult) {
                throw new Exception("Execute statement failed for invoices: " . mysqli_stmt_error($stmt));
            }

            // Jika query berhasil, commit transaksi
            mysqli_commit($this->conn);
            return true; // Data berhasil dimasukkan

        } catch (Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            mysqli_rollback($this->conn);
            error_log("Error: " . $e->getMessage());
            return false; // Gagal memasukkan data
        } finally {
            // Menutup statement setelah selesai
            if (isset($stmt)) {
                mysqli_stmt_close($stmt);
            }
        }
    }

    public function updateInvoice($invoiceId, $data)
    {
        // Query untuk memperbarui data di tabel invoices
        $query = "UPDATE invoices SET status = ?, name = ?, payment_price = ?, nominal = ?, no_rekening = ?, image_pay = ?, bank_name = ?, transfer_date = ?, approval = ?, updated_at = ? WHERE id = ?";

        // Siapkan pernyataan SQL untuk eksekusi
        $stmt = mysqli_prepare($this->conn, $query);

        // Dapatkan waktu saat ini untuk updated_at
        $updated_at = date('Y-m-d H:i:s');

        // Bind parameter sesuai dengan tipe data yang sesuai
        mysqli_stmt_bind_param(
            $stmt,
            "sssssssssssi", // format tipe data
            $data['status'] ?? $data['status'], // Jika data tidak ada, gunakan data lama
            $data['name'] ?? $data['name'], // Jika data tidak ada, gunakan data lama
            $data['payment_price'] ?? $data['payment_price'], // Jika data tidak ada, gunakan data lama
            $data['nominal'] ?? $data['nominal'], // Jika data tidak ada, gunakan data lama
            $data['no_rekening'] ?? $data['no_rekening'], // Jika data tidak ada, gunakan data lama
            $data['image_pay'] ?? $data['image_pay'], // Jika data tidak ada, gunakan data lama
            $data['bank_name'] ?? $data['bank_name'], // Jika data tidak ada, gunakan data lama
            $data['transfer_date'] ?? $data['transfer_date'], // Jika data tidak ada, gunakan data lama
            $data['approval'] ?? $data['approval'], // Jika data tidak ada, gunakan data lama
            $updated_at,
            $invoiceId  // Parameter terakhir untuk id invoice yang akan diupdate
        );

        // Mulai transaksi
        mysqli_begin_transaction($this->conn);

        try {
            // Eksekusi pernyataan SQL untuk memperbarui invoices
            $executeResult = mysqli_stmt_execute($stmt);

            if (!$executeResult) {
                throw new Exception("Execute statement failed for invoices: " . mysqli_stmt_error($stmt));
            }

            // Jika status adalah 'terbayar', masukkan data ke tabel kelas_users
            if ($data['status'] === 'terbayar') {
                $kelasQuery = "INSERT INTO kelas_users (user_id, kelas_id, created_at, updated_at) VALUES (?, ?, ?, ?)";
                $stmt2 = mysqli_prepare($this->conn, $kelasQuery);

                if (!$stmt2) {
                    throw new Exception("Prepare statement failed for kelas_users: " . mysqli_error($this->conn));
                }

                // Bind parameter untuk query kelas_users
                mysqli_stmt_bind_param(
                    $stmt2,
                    "iiss",
                    $data['user_id'],
                    $data['kelas_id'],
                    $updated_at,
                    $updated_at
                );

                // Eksekusi query untuk kelas_users
                $executeResult2 = mysqli_stmt_execute($stmt2);
                if (!$executeResult2) {
                    throw new Exception("Execute statement failed for kelas_users: " . mysqli_stmt_error($stmt2));
                }

                // Tutup statement kelas_users
                mysqli_stmt_close($stmt2);
            }

            // Commit transaksi jika semua query berhasil
            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            // Rollback jika terjadi kesalahan
            mysqli_rollback($this->conn);
            error_log("Error: " . $e->getMessage());
            return false;
        } finally {
            // Menutup statement
            if (isset($stmt)) {
                mysqli_stmt_close($stmt);
            }
        }
    }

    public function deleteInvoice($invoiceId)
    {
        $query = "DELETE FROM invoices WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $invoiceId);
        return mysqli_stmt_execute($stmt);
    }

    public function getKelasUserDetail($user_id)
    {
        $query = "
            SELECT k.id, k.name, k.image, k.name_mentor, k.price, k.category , k.start_date, k.end_date
            FROM kelas_users ku
            JOIN kelas k ON ku.kelas_id = k.id
            WHERE ku.user_id = ?
        ";

        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getMentorKelasDetail($mentor_id)
    {
        $query = "
            SELECT k.id, k.name, k.image, k.name_mentor, k.price, k.category , k.start_date, k.end_date
            FROM kelas k
            WHERE k.mentor_id = ?
        ";

        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $mentor_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
