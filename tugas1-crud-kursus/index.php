<?php
require 'config/db.php';
$stmt = $pdo->query("SELECT * FROM kursus");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kursus</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Daftar Kursus</h1>
    <a href="create.php">Tambah Kursus</a>
    <table>
        <tr>
            <th>ID</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Durasi</th><th>Status</th><th>Gambar</th><th>Aksi</th>
        </tr>
        <?php foreach ($courses as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['name']) ?></td>
            <td><?= $c['category'] ?></td>
            <td>Rp <?= number_format($c['price'], 0, ',', '.') ?></td>
            <td><?= $c['duration'] ?> jam</td>
            <td><?= $c['status'] ?></td>
            <td>
                <?php if ($c['image_path']): // Tambahkan cek untuk memastikan path ada ?>
                    <img src="<?= htmlspecialchars($c['image_path']) ?>" alt="Foto Kursus" style="width: 100px; height: auto;">
                <?php else: ?>
                    Tidak Ada Gambar
                <?php endif; ?>
            </td>
            <td>
                <a href="edit.php?id=<?= $c['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $c['id'] ?>" onclick="return confirm('Hapus data ini?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>