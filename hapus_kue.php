<?php
require 'koneksi.php';
require 'cek_session.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Ambil info foto terlebih dahulu
    $result = mysqli_query($conn, "SELECT foto FROM kue WHERE id = $id");
    if ($kue = mysqli_fetch_assoc($result)) {
        $foto = $kue['foto'];
        
        // Hapus file foto fisik dari folder uploads
        if (file_exists('uploads/' . $foto)) {
            unlink('uploads/' . $foto);
        }

        // Hapus data dari MySQL
        mysqli_query($conn, "DELETE FROM kue WHERE id = $id");
    }
}

header("Location: dashboard.php");
exit();
?>