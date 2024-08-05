<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: #fff;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            display: block;
        }
        header {
            background: #1f1c2c;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            flex-wrap: wrap;
        }
        .header .logo {
            display: flex;
            align-items: center;
        }
        .header .logo img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        .header .logo span {
            font-size: 24px;
            font-weight: bold;
        }
        .header nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
        }
        .header nav ul li {
            margin: 0 15px;
        }
        .header nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }
        .header nav ul li a:hover {
            text-decoration: underline;
        }
        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .header .container {
                flex-direction: column;
                text-align: center;
            }
            .menu-toggle {
                display: block;
            }
            .header nav {
                display: none;
                width: 100%;
            }
            .header nav ul {
                flex-direction: column;
                margin-top: 10px;
            }
            .header nav ul li {
                margin: 10px 0;
            }
            .header nav.active {
                display: block;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <a class="navbar-brand" href="<?php echo site_url('home'); ?>">
                    <img src="<?php echo base_url('uploads/maskot.png'); ?>"  alt="Logo">
                </a> 
                <span>Redi Store</span>
            </div>
            <div class="menu-toggle" id="menu-toggle">☰</div>
            <nav id="nav">
                <ul>
                    <li><a href="<?php echo site_url('home'); ?>">Beranda</a></li>
                    <li><a href="<?php echo base_url('/home/tentang'); ?>">Tentang Kami</a></li>
                    <li><a href="<?php echo base_url('/home/stok'); ?>">Stok Akun Mobile Legends</a></li>
                    <li><a href="https://wa.me/6281395441171" target="_blank">Kontak Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="container">
        <h1>Selamat Datang di Redi Store</h1>
    </div>
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var nav = document.getElementById('nav');
            nav.classList.toggle('active');
        });
    </script>
</body>
</html>
