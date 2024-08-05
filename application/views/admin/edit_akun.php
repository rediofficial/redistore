<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        body {
            background-color: #1a1a1a; /* Dark background */
            color: white; /* White text */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #2c2c2c; /* Slightly lighter dark background */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Elegant shadow */
            padding: 30px;
            max-width: 600px;
            width: 100%;
            box-sizing: border-box;
        }
        h1 {
            color: #f0f0f0; /* Slightly off-white */
            border-bottom: 2px solid #e91e63; /* Hot pink underline */
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            color: #e0e0e0; /* Slightly off-white */
            display: block;
            margin-bottom: 5px;
        }
        .form-control {
            background-color: #333; /* Darker background for inputs */
            color: white;
            border: 1px solid #e91e63; /* Hot pink border */
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        .form-control::placeholder {
            color: #e0e0e0; /* Slightly off-white placeholder text */
        }
        .btn-primary, .btn-secondary {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            margin-right: 10px; /* Space between buttons */
        }
        .btn-primary {
            background-color: #e91e63;
            border-color: #e91e63;
            color: white;
        }
        .btn-primary:hover {
            background-color: #ff4081; /* Lighter hot pink on hover */
            border-color: #ff4081;
        }
        .btn-secondary {
            background-color: #6c757d; /* Grey background for secondary button */
            border-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #5a6268; /* Darker grey on hover */
            border-color: #545b62;
        }
        .alert-success {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
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

        <?php echo form_open_multipart('admin/confirm_edit_akun/' . $akun_ml['kode_akun']); ?>
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
                <img src="<?php echo base_url('uploads/' . $akun_ml['gambar1']); ?>" alt="Gambar 1" style="max-width: 100px; margin-top: 10px;">
            </div>
            <div class="form-group">
                <label for="gambar2">Gambar 2</label>
                <input type="file" class="form-control" id="gambar2" name="gambar2">
                <img src="<?php echo base_url('uploads/' . $akun_ml['gambar2']); ?>" alt="Gambar 2" style="max-width: 100px; margin-top: 10px;">
            </div>
            <div class="form-group">
                <label for="gambar3">Gambar 3</label>
                <input type="file" class="form-control" id="gambar3" name="gambar3">
                <img src="<?php echo base_url('uploads/' . $akun_ml['gambar3']); ?>" alt="Gambar 3" style="max-width: 100px; margin-top: 10px;">
            </div>
            <div class="form-group">
                <label for="gambar4">Gambar 4</label>
                <input type="file" class="form-control" id="gambar4" name="gambar4">
                <img src="<?php echo base_url('uploads/' . $akun_ml['gambar4']); ?>" alt="Gambar 4" style="max-width: 100px; margin-top: 10px;">
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
            <a href="<?php echo site_url('admin/kelola_akun'); ?>" class="btn btn-secondary">Batal</a>
        <?php echo form_close(); ?>
    </div>
</body>
</html>
