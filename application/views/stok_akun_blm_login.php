<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            margin: 0;
            padding: 0;
            background-color: #1e1e1e;
            color: #fff;
        }
        .content {
            padding: 20px;
        }
        .search-bar {
            margin-bottom: 20px;
            text-align: center;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border: none;
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: #292929;
            max-width: 300px;
            margin: 10px;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 16px rgba(0, 0, 0, 0.3);
        }
        .card img {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            width: 100%;
            height: auto;
        }
        .card-body {
            padding: 15px;
            text-align: center;
        }
        .card-title {
            font-size: 1rem;
            font-weight: bold;
            margin: 10px 0;
        }
        .card-text {
            font-size: 0.9rem;
            margin: 5px 0;
        }
        .btn-sold, .btn-buy {
            display: inline-block;
            padding: 8px 16px;
            font-size: 0.8rem;
            font-weight: bold;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-sold {
            background-color: red;
            color: white;
        }
        .btn-buy {
            background-color: green;
            color: white;
        }
        .btn-buy:hover {
            background-color: #218838;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
    </style>
</head>
<body>
<div class="content">
        <div class="search-bar">
            <form action="<?php echo base_url('/home/search_stok'); ?>" method="get">
                <input type="text" name="search" placeholder="Cari Kebutuhan Kamu" class="form-control" style="display:inline-block; width: 60%; font-family: 'Press Start 2P', cursive; background-color: #ffffff; color: #000000; border: 1px solid #444;">
                <button type="submit" class="btn btn-primary" style="margin-left: 10px; font-family: 'Press Start 2P', cursive;">Search</button>
            </form>
        </div>

    <div class="container">
        <?php if (empty($akun_ml)): ?>
            <p>Tidak ada hasil pencarian yang cocok dengan kata kunci Anda.</p>
        <?php else: ?>
            <?php foreach ($akun_ml as $account): ?>
                <div class="card">
                    <img src="<?php echo base_url('uploads/' . $account['gambar1']); ?>" alt="Gambar Akun">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $account['nama_akun']; ?></h5>
                        <p class="card-text">Kode Akun: <?php echo $account['kode_akun']; ?></p>
                        <p class="card-text">Rank: <?php echo $account['rank']; ?></p>
                        <p class="card-text">Jumlah Hero: <?php echo $account['jumlah_hero']; ?></p>
                        <p class="card-text">Jumlah Skin: <?php echo $account['jumlah_skin']; ?></p>
                        <p class="card-text">Harga: <?php echo $account['harga']; ?></p>
                        <p class="card-text">Deskripsi: <?php echo $account['deskripsi']; ?></p>
                        <?php if (in_array($account['status'], ['Proses', 'Done'])): ?>
                            <button class="btn-sold" disabled>Terjual</button>
                        <?php else: ?>
                            <form action="<?php echo base_url('user/payment'); ?>" method="post">
                                <input type="hidden" name="akun_ml_id" value="<?php echo $account['id_user']; ?>">
                                <button type="submit" class="btn-buy">Beli</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
