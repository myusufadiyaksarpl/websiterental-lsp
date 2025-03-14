<?php
session_start();

// Mengambil nilai 'id' dari URL
$id = $_GET['id'] ?? 0;

// Daftar mobil beserta harga sewanya per hari
$rentals = [
    ["Fortuner", 1000000, "fortuner.jpg"],
    ["Creta", 900000, "creta.jpg"],
    ["CRV", 800000, "crv.jpg"]
];

// Menentukan mobil yang dipilih berdasarkan input form atau default dari daftar berdasarkan indexarray
$pilih_mobil = $_POST['car'] ?? $rentals[$id][0];

// Mendapatkan harga mobil yang dipilih
$pilih_harga = array_column($rentals, 1, 0)[$pilih_mobil];

// Mengecek apakah opsi supir dipilih oleh pengguna
$supir = isset($_POST['supir']);

// Mengambil durasi sewa dari input pengguna
$durasi = $_POST['durasi'] ?? '';

// Inisialisasi total pembayaran
$total_bayar = 0;

// Array untuk menyimpan pesan error validasi
$errors = [];

// Mengecek apakah form telah dikirim (dengan metode POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi: Durasi harus angka dan lebih dari 0
    if (!is_numeric($durasi) || $durasi <= 0) {
        $errors[] = "Durasi harus berupa angka lebih dari 0.";
    }

    // Validasi: Nomor identitas harus 16 digit angka
    if (!is_numeric($_POST['identitas']) || strlen($_POST['identitas']) !== 16) {
        $errors[] = "Nomor Identitas harus 16 digit angka.";
    }

    // Jika tidak ada error validasi, hitung total pembayaran
    if (empty($errors)) {
        $total_harga_mobil = $pilih_harga * $durasi;

        // Diskon 10% jika sewa 3 hari atau lebih
        $diskon = ($durasi >= 3) ? 0.1 * $total_harga_mobil : 0;

        // Biaya tambahan supir
        $biaya_supir = $supir ? 100000 * $durasi : 0;

        // Total pembayaran
        $total_bayar = $total_harga_mobil - $diskon + $biaya_supir;
    }

    // Jika tombol "Simpan" ditekan, simpan data ke session dan redirect ke invoice.php
    if (isset($_POST['simpan']) && empty($errors)) {
        $_SESSION['pesanan'] = [
            "nama" => $_POST['nama'],
            "identitas" => $_POST['identitas'],
            "gender" => $_POST['gender'],
            "mobil" => $pilih_mobil,
            "durasi" => $durasi,
            "supir" => $supir ? "Ya" : "Tidak",
            "diskon" => $diskon,
            "total_bayar" => $total_bayar
        ];
        
        header("Location: invoice.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h5>Form Pemesanan</h5>
            </div>
            <div class="card-body">
                <?php if ($errors) { ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error) { ?>
                                <li><?= $error ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <form method="POST">
                    <input type="text" class="form-control mb-3" name="nama" placeholder="Nama Pemesan" value="<?= $_POST['nama'] ?? '' ?>" required>
                    
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <input class="form-check-input" type="radio" name="gender" value="Laki-laki" required> Laki-laki
                        <input class="form-check-input ms-3" type="radio" name="gender" value="Perempuan" required> Perempuan
                    </div>
                    
                    <input type="text" class="form-control mb-3" name="identitas" placeholder="Nomor Identitas (16 digit)" value="<?= $_POST['identitas'] ?? '' ?>" required>
                    
                    <select class="form-select mb-3" name="car" onchange="this.form.submit()">
                        <?php foreach ($rentals as $nilai) { ?>
                            <option value="<?= $nilai[0] ?>" <?= ($nilai[0] === $pilih_mobil) ? 'selected' : '' ?>><?= $nilai[0] ?></option>
                        <?php } ?>
                    </select>
                   
                    <input type="text" class="form-control mb-3" name="harga" value="<?= number_format($pilih_harga, 0, ',', '.') ?>" readonly>
                    
                    <input type="number" class="form-control mb-3" name="durasi" placeholder="Durasi Sewa (hari)" value="<?= $durasi ?>" required>
                    
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" name="supir" <?= $supir ? 'checked' : '' ?>> Termasuk Supir (Rp 100.000/hari)
                    </div>

                    <input type="text" class="form-control mb-3" id="total" value="<?= $total_bayar ? number_format($total_bayar, 0, ',', '.') : '' ?>" placeholder="Total Bayar" readonly>
                    
                    <button type="submit" class="btn btn-primary">Hitung Total</button>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
