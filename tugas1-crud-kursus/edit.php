<?php
require 'config/db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM kursus WHERE id=?");
$stmt->execute([$id]);
$course = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$course) {
    echo "Data tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $status = $_POST['status'];
    $image_path = $course['image_path'];

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

    $stmt = $pdo->prepare("UPDATE kursus SET name=?, category=?, price=?, duration=?, image_path=?, status=? WHERE id=?");
    if ($stmt->execute([$name, $category, $price, $duration, $image_path, $status, $id])) {
        echo "Edit berhasil";
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
    <title>Edit Kursus</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Edit Kursus</h1>
    <form method="post" enctype="multipart/form-data">
        Nama: <input type="text" name="name" value="<?= htmlspecialchars($course['name']) ?>" required><br>
        Kategori: <input type="text" name="category" value="<?= $course['category'] ?>" required><br>
        Harga: <input type="number" name="price" value="<?= $course['price'] ?>" required><br>
        Durasi (jam): <input type="number" name="duration" value="<?= $course['duration'] ?>" required><br>
        Status:
        <select name="status">
            <option value="aktif" <?= $course['status']=='aktif'?'selected':'' ?>>Aktif</option>
            <option value="nonaktif" <?= $course['status']=='nonaktif'?'selected':'' ?>>Nonaktif</option>
        </select><br>
        Gambar: <input type="file" name="image"><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>