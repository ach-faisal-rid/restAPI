<?php
require_once 'config/koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        // Jika ID disediakan, ambil satu buku berdasarkan ID
        $id = $_GET['id'];
        $query = "SELECT * FROM buku WHERE id = $id";
    } else {
        // Jika ID tidak disediakan, ambil semua data buku
        $query = "SELECT * FROM buku";
    }
    $result = $koneksi->query($query);
    if ($result) {
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        if (empty($data)) {
            $response = [
                'status' => 'success',
                'message' => 'Data buku tidak ditemukan',
                'data' => []
            ];
        } else {
            $response = [
                'status' => 'success',
                'message' => 'Data buku berhasil diambil',
                'data' => $data
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Gagal mengambil data buku: ' . $koneksi->error
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>