<?php
include_once 'config/Database.php';
include_once 'src/Buku.php';

$database = new Database();
$db = $database->getConnection();
$buku = new Buku($db);
$stmt = $buku->readAll();
?>
<!DOCTYPE html>
<html>
<head><title>Daftar Buku</title></head>
<body>
    <h1>Perpustakaan: Daftar Buku</h1>
    <a href="create.php">+ Tambah Buku</a>
    <table border="1" cellpadding="10" style="margin-top:10px; border-collapse:collapse; width:100%;">
        <thead>
            <tr style="background:#eee;">
                <th>No</th><th>Cover</th><th>Judul</th><th>Penulis</th><th>Tahun</th><th>Genre</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><img src="uploads/<?= $row['cover'] ?>" width="50"></td>
                <td><?= $row['judul'] ?></td>
                <td><?= $row['penulis'] ?></td>
                <td><?= $row['tahun_terbit'] ?></td>
                <td><?= $row['genre'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> | 
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>