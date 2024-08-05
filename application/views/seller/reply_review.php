<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet"> -->
    <style>
        body {
            background-color: #1b1b1b;
            font-family: 'Press Start 2P', cursive;
            color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
            margin-left: 250px;
            max-width: 80%;
            background: #2b2b2b;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
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
        .reply-form {
            margin-top: 20px;
        }
        .form-control {
            background-color: #555;
            border: none;
            border-radius: 5px;
            color: #fff;
        }
        .form-control:focus {
            background-color: #666;
            border-color: #ff7e00;
            box-shadow: none;
        }
        .btn-primary {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 5px;
            background: #ff7e00;
            color: #fff;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn-primary:hover {
            background: #e66b00;
        }
        .alert-success {
            background-color: #28a745;
            border: none;
            color: #fff;
        }
        .star-empty {
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $title; ?></h1>
        <?php if (!empty($review)): ?>
            <?php foreach ($review as $rev): ?>
                <div class="review-item" data-review-id="<?php echo $rev['id_review']; ?>">
                    <!-- Review Content -->
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

                    <!-- Existing Replies -->
                    <?php if ($rev['reply']): ?>
                        <div class="reply-item">
                            <div><strong>Seller Reply:</strong></div>
                            <div><?php echo nl2br(htmlspecialchars($rev['reply'])); ?></div>
                            <div class="review-date">
                                <?php
                                    echo date('d F Y', strtotime($rev['tanggal_reply']));
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Reply Form -->
                    <div class="reply-form">
                        <form class="reply-form" action="<?php echo site_url('reply_review/reply'); ?>" method="POST">
                            <input type="hidden" name="id_review" value="<?php echo $rev['id_review']; ?>">
                            <div class="form-group">
                                <textarea name="reply" class="form-control" rows="3" placeholder="Tulis balasan Anda di sini..."></textarea>
                            </div>
                            <p></p>
                            <button type="submit" class="btn btn-primary">Reply</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No reviews yet.</p>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            $(document).on('submit', '.reply-form', function(e) {
                e.preventDefault(); // Prevent default form submission

                var form = $(this);
                var formData = form.serialize(); // Get form data

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        var data = JSON.parse(response); // Parse JSON response
                        if (data.success) {
                            // Add reply to the review item on the page
                            var replyHtml = '<div class="reply-item">' +
                                            '<div><strong>Seller Reply:</strong></div>' +
                                            '<div>' + data.reply + '</div>' +
                                            '<div class="review-date">' +
                                            data.tanggal_reply +
                                            '</div>' +
                                            '</div>';

                            form.closest('.review-item').append(replyHtml); // Add reply to review item
                            form.find('textarea').val(''); // Clear textarea after submission
                        } else {
                            alert('Failed to add reply: ' + data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error occurred while adding reply: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
