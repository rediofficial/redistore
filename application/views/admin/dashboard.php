<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <style>
        /* Resetting some basic styles */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Press Start 2P', cursive;
            background-color: #0d0d0d;
            color: #c5c6c7;
        }

        .container {
            max-width: 1200px;
            margin-left: 190px;
            padding: 20px;
        }

        .dashboard-options {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .option {
            background: #1f1f1f;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            flex: 1;
            margin: 10px;
            text-align: center;
            border-radius: 10px;
            border: 2px solid #66fcf1;
        }

        .option h3 {
            margin-top: 0;
            color: #66fcf1;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            background: #66fcf1;
            color: #0d0d0d;
            text-decoration: none;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            border-radius: 5px;
            font-family: 'Press Start 2P', cursive;
        }

        .button:hover {
            background: #45a29e;
        }

        /* Main content */
        .main-content {
            margin-left: 220px; /* Make space for the sidebar */
            padding: 20px;
        }
    </style>
    <header>
        <div class="container">
            <h1>Dashboard Admin</h1>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <h2>Welcome, <?php echo $this->session->userdata('full_name'); ?>!</h2>
            <p>Di sini Anda bisa mengelola semuanya!</p>
            <div class="dashboard-options">
                <div class="option">
                    <h3>Penjualan Akun</h3>
                    <p>Tambah, edit, atau hapus stok akun Mobile Legends Anda.</p>
                    <a href="<?php echo base_url('admin/kelola_akun'); ?>" class="button">Kelola Akun</a>
                </div>
                <div class="option">
                    <h3>Profil</h3>
                    <p>Perbarui informasi profil Anda.</p>
                    <a href="<?php echo base_url('admin/profile'); ?>" class="button">Perbarui Profil</a>
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>
</html>
