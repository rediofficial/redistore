<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1d1f21;
            color: #c5c6c7;
            font-family: 'Press Start 2P', cursive;
        }
        .form-container {
            background: #0b0c10;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 255, 0, 0.2);
        }
        .form-container h1 {
            color: #66fcf1;
        }
        .form-group label {
            color: #66fcf1;
        }
        .form-control {
            background-color: #c5c6c7;
            color: #0b0c10;
            border: 1px solid #45a29e;
        }
        .btn-primary {
            background-color: #45a29e;
            border: none;
        }
        .btn-primary:hover {
            background-color: #66fcf1;
            color: #0b0c10;
        }
        .highlighted {
            background-color: #66fcf1 !important;
            color: #0b0c10 !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-container">
                    <h1 class="mb-4 text-center">Buat Notifikasi</h1>

                    <form action="<?php echo site_url('notification/store'); ?>" method="POST">
                        <div class="form-group">
                            <label for="id_user">Pilih User:</label>
                            <input type="text" id="user_search" class="form-control" placeholder="Cari user...">
                            <select name="id_user" id="id_user" class="form-control mt-2" size="5">
                                <?php foreach($users as $user): ?>
                                    <option value="<?php echo $user->id_user; ?>">
                                    <?php echo $user->id_user . ' - ' . $user->username . ' (' . $user->email . ')'; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" id="send_to_all" name="send_to_all">
                                <label class="form-check-label" for="send_to_all">Kirim ke semua user</label>
                            </div>
                        </div>
                        <input type="hidden" name="send_to_all_hidden" id="send_to_all_hidden" value="0">
                        <div class="form-group">
                            <label for="message">Pesan:</label>
                            <textarea name="message" id="message" class="form-control" rows="4"></textarea>
                        </div>
                        <p></p>
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-primary">Kirim Notifikasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Tambahkan link Bootstrap JS dan jQuery -->
    <script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#user_search').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#id_user option').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('#send_to_all').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#id_user').prop('disabled', true);
                    $('#send_to_all_hidden').val('1');
                } else {
                    $('#id_user').prop('disabled', false);
                    $('#send_to_all_hidden').val('0');
                }
            });

            $('#id_user').on('click', 'option', function() {
                $('#id_user option').removeClass('highlighted');
                $(this).addClass('highlighted');
            });
        });
    </script>
</body>
</html>
