<?php
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Panggil buku-get.php
    require_once '../../buku-get.php';
} elseif ($method === 'POST') {
    // Panggil buku-post.php
    require_once '../../buku-post.php';
} elseif ($method === 'PUT') {
    // Panggil buku-put.php
    require_once '../../buku-put.php';
} elseif ($method === 'DELETE') {
    // Panggil buku-del.php
    require_once '../../buku-del.php';
}
?>