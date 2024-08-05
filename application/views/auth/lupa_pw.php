<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1f1c2c;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            width: 400px;
        }
        .error, .message {
            margin-bottom: 15px;
        }
        .error {
            color: #e74c3c;
        }
        .message {
            color: #27ae60;
        }
        .btn-custom {
            background-color: #28a745;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .btn-back {
            margin-top: 15px;
            background-color: #007bff;
        }
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            visibility: hidden;
        }
        .loading-overlay.active {
            visibility: visible;
        }
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="container">
        <h2 class="text-center">Lupa Password</h2>
        <?php echo validation_errors('<div class="error">', '</div>'); ?>
        <?php if ($this->session->flashdata('message')): ?>
            <div class="message"><?php echo $this->session->flashdata('message'); ?></div>
        <?php endif; ?>
        <form action="<?php echo site_url('login/forgot_password'); ?>" method="post" onsubmit="showLoading()">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
            </div>
            <button type="submit" class="btn btn-custom btn-block">Reset Password</button>
        </form>
        <a href="<?php echo base_url('/login'); ?>" class="btn btn-back btn-block">Klik, Untuk Kembali Login</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showLoading() {
            document.getElementById('loadingOverlay').classList.add('active');
        }
    </script>
</body>
</html>
