<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
    <style>
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
            padding: 10px 15px;
            position: fixed;
            width: 200px;
            top: 0;
            left: 0;
            transition: transform 0.3s ease;
            z-index: 1000;
        }
        .sidebar.closed {
            transform: translateX(-200px);
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex; /* Align icons with text */
            align-items: center; /* Align icons with text */
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .sidebar a i {
            margin-right: 10px; /* Add space between icon and text */
        }
        .content {
            margin-left: 220px; /* Menggeser konten ke kanan */
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        .content.closed {
            margin-left: 20px;
        }
        .sidebar a.active {
            background-color: #007bff;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .navbar {
            background-color: #343a40;
            padding: 5px; /* Kurangi padding pada navbar */
            margin-left: 200px;
            transition: margin-left 0.3s ease;
            z-index: 1000;
        }
        .navbar.closed {
            margin-left: 0;
        }
        .navbar-brand {
            margin-left: 50px; /* Menggeser konten ke kanan */
            color: #fff;
            text-decoration: none;
            font-size: 1.5rem;
        }
        .navbar-nav .nav-link {
            color: #fff;
        }
        .dropdown-menu a {
            color: #343a40;
        }
        .alert {
            margin-top: 5px; /* Kurangi margin atas pada alert */
        }
        .toggle-btn {
            background-color: #343a40;
            border: none;
            color: white;
            padding: 10px;
            cursor: pointer;
            position: fixed;
            top: 10px;
            left: 210px;
            transition: left 0.3s ease;
            z-index: 1001;
        }
        .sidebar.closed ~ .toggle-btn {
            left: 10px;
        }
     @media (max-width: 768px) {
    .sidebar {
        transform: translateX(-200px);
        width: 200px;
    }
    .content {
        margin-left: 0;
    }
    .navbar {
        margin-left: 0;
    }
    .toggle-btn {
        left: 10px;
    }
    .sidebar.open {
        transform: translateX(0);
    }
    .content.open {
        margin-left: 200px;
    }
    .navbar.open {
        margin-left: 200px;
    }
    .sidebar.closed ~ .toggle-btn {
        left: 10px;
    }
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
                            <a class="dropdown-item" href="#"><?php echo htmlspecialchars($notification->message); ?><br><small> Tanggal <?php echo htmlspecialchars($notification->created_at); ?></small></a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <a class="dropdown-item" href="#">Tidak ada notifikasi</a>
                    <?php endif; ?>
                </div>
            </li>
            <!-- Profil Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu Profil Owner <?php echo isset($user->full_name) ? htmlspecialchars($user->full_name) : 'Tidak diketahui'; ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo base_url('admin/profile'); ?>">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo site_url('login/logout'); ?>">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="sidebar" id="sidebar">
        <a href="<?php echo site_url('admin'); ?>" class="<?php echo ($title == 'Beranda') ? 'active' : ''; ?>">
            <i class="fas fa-home"></i> Beranda
        </a>
        <a href="<?php echo site_url('admin/kelola_user'); ?>" class="<?php echo ($title == 'Kelola User') ? 'active' : ''; ?>">
            <i class="fas fa-user-cog"></i> Kelola User
        </a>
        <a href="<?php echo site_url('admin/riwayat_pesanan'); ?>" class="<?php echo ($title == 'Riwayat Pesanan') ? 'active' : ''; ?>">
            <i class="fas fa-history"></i> Kelola Transaksi
        </a>
        <a href="<?php echo site_url('admin/review'); ?>" class="<?php echo ($title == 'Kelola Review') ? 'active' : ''; ?>">
            <i class="fas fa-star"></i> Kelola Review
        </a>
        <a href="<?php echo site_url('admin/kelola_akun'); ?>" class="<?php echo ($title == 'Kelola Akun') ? 'active' : ''; ?>">
            <i class="fas fa-user"></i> Kelola Akun
        </a>
        <a href="<?php echo site_url('notification/create'); ?>" class="<?php echo ($title == 'Buat Notif') ? 'active' : ''; ?>">
            <i class="fas fa-bell"></i> Buat Notifikasi Ke User
        </a>
    </div>       

    <button class="toggle-btn" id="toggle-btn">☰</button>
    <div class="content" id="content">
        <!-- Display Flashdata Error Message -->
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
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- Include FontAwesome for icons -->
    <script>
     document.getElementById('toggle-btn').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    var content = document.getElementById('content');
    var navbar = document.querySelector('.navbar');
    var btn = document.getElementById('toggle-btn');
    
    sidebar.classList.toggle('closed');
    content.classList.toggle('closed');
    navbar.classList.toggle('closed');
    
    sidebar.classList.toggle('open');
    content.classList.toggle('open');
    navbar.classList.toggle('open');
});

// For responsive behavior
$(document).ready(function() {
    var sidebar = document.getElementById('sidebar');
    var content = document.getElementById('content');
    var navbar = document.querySelector('.navbar');

    function checkScreenSize() {
        if ($(window).width() <= 768) {
            sidebar.classList.add('closed');
            content.classList.add('closed');
            navbar.classList.add('closed');
        } else {
            sidebar.classList.remove('closed');
            content.classList.remove('closed');
            navbar.classList.remove('closed');
        }
    }

    checkScreenSize();
    $(window).resize(checkScreenSize);
});
</script>
</body>
</html>
