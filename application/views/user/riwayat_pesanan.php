<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>"> -->
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #1e1e1e;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        .content {
            padding: 20px;
        }
        .nav-menu {
            background-color: #343a40;
            padding: 10px;
            text-align: center;
        }
        .nav-menu a {
            color: #ffffff;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .nav-menu a:hover {
            color: #1abc9c;
        }
        .dropdown-menu {
            background-color: #343a40;
            border: none;
        }
        .dropdown-item {
            color: #ffffff;
            transition: background-color 0.3s ease;
        }
        .dropdown-item:hover {
            background-color: #1abc9c;
            color: #000000;
        }
        .order-history {
            margin-top: 20px;
            width: 100%;
            max-width: 1200px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            background-color: #2c3e50;
        }
        .order-history h3 {
            background-color: #1abc9c;
            margin: 0;
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
        }
        .order-history table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-history th, .order-history td {
            border: 1px solid #34495e;
            padding: 12px;
            text-align: left;
        }
        .order-history th {
            background-color: #34495e;
            color: white;
            font-size: 1rem;
        }
        .order-history td a {
            color: #1abc9c;
            text-decoration: none;
        }
        .order-history td a:hover {
            text-decoration: underline;
        }
        .order-history select, .order-history textarea, .order-history .btn {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-family: 'Press Start 2P', cursive;
            border: none;
            border-radius: 5px;
        }
        .order-history .btn {
            background-color: #1abc9c;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .order-history .btn:hover {
            background-color: #16a085;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="container">
            <div class="order-history">
                <h3>Riwayat Pesanan</h3>
                <div class="table-responsive">
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Id Unik</th>
                                <th>Tanggal</th>
                                <th>Akun</th>
                                <th>Kode Akun</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Lihat Detail Akun</th>
                                <th>Chat Admin Untuk Menerima Akun</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($transaksi)): ?>
                            <tr>
                                <td colspan="10" style="text-align: center;">Anda belum punya pesanan, Ayo Pesan Segera Abangkuh</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($transaksi as $pesanan): ?>
                                <tr>
                                    <td><?php echo $pesanan['kode_transaksi']; ?></td>
                                    <td><?php echo $pesanan['kode_trx']; ?></td>
                                    <td><?php echo $pesanan['tanggal_pesanan']; ?></td>
                                    <td><?php echo $pesanan['nama_akun']; ?></td>
                                    <td><?php echo $pesanan['kode_akun']; ?></td>
                                    <td><?php echo $pesanan['harga']; ?></td>
                                    <td><?php echo $pesanan['status']; ?></td>
                                    <td><?php echo $pesanan['ket']; ?></td>
                                    <td>
                                        <form action="<?php echo site_url('user/akun_detail'); ?>" method="get">
                                            <input type="hidden" name="kode_transaksi" value="<?php echo $pesanan['kode_transaksi']; ?>">
                                            <button type="submit" class="btn btn-info">Lihat Detail Akun</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="<?php echo site_url('user/chat'); ?>" method="post">
                                            <input type="hidden" name="kode_transaksi" value="<?php echo $pesanan['kode_transaksi']; ?>">
                                            <button type="submit" class="btn btn-success">Chat Admin</button>
                                        </form>      
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                    </table>
                </div>
            </div>
        </div>
        <!-- Live Chat -->
        <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="86cf2103-28ac-4545-98ac-4ea36fa21ad4";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    </div>
    <script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
