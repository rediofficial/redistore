<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>

        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #1e1e1e;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            margin: 50px auto;
            max-width: 800px;
            padding: 20px;
            background: #2c2c2c;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.3);
            margin-left: 280px;

        }
        .container h1 {
            text-align: center;
            color: #0f0;
            margin-bottom: 20px;
        }
        .form-group label {
            color: #0f0;
        }
        .form-control {
            background-color: #333;
            border: 1px solid #555;
            color: #fff;
            border-radius: 5px;
            padding: 10px;
        }
        .form-control:focus {
            border-color: #0f0;
            background-color: #444;
            outline: none;
        }
        .btn-primary {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #0f0;
            color: #000;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0c0;
        }
        .alert {
            margin-top: 20px;
            background-color: #d9534f;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #5bc0de;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Silahkan Kasih Penilaian Kamu!</h1>
        <?php if (isset($error)): ?>
            <div class="alert"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php echo validation_errors('<div class="alert">', '</div>'); ?>
        <?php echo form_open('review/buat'); ?>
            <div class="form-group">
                <label for="rating">Rating</label>
                <select name="rating" class="form-control">
                    <option value="">Select Rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" class="form-control" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        <?php echo form_close(); ?>
    </div>
    <script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
