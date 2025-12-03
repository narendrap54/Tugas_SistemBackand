<?php
require 'config/db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM kursus WHERE id=?");

if ($stmt->execute([$id])) {
    echo "Data berhasil dihapus";
    header("Refresh:2; url=index.php");
    exit;
} else {
    echo "Gagal menghapus data:<br>";
    print_r($stmt->errorInfo());
}
?>