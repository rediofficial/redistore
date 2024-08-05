<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #0d0d0d;
            font-family: 'Press Start 2P', cursive;
            color: #c5c6c7;
        }
        .container {
            margin-top: 50px;
            max-width: 90%;
        }
        h1 {
            margin-bottom: 30px;
            color: #66fcf1;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
            text-align: center;
        }
        .btn-primary, .btn-warning, .btn-danger, .btn-success, .btn-secondary {
            margin-right: 5px;
            font-family: 'Press Start 2P', cursive;
        }
        .table {
            background-color: #1f1f1f;
            border: 1px solid #66fcf1;
        }
        .table th, .table td {
            vertical-align: middle;
            color: #c5c6c7;
        }
        .table thead {
            background-color: #343a40;
            color: #66fcf1;
        }
        .table-responsive {
            border: 1px solid #66fcf1;
            border-radius: 10px;
            padding: 10px;
            background-color: #1b1b1b;
        }
        .btn {
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #45a29e;
        }
        .search-container {
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .container {
                margin-left: 0;
                max-width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center"><?php echo $title; ?></h1>
        <div class="mb-3 text-right">
            <a href="<?php echo base_url('admin/add_user'); ?>" class="btn btn-primary">Add User</a>
        </div>
        <div class="search-container mb-3">
            <input type="text" id="search" class="form-control" placeholder="Cari...">
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="userTable">
                <thead class="thead-dark">
                    <tr>
                        <th>ID User</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Nomor HP</th>
                        <th>Alamat</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id_user']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['full_name']; ?></td>
                            <td><?php echo $user['nomer_hp']; ?></td>
                            <td><?php echo $user['alamat_user']; ?></td>
                            <td>
                                <?php
                                    switch ($user['role_id']) {
                                        case 1:
                                            echo 'Admin';
                                            break;
                                        case 2:
                                            echo 'Seller';
                                            break;
                                        case 3:
                                            echo 'User';
                                            break;
                                        default:
                                            echo 'Unknown';
                                            break;
                                    }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url('admin/edit_user/' . $user['id_user']); ?>" class="btn btn-warning">Edit</a>
                                <a href="<?php echo base_url('admin/delete_user/' . $user['id_user']); ?>" class="btn btn-danger" onclick="return confirmDelete('<?php echo $user['email']; ?>')">Delete</a>
                                <?php if ($user['is_blocked']): ?>
                                    <a href="<?php echo base_url('admin/unblock_user/' . $user['id_user']); ?>" class="btn btn-success">Unblock</a>
                                <?php else: ?>
                                    <a href="<?php echo base_url('admin/block_user/' . $user['id_user']); ?>" class="btn btn-secondary">Block</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function confirmDelete(email) {
            return confirm('Apakah Anda Yakin Ingin Menghapus User Dengan Email: ' + email + '?');
        }

        document.getElementById('search').addEventListener('keyup', function() {
            var searchTerm = this.value.toLowerCase();
            var rows = document.querySelectorAll('#userTable tbody tr');

            rows.forEach(function(row) {
                var text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
