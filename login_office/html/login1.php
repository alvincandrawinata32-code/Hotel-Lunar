<?php
session_start();
require_once '../../PHP/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama_pegawai = $_POST['nama_pegawai'];
    $jabatan = $_POST['jabatan'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM pegawai WHERE nama_pegawai = :nama AND jabatan = :jabatan AND password = :password");
    $stmt->bindParam(':nama', $nama_pegawai);
    $stmt->bindParam(':jabatan', $jabatan);
    $stmt->bindParam(':password', $password);

    try {
        $stmt->execute();
        $pegawai = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($pegawai) {
            $_SESSION['id_pegawai'] = $pegawai['id_pegawai'];
            $_SESSION['nama_pegawai'] = $pegawai['nama_pegawai'];
            $_SESSION['jabatan'] = $pegawai['jabatan'];

            if ($pegawai['jabatan'] === 'manager') {
                header('location: ../../back-office/html/manager1.php');
            } else {
                header('location: ../../back-office/html/office1.php');
            }
            exit;
        } else {
            echo "<script>alert('Nama, Jabatan, atau Password salah!'); window.location='login1.php';</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Masuk Karyawan - Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/logincss.css">
</head>
<body>

<div class="card">
    <div class="card-title">MASUK SEBAGAI KARYAWAN</div>

    <form method="POST">
        <div class="field">
            <label>Nama Pegawai</label>
            <input type="text" name="nama_pegawai" placeholder="Masukkan nama pegawai" required>
        </div>
        <div class="field">
            <label>Jabatan</label>
            <select name="jabatan" style="width:100%;height:42px;border:1.5px solid #cbd5e1;border-radius:8px;padding:0 14px;font-size:14px;background:#f8fafc;outline:none;">
                <option value="manager">Manager</option>
                <option value="karyawan">Karyawan</option>
            </select>
        </div>
        <div class="field">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn-primary">MASUK</button>
    </form>

    <div class="register" style="margin-top:16px;">
        <button onclick="window.location.href='../../../index.php'" style="background:#64748b;color:white;border:none;border-radius:8px;padding:10px 20px;cursor:pointer;width:100%;">kembali ke beranda</button>
    </div>
</div>

</body>
</html>
