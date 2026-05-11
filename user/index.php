    <?php
//require_once '../checkuser.php';
require_once "../db.php";

// Query untuk mengambil semua data pengguna
$sql = "SELECT * FROM tamu";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Menampilkan data dalam tabel HTML
if ($stmt->rowCount() > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Username</th><th>Role</th><th>Action</th></tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id_tamu'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td><a href='update.php?id=" . $row['id_tamu'] . "'>Edit</a> | <a href='delete.php?id=" . $row['id_tamu'] .
         "' onclick='return confirm(\"yakin ingin menghapus data ini?\")'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data ditemukan";
}
?>
