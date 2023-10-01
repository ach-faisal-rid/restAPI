<?php
require_once 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan data yang diperlukan telah diterima dari permintaan POST
    if (isset($_POST['judul']) && isset($_POST['pengarang']) && isset($_POST['tahun'])) {
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $tahun = $_POST['tahun'];

        // Buat kueri SQL untuk menambahkan data buku baru ke dalam database
        $query = "INSERT INTO buku (judul, pengarang, tahun) VALUES ('$judul', '$pengarang', '$tahun')";

        if ($koneksi->query($query) === TRUE) {
            $response = [
                'status' => 'success',
                'message' => 'Data buku berhasil ditambahkan'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal menambahkan data buku: ' . $koneksi->error
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Parameter yang diperlukan tidak ditemukan'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>