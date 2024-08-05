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
    <title>Detail Akun</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/custom/css/style.css'); ?>">
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #0d0d0d;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .content {
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            background-color: #1e1e1e;
            border: none;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 16px rgba(0, 0, 0, 0.3);
        }
        .card-body {
            padding: 20px;
        }
        .card-title, .card-text {
            margin-bottom: 10px;
        }
        .btn-buy {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-buy:hover {
            background-color: #218838;
        }
        .btn-buy:active {
            background-color: #1e7e34;
        }
        .highlight {
            color: #ffc107;
        }
        .carousel-inner img {
            border-radius: 8px;
        }
        .bank-info {
            background-color: #292929;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .modal-body img {
            width: 100%;
        }
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
    </style>
</head>
<body>
    <div class="content">
        <div class="container">
            <div class="card">
                <button class="btn-buy" onclick="window.history.back();">Kembali Ke Halaman Sebelumnya</button>
                <div class="card-body">
                    <?php if (!empty($akun_ml) && is_array($akun_ml)): ?>
                        <?php foreach ($akun_ml as $account): ?>
                            <input type="hidden" name="kode_akun" value="<?php echo isset($account['kode_akun']) ? $account['kode_akun'] : ''; ?>">
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

                            <div class="bank-info">
                                <h5 class="card-title">Akun Game: <?php echo $account['nama_akun']; ?></h5>
                                <h5 class="card-title">Kode Akun: <?php echo $account['kode_akun']; ?></h5>
                                <p class="card-text">Rank: <?php echo $account['rank']; ?></p>
                                <p class="card-text">Jumlah Hero: <?php echo $account['jumlah_hero']; ?></p>
                                <p class="card-text">Jumlah Skin: <?php echo $account['jumlah_skin']; ?></p>
                                <p class="card-text">Harga: <span class="highlight"><?php echo ($account['harga']); ?></span></p>
                                <p class="card-text">Deskripsi: <?php echo $account['deskripsi']; ?></p>
                                
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
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Tidak ada data akun Mobile Legends yang ditemukan.</p>
                    <?php endif; ?>
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
