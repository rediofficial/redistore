<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="<?php echo base_url('assets/lightbox2/css/lightbox.min.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1a1a1a; /* Dark background */
            color: white; /* White text */
            font-family: 'Press Start 2P', cursive;
        }
        .container {
            margin-left: 230px;
            padding: 20px;
        }
        h1 {
            color: #e0e0e0; /* Slightly off-white */
            border-bottom: 2px solid #e91e63; /* Hot pink underline */
            padding-bottom: 10px;
        }
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch; /* Enable momentum scrolling on iOS */
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #e0e0e0; /* Slightly off-white */
        }
        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #e91e63; /* Hot pink border */
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #e91e63; /* Hot pink border */
        }
        .table-bordered {
            border: 1px solid #e91e63; /* Hot pink border */
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: black;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .overlay img {
            max-width: 80%;
            max-height: 80%;
            border: 5px solid #e91e63; /* Hot pink border */
        }
        a {
            color: #e91e63; /* Hot pink links */
        }
        a:hover {
            color: #ff4081; /* Lighter hot pink on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $title; ?></h1>

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
                                <img src="<?php echo base_url('uploads/' . $akun['gambar1']); ?>" alt="Gambar 1" style="max-width: 100px;">
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" onclick="showImage('<?php echo base_url('uploads/' . $akun['gambar2']); ?>')" data-title="Gambar 2">
                                <img src="<?php echo base_url('uploads/' . $akun['gambar2']); ?>" alt="Gambar 2" style="max-width: 100px;">
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" onclick="showImage('<?php echo base_url('uploads/' . $akun['gambar3']); ?>')" data-title="Gambar 3">
                                <img src="<?php echo base_url('uploads/' . $akun['gambar3']); ?>" alt="Gambar 3" style="max-width: 100px;">
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" onclick="showImage('<?php echo base_url('uploads/' . $akun['gambar4']); ?>')" data-title="Gambar 4">
                                <img src="<?php echo base_url('uploads/' . $akun['gambar4']); ?>" alt="Gambar 4" style="max-width: 100px;">
                            </a>
                        </td>
                        <td><?php echo $akun['username']; ?></td>
                        <td><?php echo $akun['rank']; ?></td>
                        <td><?php echo $akun['jumlah_hero']; ?></td>
                        <td><?php echo $akun['jumlah_skin']; ?></td>
                        <td><?php echo $akun['harga']; ?></td>
                        <td><?php echo $akun['deskripsi']; ?></td>
                        <td>
                            <a href="<?php echo site_url('admin/edit/' . $akun['kode_akun']); ?>" class="btn btn-warning">Edit</a>
                            <a href="<?php echo site_url('admin/hapus/' . $akun['kode_akun']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">Hapus</a>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
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
