<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        
        .footer {
            background-color: #282828;
            color: #ffffff;
            padding: 50px 0;
            text-align: center;
        }
     
        .footer .column {
            flex: 1;
            min-width: 200px;
            margin: 20px 10px;
        }
        .footer h3 {
            margin-bottom: 10px;
            font-size: 18px;
        }
        .footer ul {
            list-style: none;
            padding: 0;
        }
        .footer ul li {
            margin-bottom: 8px;
        }
        .footer ul li a {
            color: #bbbbbb;
            text-decoration: none;
        }
        .footer ul li a:hover {
            text-decoration: underline;
        }
        .footer .social-icons {
            margin-top: 20px;
        }
        .footer .social-icons a {
            margin: 0 10px;
            color: #ffffff;
            text-decoration: none;
        }
        .footer .copy {
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <footer class="footer">
        <div class="container">
            <div class="column">
                <h3>Tentang Kami</h3>
                <p>Kami menyediakan akun game berkualitas tinggi dengan harga terjangkau. Temukan akun impian Anda bersama kami!</p>
            </div>
            <div class="column">
                <h3>Kontak</h3>
                <ul>
                    <li>Email: rediofficial27@gmail.com</li>
                    <li>WhatsApp Admin: +62 813 9544 1171</li>
                    <li>Alamat: Jl. Angsana Raya Mejasem Barat, Tegal, Indonesia</li>
                </ul>
            </div>
            <div class="column">
                <h3>Tautan Cepat</h3>
                <ul>
                    <li><a href="<?php echo base_url('/login/dashboard'); ?>">Beranda</a></li>
                    <li><a href="<?php echo base_url('/home/tentang'); ?>">Tentang Kami</a></li>
                    <li><a href="#products">Stok Akun Mobile Legends</a></li>
                    <li><a href="https://wa.me/6281395441171" target="_blank">Kontak Admin</a></li>
                </ul>
            </div>
            <div class="column social-icons">
                <h3>Ikuti Kami</h3>
                <a href="https://www.facebook.com/sarasara12345211" target="_blank">Facebook</a>
                <a href="https://www.youtube.com/channel/UCHXi-0XVr3YNZgs-6j-hPtg" target="_blank">YouTube</a>
                <a href="https://www.instagram.com/redi_gamingyt27/" target="_blank">Instagram</a>
            </div>
        </div>
        <div class="copy">
            &copy; 2024 Redi Store All rights reserved.
        </div>
    </footer>
</body>
</html>
