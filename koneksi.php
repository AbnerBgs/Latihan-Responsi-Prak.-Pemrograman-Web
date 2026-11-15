<?php 

    $conn = mysqli_connect (
        "localhost",
        "root",
        "",
        "toko_roti"
    );

    if(!$conn) {
        die("Koneksi Gagal: " . mysqli_connect_error());
    }

?>