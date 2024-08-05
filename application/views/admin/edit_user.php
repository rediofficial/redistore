<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: white; /* Ganti teks menjadi putih agar terlihat di latar belakang hitam */
            background-color: black; /* Ubah latar belakang menjadi hitam */
        }
        .container {
            background: dimgray;
            color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 0 auto; /* Tambahkan margin agar kontainer berada di tengah */
        }
        h1 {
            color: #f4f4f4;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #4cae4c;
        }
        .validation-errors {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $title; ?></h1>
        <div class="validation-errors"><?php echo validation_errors(); ?></div>
        <?php echo form_open('admin/edit_user/' . $user['id_user']); ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo set_value('username', $user['username']); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" value="<?php echo set_value('email', $user['email']); ?>">
            </div>
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" name="full_name" value="<?php echo set_value('full_name', $user['full_name']); ?>">
            </div>
            <div class="form-group">
                <label for="nomer_hp">Nomor HP</label>
                <input type="text" name="nomer_hp" value="<?php echo set_value('nomer_hp', $user['nomer_hp']); ?>">
            </div>
            <div class="form-group">
                <label for="alamat_user">Alamat</label>
                <textarea name="alamat_user"><?php echo set_value('alamat_user', $user['alamat_user']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="alamat_user">Role Id</label>
                <textarea name="role_id"><?php echo set_value('role_id', $user['role_id']); ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Update</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</body>
</html>
