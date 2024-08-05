<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            background-color: #343a40;
            color: #fff;
            height: 100vh;
            padding: 20px;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            transition: transform 0.3s ease;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
        }
        .sidebar.closed {
            transform: translateX(-250px);
        }
        .sidebar .logo {
            text-align: center;
        }
        .sidebar .logo img {
            max-width: 150px;
            height: auto;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 4px;
            transition: background 0.3s ease;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: #007bff;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .content {
            margin-left: 270px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .content.closed {
            margin-left: 20px;
        }
        .navbar {
            background-color: #343a40;
            padding: 10px;
            margin-left: 250px;
            transition: margin-left 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }
        .navbar.closed {
            margin-left: 0;
        }
        .navbar-brand {
            margin-left: 50px;
            color: #007bff;
            text-decoration: none;
            font-size: 1.5rem;
        }
        .navbar-nav .nav-link {
            color: #007bff;
        }
        .navbar-nav .nav-link:hover {
            color: #d6d6d6;
        }
        .dropdown-menu {
            background-color: #343a40;
            border: none;
        }
        .dropdown-menu a {
            color: #fff;
        }
        .dropdown-menu a:hover {
            background-color: #007bff;
        }
        .toggle-btn {
            background-color: #343a40;
            border: none;
            color: #fff;
            padding: 10px;
            cursor: pointer;
            position: fixed;
            top: 10px;
            left: 260px;
            transition: left 0.3s ease;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        }
        .sidebar.closed ~ .toggle-btn {
            left: 10px;
        }
        .alert {
            text-align: center;
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
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Redi Store</a>
        <ul class="navbar-nav ml-auto">
            <!-- Notifikasi Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <?php if ($notif_count > 0): ?>
                        <span class="badge badge-danger"><?php echo $notif_count; ?></span>
                    <?php endif; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown">
                    <?php if (!empty($notifications)): ?>
                        <?php foreach ($notifications as $notification): ?>
                            <a class="dropdown-item" href="#"><?php echo $notification->message; ?><br><small><?php echo $notification->created_at; ?></small></a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <a class="dropdown-item" href="#">Tidak ada notifikasi</a>
                    <?php endif; ?>
                </div>
            </li>
            <!-- Profil Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu Profil Juragan <?php echo isset($user->full_name) ? htmlspecialchars($user->full_name) : 'Tidak diketahui'; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="<?php echo site_url('user/profile'); ?>">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo site_url('login/logout'); ?>">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="sidebar" id="sidebar">
        <div class="logo">
        <img src="<?php echo base_url('uploads/maskot.png'); ?>" alt="Logo Redi Store">
        </div>
        <a href="<?php echo site_url('user'); ?>" class="<?php echo ($title == 'Beranda') ? 'active' : ''; ?>">
            <i class="fas fa-home"></i> Beranda
        </a>
        <a href="<?php echo site_url('user/riwayat_pesanan/'); ?>" class="<?php echo ($title == 'Riwayat Pesanan') ? 'active' : ''; ?>">
            <i class="fas fa-history"></i> Riwayat Pesanan
        </a>
        <a href="<?php echo site_url('user/chat'); ?>" class="<?php echo ($title == 'Chat') ? 'active' : ''; ?>">
            <i class="fas fa-comments"></i> Chat Seller
        </a>
        <a href="<?php echo site_url('review/buat'); ?>" class="<?php echo ($title == 'Review') ? 'active' : ''; ?>">
            <i class="fas fa-pencil-alt"></i> Beri Testimoni
        </a>
        <a href="<?php echo site_url('review'); ?>" class="<?php echo ($title == 'Testimoni Orang!') ? 'active' : ''; ?>">
            <i class="fas fa-star"></i> Lihat Testimoni
        </a>
    </div>
    <button class="toggle-btn" id="toggle-btn">☰</button>
    <div class="content" id="content">
        <h1>Welcome, <?php echo $user->full_name ?>!</h1>
        <!-- Content goes here -->
    </div>
        <?php 
        $error_message = $this->session->flashdata('error');
        if (is_array($error_message)) {
            $error_message = implode(', ', $error_message); // Convert array to string
        }
        if (!empty($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo ($error_message); ?>
            </div>
        <?php endif; ?>

        <!-- Display Flashdata Success Message -->
        <?php 
        $success_message = $this->session->flashdata('success');
        if (is_array($success_message)) {
            $success_message = implode(', ', $success_message); // Convert array to string
        }
        if (!empty($success_message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo ($success_message); ?>
            </div>
        <?php endif; ?>

        <!-- Content for payment form -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggle-btn').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('content');
            var navbar = document.querySelector('.navbar');
            sidebar.classList.toggle('closed');
            content.classList.toggle('closed');
            navbar.classList.toggle('closed');
        });
    </script>
</body>
</html>
