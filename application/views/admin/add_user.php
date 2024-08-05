<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <style>
        body {
            background-color: #000;
            font-family: 'Press Start 2P', cursive;
            color: #f1f1f1;
        }
        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 15px;
            margin-top: 50px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.8);
        }
        .form-control {
            background-color: #333;
            color: #cc0000;
            border: 1px solid #333;
        }
        .btn-primary {
            background-color: #ff0000;
            border: none;
        }
        .btn-primary:hover {
            background-color: #cc0000;
        }
        h1 {
            color: #cc0000;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambahkan Data User</h1>
        <?php echo validation_errors(); ?>
        <?php echo form_open('admin/add_user'); ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password_confirm">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
            </div>
            <div class="form-group">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo set_value('full_name'); ?>" required>
            </div>
            <div class="form-group">
                <label for="nomer_hp">Nomor HP</label>
                <input type="text" class="form-control" id="nomer_hp" name="nomer_hp" value="<?php echo set_value('nomer_hp'); ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat_user">Alamat</label>
                <textarea class="form-control" id="alamat_user" name="alamat_user" required><?php echo set_value('alamat_user'); ?></textarea>
            </div>
            <div class="form-group">
                <label for="role_id">Role Id</label>
                <textarea class="form-control" id="role_id" name="role_id" required><?php echo set_value('role_id'); ?></textarea>
            </div>
            <p></p>
            <button type="submit" class="btn btn-primary btn-block">Tambah Pengguna</button>
        <?php echo form_close(); ?>
    </div>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
</body>
</html>
