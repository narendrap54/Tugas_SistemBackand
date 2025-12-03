<?php
require 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $status = $_POST['status'];

    $image_path = null;
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir);
        $fileName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (in_array($fileType, ['jpg','jpeg','png']) && $_FILES["image"]["size"] < 2000000) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
            $image_path = $targetFile;
        }
    }

    $stmt = $pdo->prepare("INSERT INTO kursus (name, category, price, duration, image_path, status) VALUES (?,?,?,?,?,?)");
    if ($stmt->execute([$name, $category, $price, $duration, $image_path, $status])) {
        echo "Data berhasil ditambahkan";
        header("Refresh:2; url=index.php");
        exit;
    } else {
        print_r($stmt->errorInfo());
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kursus</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Tambah Kursus</h1>
    <form method="post" enctype="multipart/form-data">
        Nama: <input type="text" name="name" required><br>
        Kategori: <input type="text" name="category" required><br>
        Harga: <input type="number" name="price" required><br>
        Durasi (jam): <input type="number" name="duration" required><br>
        Status: 
        <select name="status">
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select><br>
        Gambar: <input type="file" name="image"><br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>