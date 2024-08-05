<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            background: linear-gradient(135deg, #1e1e1e, #2c2c2c);
            margin: 0;
            padding: 0;
            color: #fff;
        }
        .container {
            margin: 50px auto;
            max-width: 800px;
            margin-left: 280px;
            padding: 20px;
            background: #2c2c2c;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.5);
            text-align: center;
        }
        h2, h3 {
            color: #ff4500;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #e0e0e0;
        }
        .form-group label {
            color: #ff4500;
        }
        .form-control {
            background: #333;
            border: none;
            color: #fff;
            border-radius: 5px;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(255, 69, 0, 0.5);
        }
        .btn-primary {
            background-color: #ff4500;
            border-color: #ff4500;
            font-family: 'Press Start 2P', cursive;
            text-transform: uppercase;
        }
        .btn-primary:hover {
            background-color: #e63e00;
            border-color: #e63e00;
        }
        .alert {
            text-align: center;
            color: #000;
            font-size: 16px;
            font-weight: bold;
            border-radius: 10px;
        }
        .alert-success {
            background-color: #28a745;
            color: #fff;
        }
        .alert-danger {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <h2>Profil Pengguna</h2>
        <p>Nama: <?php echo isset($user->full_name) ? htmlspecialchars($user->full_name) : 'Tidak diketahui'; ?></p>
        <p>Email: <?php echo isset($user->email) ? htmlspecialchars($user->email) : 'Tidak diketahui'; ?></p>

        <h3>Ubah Profil</h3>
        <form action="<?php echo site_url('admin/update_profile'); ?>" method="post">
            <div class="form-group">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo isset($user->full_name) ? htmlspecialchars($user->full_name) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($user->email) ? htmlspecialchars($user->email) : ''; ?>" required>
            </div>
            <p></p>
            <button type="submit" class="btn btn-primary">Ubah Profile</button>
        </form>
        <p></p>

        <h3>Ganti Sandi</h3>
        <form action="<?php echo site_url('admin/change_password'); ?>" method="post">
            <div class="form-group">
                <label for="current_password">Sandi Saat Ini</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">Sandi Baru</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Sandi Baru</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <p></p>

            <button type="submit" class="btn btn-primary">Ganti Sandi</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
