<?php
    // Tampilkan informasi `username` dan `tanggal_pesanan` yang diteruskan dari controller
    $username = isset($username) ? $username : 'Tidak diketahui';
    $tanggal_pesanan = isset($tanggal_pesanan) ? $tanggal_pesanan : 'Tidak diketahui';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #121212;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .content {
            padding-right: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        .card {
            background-color: #2c2c2c;
            border: none;
            border-radius: 10px;
            margin-top: 20px;
        }
        .card-body {
            padding: 20px;
        }
        .btn-buy {
            background-color: #e91e63;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .btn-buy:hover {
            background-color: #c2185b;
        }
        .qr-image {
            max-width: 50%;
            height: auto;
            cursor: pointer;
            border: 2px solid #e91e63;
            border-radius: 10px;
            transition: transform 0.3s ease, border-color 0.3s ease;
        }
        .qr-image:hover {
            transform: scale(1.1);
            border-color: #c2185b;
        }
        .modal-content {
            background-color: #2c2c2c;
            border: none;
        }
        .modal-content img {
            max-width: 100%;
            height: auto;
        }
        .form-control {
            background-color: #3c3c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
        }
        .form-control:focus {
            background-color: #4c4c4c;
            color: #fff;
            border: none;
            box-shadow: none;
        }
        label {
            color: #e0e0e0;
        }
        h5 {
            color: #e91e63;
        }
        .card-text {
            color: #ccc;
        }
      
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5); /* Warna latar belakang dengan transparansi */
            border-radius: 50%; /* Membuat tombol berbentuk bulat */
            width: 50px;
            height: 50px;
            background-size: 50%, 50%;
        }

        .carousel-control-prev-icon {
            background-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" fill="%23FFFFFF" viewBox="0 0 16 16"%3E%3Cpath d="M11.354 15.354a.5.5 0 0 0 0-.708l-6-6a.5.5 0 0 0 0-.708l6-6a.5.5 0 1 0-.708-.708l-6 6a.5.5 0 0 0 0 .708l6 6a.5.5 0 0 0 .708 0z"/%3E%3C/svg%3E');
        }

        .carousel-control-next-icon {
            background-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" fill="%23FFFFFF" viewBox="0 0 16 16"%3E%3Cpath d="M4.646 15.354a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 0-.708l-6-6a.5.5 0 1 1 .708-.708l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708 0z"/%3E%3C/svg%3E');
        }
        .centered-text {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="container">
            <div class="card">
                <button class="btn-buy" onclick="window.history.back();">Kembali Ke Halaman Sebelumnya</button>
                <div class="card-body">
                    <?php foreach ($akun_ml as $account): ?>
                        <form action="<?php echo base_url('user/create_transaction'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="kode_transaksi" value="<?php echo isset($kode_transaksi) ? $kode_transaksi : ''; ?>">
                        <input type="hidden" name="akun_ml_id" value="<?php echo $account['kode_akun']; ?>"> <!-- Menggunakan ID dari akun ML -->

                            <h5 class="card-title">Pembayaran untuk Akun: <?php echo $account['nama_akun']; ?></h5>

                            <div id="carouselExampleControls<?php echo $account['kode_akun']; ?>" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                <?php 
                                    $gambar_columns = ['gambar1', 'gambar2', 'gambar3', 'gambar4'];
                                    $first = true;

                                    foreach ($gambar_columns as $column) {
                                        if (!empty($account[$column])) {
                                            $active_class = $first ? 'active' : '';
                                            echo '<div class="carousel-item ' . $active_class . '">';
                                            echo '<img class="d-block w-100" src="' . base_url('uploads/' . $account[$column]) . '" alt="Gambar Akun" data-toggle="modal" data-target="#imageModal' . $account['kode_akun'] . '" onclick="setModalImage(\'' . base_url('uploads/' . $account[$column]) . '\', \'' . $account['kode_akun'] . '\')">';
                                            echo '</div>';
                                            $first = false;
                                        }
                                    }
                                    ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls<?php echo $account['kode_akun']; ?>" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Kembali</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls<?php echo $account['kode_akun']; ?>" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                            <p></p>
                            <div class="centered-text">
                                <p>Silakan lakukan pembayaran ke nomor rekening berikut:</p>
                            </div>
                            <div class="bank-info">
                            <h5 class="card-title">Akun Game : <?php echo $account['nama_akun']; ?></h5>
                            <h5 class="card-title">Kode Akun : <?php echo $account['kode_akun']; ?></h5>
                            <p class="card-text">Rank : <?php echo $account['rank']; ?></p>
                            <p class="card-text">Jumlah Hero : <?php echo $account['jumlah_hero']; ?></p>
                            <p class="card-text">Jumlah Skin : <?php echo $account['jumlah_skin']; ?></p>
                            <p class="card-text">Harga: <span class="highlight"><?php echo ($account['harga']); ?></span></p>
                            <p class="card-text">Deskripsi : <?php echo $account['deskripsi']; ?></p>
                            <p><strong>PAYMENT / PEMBAYARAN</strong></p>
                                <p><strong>Bank BCA   : 3600 311 092 a/n Nur Redi</strong></p>
                                <p><strong>Shoppe Pay : 0823-2217-7193 /Nur Redi</strong></p>
                                <p><strong>Gopay      : 0823-2217-7193 /Redi Gengs</strong></p>
                                <p><strong>Seabank    : 901052924152 a/n Nur Redi</strong></p>
                                <p><strong>Dana 1     : 0823-2217-7193 /Nur Redi</strong></p>
                                <p><strong>Dana 2     : 0813-9544-1171 / Masringah</strong></p>

                            </div>
                            <img class="qr-image" src="<?php echo base_url('uploads/qris.jpeg'); ?>" alt="QRIS Image" data-toggle="modal" data-target="#qrisModal">

                            <!-- Modal -->
                            <div class="modal fade" id="qrisModal" tabindex="-1" aria-labelledby="qrisModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img src="<?php echo base_url('uploads/qris.jpeg'); ?>" alt="QRIS Image">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for image -->
                            <div class="modal fade" id="imageModal<?php echo $account['kode_akun']; ?>" tabindex="-1" aria-labelledby="imageModalLabel<?php echo $account['kode_akun']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img id="modalImage<?php echo $account['kode_akun']; ?>" src="" alt="Gambar Akun">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p></p>

                            <p>Setelah melakukan pembayaran, silakan upload bukti transfer Anda di bawah ini:</p>

                            <div class="form-group">
                                <label for="metode_pembayaran">Metode Pembayaran:</label>
                                <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="Dana">Dana</option>
                                    <option value="Qris">Qris</option>
                                    <option value="Bank">Bank</option>
                                    <option value="Shopee Pay">Shopee Pay</option>
                                    <option value="Gopay">Gopay</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="bukti_transfer">Upload Bukti Transfer:</label>
                                <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" required>
                                </div>                            
                            </div>

                            <button type="submit" class="btn btn-buy">Konfirmasi Pembayaran</button>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
        function setModalImage(src, accountId) {
            $('#modalImage' + accountId).attr('src', src);
        }
    </script>
</body>
</html>
