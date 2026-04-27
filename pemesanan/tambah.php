<form action="insert.php" method="POST">
<h3>DATA TAMU</h3>
    <label>Nama Lengkap : </label><br>
    <input type="text" name="username" required><br>

    <label>No. Telpon : </label><br>
    <input type="text" name="telp" required number_format><br>

    <label>Email : </label><br>
    <input type="text" name="email" required><br>
<h3>DATA KAMAR</h3>
    <label>Pilih Kamar :</label>
    <label>Tanggal Check in</label><br>
    <select name="kamar" required>
        <option value="Deluxe">Deluxe Room — Rp 850.000</option>
        <option value="Executive">Executive Room — Rp 1.250.000</option>
        <option value="Suite">Suite Room — Rp 2.500.000</option>     
    </select>
    
    <input type="date" name="checkin" min="2024-01-01" /><br>   
    <button type="submit">Booking Sekarang</button>

</form>