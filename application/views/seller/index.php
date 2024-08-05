<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
    <style>
        /* Resetting some basic styles */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Press Start 2P', cursive;
            background-color: #1a1a1a;
            color: #fff;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            margin-left: 200px;
        }

        .dashboard-options {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .option {
            background: #222;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            flex: 1;
            margin: 10px;
            text-align: center;
            border-radius: 8px;
            transition: transform 0.3s ease-in-out;
        }

        .option:hover {
            transform: scale(1.05);
        }

        .option h3 {
            margin-top: 0;
            font-size: 1.2rem;
            color: #1abc9c;
        }

        .option p {
            color: #bbb;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background: #1abc9c;
            color: #fff;
            text-decoration: none;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            border-radius: 4px;
            transition: background 0.3s ease-in-out;
        }

        .button:hover {
            background: #16a085;
        }



        /* Main content */
        .main-content {
            margin-left: 220px; /* Make space for the sidebar */
            padding: 20px;
        }
    </style>
    <header>
        <div class="container">
            <h1>Dashboard Seller</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Welcome, <?php echo $this->session->userdata('full_name'); ?>!</h2>
            <p>Di sini Anda bisa mengelola akun ML Anda yang akan dijual, melihat status penjualan, dan memperbarui informasi profil Anda.</p>
            <div class="dashboard-options">
                <div class="option">
                    <h3>Penjualan Akun</h3>
                    <p>Tambah, edit, atau hapus stok akun Mobile Legends Anda.</p>
                    <a href="<?php echo base_url('seller/kelola_akun'); ?>" class="button">Kelola Akun</a>
                </div>
                <div class="option">
                    <h3>Profile</h3>
                    <p>Perbarui informasi profil Anda.</p>
                    <a href="<?php echo base_url('seller/profile'); ?>" class="button">Perbarui Profil</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
