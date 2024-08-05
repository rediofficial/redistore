<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet"> -->
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #1b1b1b;
            color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 50px auto;
            padding: 20px;
            max-width: 90%;
            background: #2b2b2b;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        h1 {
            text-align: center;
            color: #ff7e00;
            text-shadow: 2px 2px 4px #000;
            margin-bottom: 20px;
        }
        .form-group label {
            color: #ff7e00;
        }
        .form-control {
            background-color: #444;
            border: none;
            border-radius: 5px;
            color: #fff;
        }
        .form-control:focus {
            background-color: #555;
            border-color: #ff7e00;
            box-shadow: none;
        }
        .btn-primary, .btn-secondary {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn-primary {
            background: #ff7e00;
            color: #fff;
        }
        .btn-primary:hover {
            background: #e66b00;
        }
        .btn-secondary {
            background: #555;
            color: #fff;
        }
        .btn-secondary:hover {
            background: #777;
        }
        .alert-success {
            background-color: #28a745;
            border: none;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $title; ?></h1>

        <?php echo validation_errors(); ?>

        <!-- Display Flashdata Success Message -->
        <?php if (!empty($this->session->flashdata('success'))): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php echo form_open_multipart('seller/confirm_edit_akun/' . $akun_ml['kode_akun']); ?>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Pending" <?php echo ($akun_ml['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="Proses" <?php echo ($akun_ml['status'] == 'Proses') ? 'selected' : ''; ?>>Proses</option>
                    <option value="Done" <?php echo ($akun_ml['status'] == 'Done') ? 'selected' : ''; ?>>Done</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_akun">Nama Akun</label>
                <input type="text" class="form-control" id="nama_akun" name="nama_akun" value="<?php echo $akun_ml['nama_akun']; ?>" required>
            </div>
            <div class="form-group">
                <label for="gambar1">Gambar 1</label>
                <input type="file" class="form-control" id="gambar1" name="gambar1">
                <img src="<?php echo base_url('uploads/' . $akun_ml['gambar1']); ?>" alt="Gambar 1" style="max-width: 100px;">
            </div>
            <div class="form-group">
                <label for="gambar2">Gambar 2</label>
                <input type="file" class="form-control" id="gambar2" name="gambar2">
                <img src="<?php echo base_url('uploads/' . $akun_ml['gambar2']); ?>" alt="Gambar 2" style="max-width: 100px;">
            </div>
            <div class="form-group">
                <label for="gambar3">Gambar 3</label>
                <input type="file" class="form-control" id="gambar3" name="gambar3">
                <img src="<?php echo base_url('uploads/' . $akun_ml['gambar3']); ?>" alt="Gambar 3" style="max-width: 100px;">
            </div>
            <div class="form-group">
                <label for="gambar4">Gambar 4</label>
                <input type="file" class="form-control" id="gambar4" name="gambar4">
                <img src="<?php echo base_url('uploads/' . $akun_ml['gambar4']); ?>" alt="Gambar 4" style="max-width: 100px;">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $akun_ml['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="rank">Rank</label>
                <input type="text" class="form-control" id="rank" name="rank" value="<?php echo $akun_ml['rank']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jumlah_hero">Jumlah Hero</label>
                <input type="number" class="form-control" id="jumlah_hero" name="jumlah_hero" value="<?php echo $akun_ml['jumlah_hero']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jumlah_skin">Jumlah Skin</label>
                <input type="number" class="form-control" id="jumlah_skin" name="jumlah_skin" value="<?php echo $akun_ml['jumlah_skin']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $akun_ml['harga']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo $akun_ml['deskripsi']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?php echo site_url('seller/kelola_akun'); ?>" class="btn btn-secondary">Batal</a>
        <?php echo form_close(); ?>
    </div>
</body>
</html>
