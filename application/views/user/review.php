<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>"> -->
    <style>
        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #1e1e1e;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 50px auto;
            max-width: 800px;
            padding: 20px;
            background: #2c2c2c;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.5);
            margin-left: 280px;
        }
        h1 {
            text-align: center;
            color: #0f0;
            margin-bottom: 20px;
        }
        .review-item {
            background: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.3);
            margin-bottom: 20px;
        }
        .review-rating {
            font-size: 24px;
            color: #ffcc00;
        }
        .review-username {
            font-weight: bold;
            color: #0f0;
            margin-bottom: 5px;
        }
        .review-date {
            color: #888;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .review-comment {
            font-size: 16px;
            color: #e0e0e0;
        }
        .reply-item {
            background: #444;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            box-shadow: 0 0 5px rgba(0, 255, 0, 0.2);
        }
        .reply-item div {
            color: #0f0;
        }
        /* Tambahkan CSS untuk mengubah latar belakang dropdown menjadi abu-abu */
        .dropdown-menu {
            background-color: #343a40; /* Warna abu-abu */
        }
        .dropdown-item {
            color: #fff; /* Warna teks putih */
        }
        .dropdown-item:hover {
            background-color: #5a6268; /* Warna abu-abu lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $title; ?></h1>
        <?php if (count($review) > 0): ?>
            <?php foreach ($review as $rev): ?>
                <div class="review-item">
                    <div class="review-rating">
                        <?php for ($i = 0; $i < $rev['rating']; $i++): ?>
                            &#9733;
                        <?php endfor; ?>
                        <?php for ($i = $rev['rating']; $i < 5; $i++): ?>
                            &#9734;
                        <?php endfor; ?>
                    </div>
                    <div class="review-username"><?php echo $rev['username']; ?></div>
                    <div class="review-date">
                        <?php
                            date_default_timezone_set('Asia/Jakarta');
                            echo date('d F Y', strtotime($rev['tanggal_rating']));
                        ?>
                    </div>         
                    <div class="review-comment"><?php echo nl2br(htmlspecialchars($rev['comment'])); ?></div>
                    
                    <?php if (!empty($rev['reply'])): ?>
                        <div class="reply-item">
                            <div><strong>Seller Reply:</strong></div>
                            <div><?php echo nl2br(htmlspecialchars($rev['reply'])); ?></div>
                            <div class="review-date">
                                <?php echo date('d F Y', strtotime($rev['tanggal_reply'])); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No reviews yet.</p>
        <?php endif; ?>
    </div>
    <script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
