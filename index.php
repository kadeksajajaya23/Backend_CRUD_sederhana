<?php
include_once 'config/Database.php';
include_once 'src/Buku.php';

$database = new Database();
$db = $database->getConnection();
$buku = new Buku($db);
$stmt = $buku->readAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-book-half me-2"></i>Perpustakaan Digital</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary fw-bold">Daftar Koleksi Buku</h5>
                <a href="create.php" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Buku
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Cover</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Tahun</th>
                                <th>Genre</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <img src="uploads/<?= $row['cover'] ?>" 
                                         class="img-thumbnail shadow-sm" 
                                         style="width: 60px; height: 80px; object-fit: cover; cursor: pointer;"
                                         onclick="Swal.fire({imageUrl: 'uploads/<?= $row['cover'] ?>', imageAlt: 'Cover'})">
                                </td>
                                <td class="fw-semibold"><?= $row['judul'] ?></td>
                                <td><?= $row['penulis'] ?></td>
                                <td><span class="badge bg-secondary"><?= $row['tahun_terbit'] ?></span></td>
                                <td>
                                    <?php 
                                        $warna = 'primary';
                                        if($row['genre']=='Komik') $warna = 'warning text-dark';
                                        if($row['genre']=='Edukasi') $warna = 'info text-dark';
                                    ?>
                                    <span class="badge bg-<?= $warna ?>"><?= $row['genre'] ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm text-white me-1" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button onclick="hapusData(<?= $row['id'] ?>)" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function hapusData(id) {
            Swal.fire({
                title: 'Yakin hapus buku ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `delete.php?id=${id}`;
                }
            })
        }
    </script>
</body>
</html>