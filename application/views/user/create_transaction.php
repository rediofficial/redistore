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
            padding-top: 50px;
            padding-left: 220px;
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

    </style>
</head>
<body>

    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <?php foreach ($akun_ml as $account): ?>
                        <h5 class="card-title">Pembayaran untuk Akun: <?php echo $account['nama_akun']; ?></h5>
                        <img class="card-img-top" src="<?php echo base_url('uploads/' . $account['gambar1']); ?>" alt="Gambar Akun">
                        <p class="card-text">Harga: Rp <?php echo ($account['harga']); ?></p>
                        <p class="card-text"><?php echo $account['deskripsi']; ?></p>
                        <p class="card-text">Silakan lakukan pembayaran ke nomor rekening berikut:</p>
                        <p class="card-text"><strong>Bank: XYZ</strong></p>
                        <p class="card-text"><strong>Nomor Rekening: 1234567890</strong></p>
                        <p class="card-text"><strong>Nama: Redi Store</strong></p>
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

                        <p>Setelah melakukan pembayaran, silakan upload bukti transfer Anda di bawah ini:</p>

                        <form action="<?php echo base_url('user/upload_proof'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="kode_transaksi" value="<?php echo isset($kode_transaksi) ? $kode_transaksi : ''; ?>">

                            <div class="form-group">
                                <label for="metode_pembayaran">Metode Pembayaran:</label>
                                <select class="form-control" id="metode_pembayaran" name="metode_pembayaran" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="Dana">Dana</option>
                                    <option value="Qris">Qris</option>
                                    <option value="Bank">Bank</option>
                                    <option value="Shoppe Pay">Shoppe Pay</option>
                                    <option value="Gopay">Gopay</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="bukti_transfer">Upload Bukti Transfer:</label>
                                <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" required>
                            </div>
                            <button type="submit" class="btn btn-buy">Kirim Bukti Transfer</button>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
