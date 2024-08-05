<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1b1b1b;
            color: #f5f5f5;
            font-family: 'Press Start 2P', cursive;
        }
        .container {
            margin-top: 50px;
            max-width: 80%;
            background: #2b2b2b;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            margin-left: 250px;
        }
        h1 {
            text-align: center;
            color: #ff7e00;
            text-shadow: 2px 2px 4px #000;
            margin-bottom: 20px;
        }
        .review-item {
            background: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
            position: relative;
        }
        .review-rating {
            font-size: 24px;
            color: #ffcc00;
        }
        .review-username {
            font-weight: bold;
            color: #ff7e00;
            margin-bottom: 5px;
        }
        .review-date {
            color: #888;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .review-comment {
            font-size: 16px;
            color: #f5f5f5;
        }
        .reply-item {
            background: #444;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
        }
        .delete-review {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #ff0000;
            cursor: pointer;
            font-size: 20px;
            transition: transform 0.3s ease;
        }
        .delete-review:hover {
            transform: scale(1.2);
        }
        .alert-success, .alert-danger {
            font-family: 'Press Start 2P', cursive;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $title; ?></h1>
        <div id="message">
            <?php if ($this->session->flashdata('message')): ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if (count($review) > 0): ?>
            <?php foreach ($review as $rev): ?>
                <div class="review-item" id="review-<?php echo $rev['id_review']; ?>">
                    <!-- Form untuk hapus review -->
                    <form action="<?php echo site_url('admin/delete_review'); ?>" method="post" style="position: absolute; top: 20px; right: 20px;">
                        <input type="hidden" name="id_review" value="<?php echo $rev['id_review']; ?>">
                        <button type="submit" class="delete-review" onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?')">&#10060;</button>
                    </form>
                    <div class="review-rating">
                        <?php for ($i = 0; $i < $rev['rating']; $i++): ?>
                            &#9733;
                        <?php endfor; ?>
                        <?php for ($i = $rev['rating']; $i < 5; $i++): ?>
                            <span class="star-empty">&#9734;</span>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
