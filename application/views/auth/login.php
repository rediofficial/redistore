<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #1f1c2c, #928dab);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        h1, h3 {
            text-align: center;
        }
        form input[type="text"],
        form input[type="password"],
        form button {
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        form button {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
        .extra-links {
            margin-top: 10px;
            text-align: center;
        }
        .extra-links a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
        }
        .extra-links a:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>Selamat Datang Juragan, Silahkan Login</h3>
        <form action="<?php echo site_url('login/authen'); ?>" method="POST">
        <?php if ($this->session->flashdata('login_failed')): ?>
                <div class="alert alert-danger"><?php echo $this->session->flashdata('login_failed'); ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value="<?php echo set_value('email'); ?>">
                <?php echo form_error('email'); ?>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" value="<?php echo set_value('password'); ?>">
                <?php echo form_error('password'); ?>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="extra-links">
            <a href="<?php echo base_url('login/forgot_password'); ?>">Lupa Password?</a>
            <a href="<?php echo base_url('login/register'); ?>">Daftar Akun</a>
            <a href="<?php echo base_url('/home'); ?>" class="btn btn-back btn-block">Klik, Kembali Ke Beranda</a>

        </div>
    </div>
    
</body>
</html>
