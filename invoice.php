<?php
session_start();

// Cek apakah data pesanan tersedia
if (!isset($_SESSION['pesanan'])) {
    header("Location: index.php");
    exit();
}

$pesanan = $_SESSION['pesanan'];

// Daftar mobil dan gambar terkait
$gambar_mobil = [
    "Fortuner" => "fortuner.jpg",
    "Creta" => "creta.jpg",
    "CRV" => "crv.jpg"
];

$gambar = $gambar_mobil[$pesanan['mobil']] ?? "default.jpg";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-white text-center">
                <h5>Invoice Pemesanan</h5>
            </div>
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p><strong>Nama:</strong> <?= $pesanan['nama'] ?></p>
                    <p><strong>Nomor Identitas:</strong> <?= $pesanan['identitas'] ?></p>
                    <p><strong>Jenis Kelamin:</strong> <?= $pesanan['gender'] ?></p>
                    <p><strong>Mobil:</strong> <?= $pesanan['mobil'] ?></p>
                    <p><strong>Durasi:</strong> <?= $pesanan['durasi'] ?> hari</p>
                    <p><strong>Supir:</strong> <?= $pesanan['supir'] ?></p>
                    <p><strong>Total Bayar:</strong> Rp <?= number_format($pesanan['total_bayar'], 0, ',', '.') ?></p>
                </div>
                <div>
                    <img src="img/<?= $gambar ?>" class="img-fluid" alt="<?= $pesanan['mobil'] ?>" style="max-width: 300px;">
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="index.php" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>
