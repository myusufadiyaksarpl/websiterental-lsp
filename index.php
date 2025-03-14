<?php 
    // Memasukkan file "datadummy.php" yang berisi data rental mobil
    include "datadummy.php"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"> <!-- Menentukan karakter encoding halaman -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Agar tampilan responsif di perangkat mobile -->
    <title>Rental Mobil</title> <!-- Judul halaman -->
    
    <!-- Memuat Bootstrap untuk styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 

    <style>
        body { background-color: #000000; color: white; } /* Mengatur warna latar belakang dan teks */
        .card { background-color: #666666; height: 100%; color: white; } /* Styling kartu daftar mobil */
        .btn-custom { background-color: rgb(129, 229, 104); color: white; } /* Styling tombol sewa */
        .carousel-inner img { height: 900px; object-fit: cover; width: 100%; } /* Styling gambar dalam carousel */
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg"> <!-- Navigasi dengan tema gelap -->
        <div class="container"> 
            <a class="navbar-brand text-white" href="#">Home</a> <!-- Link ke halaman utama -->
            <a class="navbar-brand text-white" href="transaksi.php">Transaksi</a> <!-- Link ke halaman transaksi -->
            <a class="navbar-brand text-white ms-auto" href="#">Logout</a> <!-- Link untuk logout -->
        </div>
    </nav>

    <!-- Carousel Gambar -->
    <div id="carouselExample" class="carousel slide mt-4" data-bs-ride="carousel">
        <div class="carousel-indicators"> <!-- Indikator carousel -->
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner"> <!-- Container untuk gambar carousel -->
            <div class="carousel-item active">
                <img src="img/fortuner.jpg" class="d-block w-100" alt="Fortuner"> <!-- Gambar pertama -->
            </div>
            <div class="carousel-item">
                <img src="img/creta.jpg" class="d-block w-100" alt="Creta"> <!-- Gambar kedua -->
            </div>
            <div class="carousel-item">
                <img src="img/crv.jpg" class="d-block w-100" alt="CRV"> <!-- Gambar ketiga -->
            </div>
        </div>
        <!-- Tombol untuk navigasi carousel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Judul -->
    <div class="container text-center mt-4">
        <h2 class="fw-bold">DAFTAR RENTAL SMK ISFI BJM</h2> <!-- Judul utama halaman -->
    </div>

    <!-- Daftar Mobil Rental -->
<div class="container mt-4">
    <div class="row justify-content-center"> <!-- Pusatkan isi row -->
        <?php foreach ($paket_rental as $index => $data) { ?> <!-- Looping daftar mobil dari data dummy -->
        <div class="col-md-3 mb-4 d-flex justify-content-center"> <!-- Pusatkan kolom -->
            <div class="card text-center p-3 mx-auto" style="width: 18rem;"> <!-- Pusatkan kartu -->
                <img src="img/<?= ($data[3]) ?>" class="card-img-top" alt="<?= ($data[0]) ?>"> <!-- Gambar mobil -->
                <h5 class="fw-bold mt-2"><?= ($data[0]) ?></h5> <!-- Nama mobil -->
                <p><?= ($data[1]) ?></p> <!-- Deskripsi mobil -->
                <p><strong>Rp <?= number_format($data[2], 0, ',', '.') ?></strong></p> <!-- Harga mobil -->
            </div>
        </div>
        <?php } ?> <!-- Akhir looping -->
    </div>
</div>

    <div style="text-align: center;">
        <a href="transaksi.php?id=<?= $index ?>" class="btn btn-custom">Sewa Sekarang</a><!-- tombol sewa sekarang ini untuk menuju ke halaman transaksi -->
    </div>
    <!-- Tentang Kami -->
    <div class="container mt-5">
        <div class="row align-items-center"> 
            <div class="col-md-6">
                <img src="img/fortuner.jpg" class="img-fluid" alt="Tentang Kami"> <!-- Gambar tentang kami -->
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold">Tentang Kami</h2> <!-- Judul section tentang kami -->
                <p>SMK ISFI Banjarmasin menyediakan layanan rental kendaraan dengan berbagai pilihan mobil berkualitas.</p> <!-- Deskripsi tentang kami -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer text-center mt-4 text-white">
        &copy; M YUSUF ADIYAKSA <!-- Copyright -->
    </div>

    <!-- Bootstrap JS untuk interaksi website -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
