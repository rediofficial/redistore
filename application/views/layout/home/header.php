<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        body {
            font-family: 'Press Start 2P', cursive;

            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background: #1e1e1e;
            padding: 10px 0;
            text-align: center;
        }
        header a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 10px;
        }
        .header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
        }
        .header nav ul li a:hover {
            text-decoration: underline;
        }
        .header nav ul li a.active {
            color: #007bff;
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
                <img src="<?php echo base_url('uploads/maskot.png'); ?>" alt="Logo">
                <span>Redi Store</span>
            </div>
            <div class="menu-toggle" id="menu-toggle">☰</div>
            <nav id="nav">
                <ul>
                    <li><a href="<?php echo site_url('home'); ?>" class="<?php echo ($this->uri->segment(2) == '') ? 'active' : ''; ?>">Beranda</a></li>
                    <li><a href="<?php echo base_url('/home/tentang'); ?>" class="<?php echo ($this->uri->segment(2) == 'tentang') ? 'active' : ''; ?>">Tentang Kami</a></li>
                    <li><a href="<?php echo base_url('/home/stok'); ?>" class="<?php echo ($this->uri->segment(2) == 'stok') ? 'active' : ''; ?>">Stok Akun Mobile Legends</a></li>
                    <li><a href="https://wa.me/6281395441171" target="_blank">Kontak Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var nav = document.getElementById('nav');
            nav.classList.toggle('active');
        });
    </script>
</body>
</html>
