<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
body {
    font-family: Arial;
    background: #f4f4f4;
}
.container {
    width: 400px;
    margin: 50px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px gray;
}
h2 {
    text-align: center;
}
input, select {
    width: 100%;
    padding: 8px;
    margin: 5px 0;
}
button {
    background: #007bff;
    color: white;
    padding: 10px;
    border: none;
    width: 100%;
    border-radius: 5px;
}
button:hover {
    background: #0056b3;
}
</style>
</head>
<body>
    <div class="container">
<h2>Tambah Peminjaman</h2>
<form method="POST" action="insert.php">
    ID Reservasi:
    <input type="text" name="id_reservasi">

    ID Pelanggan:
    <input type="text" name="id_tamu">

    ID Kamar:
    <input type="text" name="id_kamar">

    Tanggal Check in:
    <input type="date" name="tanggal_checkin">

    Tanggal Check out:
    <input type="date" name="tanggal_checkout">

    Status:
    <input type="text" name="status_reservasi">

    <button>Simpan</button>
</form>
</div>
</body>
</html>