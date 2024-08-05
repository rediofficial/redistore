<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #1b1b1b;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 50px auto;
            padding: 20px;
            max-width: 800px;
            background: #2b2b2b;
            border-radius: 15px;
            margin-left: 250px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        h2 {
            text-align: center;
            color: #ff7e00;
            text-shadow: 2px 2px 4px #000;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #333;
            color: #fff;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .form-group input[type="file"] {
            padding: 3px;
            background: #444;
            border: 2px solid #555;
        }
        .form-group input[type="file"]::-webkit-file-upload-button {
            background: #ff7e00;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .form-group input[type="file"]::-webkit-file-upload-button:hover {
            background: #e66b00;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            box-shadow: 0 0 5px #ff7e00;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: #ff7e00;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #e66b00;
        }
        .form-icon {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo $title; ?></h2>
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('seller/posting'); ?>
            <div class="form-group">
                <label for="nama_akun"><i class="fas fa-user form-icon"></i>Nama Akun</label>
                <input type="text" name="nama_akun" class="form-control" id="nama_akun">
            </div>
            <div class="form-group">
                <label for="gambar1"><i class="fas fa-image form-icon"></i>Gambar 1 (thumbnail)</label>
                <input type="file" name="gambar1" class="form-control" id="gambar1">
            </div>
            <div class="form-group">
                <label for="gambar2"><i class="fas fa-image form-icon"></i>Gambar 2</label>
                <input type="file" name="gambar2" class="form-control" id="gambar2">
            </div>
            <div class="form-group">
                <label for="gambar3"><i class="fas fa-image form-icon"></i>Gambar 3</label>
                <input type="file" name="gambar3" class="form-control" id="gambar3">
            </div>
            <div class="form-group">
                <label for="gambar4"><i class="fas fa-image form-icon"></i>Gambar 4</label>
                <input type="file" name="gambar4" class="form-control" id="gambar4">
            </div>
            <div class="form-group">
                <label for="rank"><i class="fas fa-medal form-icon"></i>Rank</label>
                <input type="text" name="rank" class="form-control" id="rank">
            </div>
            <div class="form-group">
                <label for="jumlah_hero"><i class="fas fa-users form-icon"></i>Jumlah Hero</label>
                <input type="number" name="jumlah_hero" class="form-control" id="jumlah_hero">
            </div>
            <div class="form-group">
                <label for="jumlah_skin"><i class="fas fa-tshirt form-icon"></i>Jumlah Skin</label>
                <input type="number" name="jumlah_skin" class="form-control" id="jumlah_skin">
            </div>
            <div class="form-group">
                <label for="harga"><i class="fas fa-dollar-sign form-icon"></i>Harga</label>
                <input type="text" name="harga" class="form-control" id="harga">
            </div>
            <div class="form-group">
                <label for="deskripsi"><i class="fas fa-align-left form-icon"></i>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="deskripsi"></textarea>
            </div>
            <button type="submit" class="btn"><i class="fas fa-paper-plane"></i> Submit</button>
        <?php echo form_close(); ?>
    </div>
</body>
</html>
