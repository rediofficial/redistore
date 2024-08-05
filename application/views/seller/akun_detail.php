<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            margin: 0;
            padding: 0;
            background-color: #000; /* Warna latar belakang hitam */
            color: #fff; /* Warna teks putih */
        }
        .content {
            padding-top: 20px;
            background-color: #000; /* Warna latar belakang hitam */
            color: #fff; /* Warna teks putih */
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            color: #fff; /* Warna teks putih */
        }
        .card {
            background-color: #333; /* Warna latar belakang kartu */
            color: #fff; /* Warna teks kartu */
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
            margin-top: 20px;
        }
        .card-body {
            padding: 20px;
        }
        .btn-buy {
            background-color: #000; /* Warna latar belakang tombol */
            color: #fff; /* Warna teks tombol */
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
        }
        .btn-buy:hover {
            background-color: #218838;
        }
        .qr-image {
            max-width: 50%;
            height: auto;
            cursor: pointer;
        }
        .modal-content img {
            max-width: 100%;
            height: auto;
        }
        .back-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #45a049;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 50%, 50%;
        }
        .carousel-control-prev-icon {
            background-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" fill="%23ffffff" viewBox="0 0 16 16"%3E%3Cpath d="M11.354 15.354a.5.5 0 0 0 0-.708l-6-6a.5.5 0 0 0 0-.708l6-6a.5.5 0 1 0-.708-.708l-6 6a.5.5 0 0 0 0 .708l6 6a.5.5 0 0 0 .708 0z"/%3E%3C/svg%3E');
        }
        .carousel-control-next-icon {
            background-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" fill="%23ffffff" viewBox="0 0 16 16"%3E%3Cpath d="M4.646 15.354a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 0-.708l-6-6a.5.5 0 1 1 .708-.708l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708 0z"/%3E%3C/svg%3E');
        }
        .carousel-item img {
            cursor: pointer;
        }
        .card-text {
            font-size: 18px;
            line-height: 1.6;
            color: #fff; /* Warna teks kartu */
        }
        .highlight {
            color: #dc3545;
            font-weight: bold;
        }
        .bank-info {
            background-color: #555; /* Warna latar belakang informasi bank */
            color: #fff; /* Warna teks informasi bank */
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .bank-info p {
            margin: 0;
        }
        .centered-text {
            text-align: center;
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }
        .print-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .print-button:hover {
            background-color: #0056b3;
        }
        @media print {
            .card-text {
                color: #000 !important; /* Ubah warna teks menjadi hitam untuk pencetakan */
            }
            .highlight {
                color: #000 !important; /* Ubah warna highlight menjadi hitam untuk pencetakan */
            }
            .bank-info {
                background-color: #fff !important; /* Ubah latar belakang informasi bank menjadi putih */
                color: #000 !important; /* Ubah warna teks informasi bank menjadi hitam */
            }
        }
        .payment-proof {
            max-width: 300px; /* Lebar maksimal gambar bukti pembayaran */
            height: auto;
            display: block;
            margin: 0 auto; /* Tengah secara horizontal */
        }
        @media (max-width: 767px) {
            .payment-proof {
                max-width: 100%; /* Lebar penuh pada perangkat kecil */
            }
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="container">
            <div class="card">
                <button class="back-button" onclick="window.history.back();">Kembali Ke Halaman Sebelumnya</button>
                <button class="print-button" onclick="printPDF()">Cetak PDF</button>
                <div class="card-body" id="pdf-content">
                    <?php if (isset($transaksi) && is_array($transaksi) && !empty($transaksi)): ?>
                        <?php foreach ($transaksi as $account): ?>
                            <input type="hidden" name="kode_transaksi" value="<?php echo isset($kode_transaksi) ? $kode_transaksi : ''; ?>">
                            <input type="hidden" name="akun_ml_id" value="<?php echo $account['kode_akun']; ?>">

                            <h5 class="card-title">Riwayat Transakasi Untuk Akun: <?php echo $account['nama_akun']; ?></h5>
                            <h5 class="card-title">Kode Transaksi: <?php echo $account['kode_transaksi']; ?></h5>
                            <h5 class="card-title">Kode Akun: <?php echo $account['kode_akun']; ?></h5>
                            <h5 class="card-title">Id Transaksi: <?php echo $account['kode_trx']; ?></h5>
                            <h5 class="card-title">Tanggal Pesanan: <?php echo $account['tanggal_pesanan']; ?></h5>
                            <div id="carouselExampleControls<?php echo $account['kode_akun']; ?>" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <?php 
                                    $gambar_columns = ['gambar1', 'gambar2', 'gambar3', 'gambar4'];
                                    $first = true;

                                    foreach ($gambar_columns as $column) {
                                        if (!empty($account[$column])) {
                                            $active_class = $first ? 'active' : '';
                                            $img_url = base_url('uploads/' . $account[$column]);
                                            echo '<div class="carousel-item ' . $active_class . '">';
                                            echo '<img class="d-block w-100" src="' . $img_url . '" alt="Gambar Akun" data-toggle="modal" data-target="#imageModal' . $account['kode_akun'] . '" onclick="setModalImage(\'' . $img_url . '\', \'' . $account['kode_akun'] . '\')">';
                                            echo '</div>';
                                            $first = false;
                                        }
                                    }
                                    ?>
                                </div>
                  
                                </a>
                            </div>
            
                            <div class="modal fade" id="imageModal<?php echo $account['kode_akun']; ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel<?php echo $account['kode_akun']; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img id="modalImage<?php echo $account['kode_akun']; ?>" src="" class="img-fluid" alt="Gambar Akun">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function setModalImage(imageUrl, akunId) {
                                    var modalImage = document.getElementById('modalImage' + akunId);
                                    modalImage.src = imageUrl;
                                }
                            </script>

                            <div class="card-text">
                                <h1 class="card-title">*Spek Akun*</h1>
                                <p class="card-text">Rank : <?php echo $account['rank']; ?></p>
                                <p class="card-text">Jumlah Hero : <?php echo $account['jumlah_hero']; ?></p>
                                <p class="card-text">Jumlah Skin : <?php echo $account['jumlah_skin']; ?></p>
                                <p class="card-text">Harga: <span class="highlight"><?php echo ($account['harga']); ?></span></p>
                                <p class="card-text">Deskripsi : <?php echo $account['deskripsi']; ?></p>
                            </div>
                        <?php endforeach; ?>
                    
                        <div class="bank-info">
                            <?php foreach ($transaksi as $tr): ?>
                                <p><strong>BUKTI PEMBAYARAN</strong></p>
                                <p class="card-text">Metode Pembayaran : <?php echo $tr['metode_pembayaran']; ?></p>
                                <img src="<?php echo base_url('uploads/' . $tr['bukti_transfer']); ?>" alt="Bukti Transfer" class="payment-proof">
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <h5 class="card-title">Data Transaksi Tidak Ditemukan</h5>
                        <p class="card-text">Maaf, transaksi yang Anda cari tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        async function printPDF() {
            var { jsPDF } = window.jspdf;
            var content = document.getElementById('pdf-content');
            var elements = content.querySelectorAll('*');
            
            // Simpan warna asli
            var originalColors = [];
            elements.forEach((element, index) => {
                originalColors[index] = element.style.color;
                element.style.color = '#000'; // Ubah warna teks menjadi hitam
            });

            var canvas = await html2canvas(content, { scale: 2 }); // Mengatur scale untuk meningkatkan resolusi
            var imgData = canvas.toDataURL('image/png');
            var doc = new jsPDF('p', 'mm', 'a4');
            var imgProps = doc.getImageProperties(imgData);
            var pdfWidth = doc.internal.pageSize.getWidth();
            var pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            // Jika tinggi gambar lebih besar dari halaman PDF
            var margin = 10; // margin sekitar
            var pageHeight = doc.internal.pageSize.height;
            var imgHeight = (imgProps.height * pdfWidth) / imgProps.width;

            var heightLeft = imgHeight;
            var position = 0;

            // Menambahkan gambar ke PDF dan mengatur pagenation jika perlu
            while (heightLeft > 0) {
                doc.addImage(imgData, 'PNG', 0, position, pdfWidth, pdfHeight);
                heightLeft -= pageHeight;
                position -= pageHeight;
                if (heightLeft > 0) doc.addPage();
            }

            doc.save('transaksi.pdf');

            // Kembalikan warna asli
            elements.forEach((element, index) => {
                element.style.color = originalColors[index];
            });
        }
    </script>
</body>
</html>
