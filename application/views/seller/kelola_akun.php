<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="<?php echo base_url('assets/lightbox2/css/lightbox.min.css'); ?>" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>"> -->
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
            margin-left: 250px;
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
        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            margin-bottom: 20px;
            background: #ff7e00;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #e66b00;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #444;
        }
        .table th {
            background: #333;
            color: #ff7e00;
        }
        .table td {
            color: #e0e0e0;
        }
        .table td a {
            color: #fff;
            text-decoration: none;
        }
        .table td a:hover {
            text-decoration: underline;
        }
        .btn-warning, .btn-danger {
            display: inline-block;
            padding: 5px 10px;
            margin: 5px 0;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn-warning {
            background: #e6b800;
        }
        .btn-warning:hover {
            background: #cc9f00;
        }
        .btn-danger {
            background: #e60000;
        }
        .btn-danger:hover {
            background: #cc0000;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .overlay img {
            max-width: 80%;
            max-height: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $title; ?></h1>

        <a href="<?php echo site_url('seller/posting'); ?>" class="btn btn-primary">Tambah Akun</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Akun</th>
                        <th>Status</th>
                        <th>Nama Akun</th>
                        <th>Gambar 1</th>
                        <th>Gambar 2</th>
                        <th>Gambar 3</th>
                        <th>Gambar 4</th>
                        <th>Username</th>
                        <th>Rank</th>
                        <th>Jumlah Hero</th>
                        <th>Jumlah Skin</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($akun_ml as $akun): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $akun['kode_akun']; ?></td>
                        <td><?php echo $akun['status']; ?></td>
                        <td><?php echo $akun['nama_akun']; ?></td>
                        <td>
                            <a href="javascript:void(0);" onclick="showImage('<?php echo base_url('uploads/' . $akun['gambar1']); ?>')" data-title="Gambar 1">
                                <img src="<?php echo base_url('uploads/' . $akun['gambar1']); ?>" alt="Gambar 1" style="max-width: 100px;" class="img-fluid">
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" onclick="showImage('<?php echo base_url('uploads/' . $akun['gambar2']); ?>')" data-title="Gambar 2">
                                <img src="<?php echo base_url('uploads/' . $akun['gambar2']); ?>" alt="Gambar 2" style="max-width: 100px;" class="img-fluid">
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" onclick="showImage('<?php echo base_url('uploads/' . $akun['gambar3']); ?>')" data-title="Gambar 3">
                                <img src="<?php echo base_url('uploads/' . $akun['gambar3']); ?>" alt="Gambar 3" style="max-width: 100px;" class="img-fluid">
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" onclick="showImage('<?php echo base_url('uploads/' . $akun['gambar4']); ?>')" data-title="Gambar 4">
                                <img src="<?php echo base_url('uploads/' . $akun['gambar4']); ?>" alt="Gambar 4" style="max-width: 100px;" class="img-fluid">
                            </a>
                        </td>
                        <td><?php echo $akun['username']; ?></td>
                        <td><?php echo $akun['rank']; ?></td>
                        <td><?php echo $akun['jumlah_hero']; ?></td>
                        <td><?php echo $akun['jumlah_skin']; ?></td>
                        <td><?php echo $akun['harga']; ?></td>
                        <td><?php echo $akun['deskripsi']; ?></td>
                        <td>
                            <a href="<?php echo site_url('seller/edit/' . $akun['kode_akun']); ?>" class="btn btn-warning">Edit</a>
                            <a href="<?php echo site_url('seller/hapus/' . $akun['kode_akun']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="image-overlay" class="overlay" style="display:none;" onclick="closeOverlay()">
        <img id="overlay-image" src="" alt="Overlay Image">
    </div>
    <script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/lightbox2/js/lightbox-plus-jquery.min.js'); ?>"></script>
    <script>
        function showImage(src) {
            document.getElementById('overlay-image').src = src;
            document.getElementById('image-overlay').style.display = 'flex';
        }

        function closeOverlay() {
            document.getElementById('image-overlay').style.display = 'none';
        }
    </script>
</body>
</html>
