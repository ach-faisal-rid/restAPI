<?php
require_once 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Pastikan ID buku yang akan dihapus diterima dari permintaan DELETE
    parse_str(file_get_contents("php://input"), $delete_data);
    if (isset($delete_data['id'])) {
        $id = $delete_data['id'];

        // Buat kueri SQL untuk menghapus data buku berdasarkan ID
        $query = "DELETE FROM buku WHERE id = $id";

        if ($koneksi->query($query) === TRUE) {
            $response = [
                'status' => 'success',
                'message' => 'Data buku berhasil dihapus'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal menghapus data buku: ' . $koneksi->error
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Parameter ID yang diperlukan tidak ditemukan'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>