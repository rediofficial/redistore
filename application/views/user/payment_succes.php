<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .content {
            padding-top: 50px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Pembayaran Berhasil</h2>
        <p>Terima kasih! Bukti transfer Anda telah berhasil diupload. Kami akan segera memproses pesanan Anda Di Menu Chat!</p>
        <a href="<?php echo base_url('user'); ?>" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</body>
</html>
