<?php
require_once 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Pastikan data yang diperlukan telah diterima dari permintaan PUT
    parse_str(file_get_contents("php://input"), $put_data);
    if (isset($put_data['id']) && isset($put_data['judul']) && isset($put_data['pengarang']) && isset($put_data['tahun'])) {
        $id = $put_data['id'];
        $judul = $put_data['judul'];
        $pengarang = $put_data['pengarang'];
        $tahun = $put_data['tahun'];
        $sampul = isset($put_data['sampul']) ? $put_data['sampul'] : null;
        $harga = isset($put_data['harga']) ? $put_data['harga'] : null;

        // Buat kueri SQL untuk mengupdate data buku berdasarkan ID
        $query = "UPDATE buku SET judul = '$judul', pengarang = '$pengarang', tahun = '$tahun', sampul = '$sampul', harga = '$harga' WHERE id = $id";

        if ($koneksi->query($query) === TRUE) {
            $response = [
                'status' => 'success',
                'message' => 'Data buku berhasil diupdate'
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Gagal mengupdate data buku: ' . $koneksi->error
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