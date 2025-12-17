<?php
include 'config.php';

if ($_POST) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $paket_member = $_POST['paket_member'];
    
    // Calculate expiry date based on package
    $tanggal_expired = date('Y-m-d');
    switch($paket_member) {
        case 'harian':
            $tanggal_expired = date('Y-m-d', strtotime('+1 day'));
            break;
        case 'bulanan':
            $tanggal_expired = date('Y-m-d', strtotime('+1 month'));
            break;
        case '3bulan':
            $tanggal_expired = date('Y-m-d', strtotime('+3 months'));
            break;
        case 'vip':
            $tanggal_expired = date('Y-m-d', strtotime('+6 months'));
            break;
    }
    
    $sql = "INSERT INTO members (nama_lengkap, email, telepon, tanggal_lahir, jenis_kelamin, paket_member, tanggal_expired) 
            VALUES ('$nama_lengkap', '$email', '$telepon', '$tanggal_lahir', '$jenis_kelamin', '$paket_member', '$tanggal_expired')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pendaftaran berhasil!'); window.location.href='berita.html';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.history.back();</script>";
    }
}

$conn->close();
?>