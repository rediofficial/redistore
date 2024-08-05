<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            background-image: url('<?php echo base_url('assets/img/bg-gamers.jpg'); ?>');
            background-size: cover;
            background-repeat: no-repeat;
            color: #fff;
            background: linear-gradient(120deg, #1f1c2c, #928dab);

        }
        .register-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.8);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .register-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 5px;
            background-color: #333;
            border: none;
            color: #fff;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .form-text {
            text-align: center;
            margin-top: 10px;
        }
        .form-text a {
            color: #007bff;
        }
        .form-text a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="register-title">Register</h2>
        <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-info">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php endif; ?>
        <?php echo validation_errors(); ?>
        <form action="<?php echo site_url('login/register'); ?>" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="role_id" value="3">
            <div class="form-group">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="nomer_hp">No Hp</label>
                <input type="tel" class="form-control" id="nomer_hp" name="nomer_hp" required>
            </div>
            <div class="form-group">
                <label for="alamat_user">Alamat</label>
                <input type="text" class="form-control" id="alamat_user" name="alamat_user" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="error" id="passwordError"></div>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <p class="form-text">Sudah punya akun ? <a href="<?php echo site_url('login'); ?>">Login Disini</a>.</p>
        </form>
    </div>


    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script>
        function validateForm() {
            var password = document.getElementById('password').value;
            var passwordError = document.getElementById('passwordError');
            if (password.length < 6) {
                passwordError.textContent = 'Password harus memiliki minimal 6 karakter.';
                return false;
            } else {
                passwordError.textContent = '';
                return true;
            }
        }
    </script>
</body>
</html>
