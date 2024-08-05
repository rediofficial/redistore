<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <style>
        body {
            font-family: 'Press Start 2P', cursive;
            background-color: #1e1e1e;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        .content {
            padding: 20px;
        }
        .nav-menu {
            background-color: #343a40;
            padding: 10px;
            text-align: center;
        }
        .nav-menu a {
            color: #ffffff;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .nav-menu a:hover {
            color: #1abc9c;
        }
        .order-history {
            margin-top: 20px;
            width: 100%;
            max-width: 1200px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            background-color: #2c3e50;
        }
        .order-history h3 {
            background-color: #1abc9c;
            margin: 0;
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
        }
        .order-history table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-history th, .order-history td {
            border: 1px solid #34495e;
            padding: 12px;
            text-align: left;
        }
        .order-history th {
            background-color: #34495e;
            color: white;
            font-size: 1rem;
        }
        .order-history td a {
            color: #1abc9c;
            text-decoration: none;
        }
        .order-history td a:hover {
            text-decoration: underline;
        }
        .order-history select, .order-history textarea, .order-history .btn {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-family: 'Press Start 2P', cursive;
            border: none;
            border-radius: 5px;
        }
        .order-history .btn {
            background-color: #1abc9c;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .order-history .btn:hover {
            background-color: #16a085;
        }
        .search-container {
            padding: 20px;
            text-align: center;
        }
        .search-input {
            width: 300px;
            padding: 10px;
            font-family: 'Press Start 2P', cursive;
            border: 1px solid #34495e;
            border-radius: 5px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="container">
            <div class="order-history">
                <h3>Kelola Pesanan Seller</h3>
                <div class="search-container">
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari berdasarkan kode transaksi atau id unik...">
                    <button type="button" class="btn" onclick="searchTable()">Cari</button>
                </div>
                <div class="table-responsive">
                    <table id="orderTable" class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Id Unik</th>
                                <th>Tanggal</th>
                                <th>Akun</th>
                                <th>Kode Akun</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Update Pesanan</th>
                                <th>Aksi</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($transaksi as $pesanan): ?>
                                <tr>
                                    <td><?php echo $pesanan['kode_transaksi']; ?></td>
                                    <td><?php echo $pesanan['kode_trx']; ?></td>
                                    <td><?php echo $pesanan['tanggal_pesanan']; ?></td>
                                    <td>
                                        <form action="<?php echo site_url('admin/detail'); ?>" method="get">
                                            <input type="hidden" name="kode_transaksi" value="<?php echo $pesanan['kode_transaksi']; ?>">
                                            <button type="submit" class="btn btn-info"><?php echo $pesanan['nama_akun']; ?></button>
                                        </form>
                                    </td>
                                    <td><?php echo $pesanan['kode_akun']; ?></td>
                                    <td><?php echo $pesanan['harga']; ?></td>
                                    <td><?php echo $pesanan['status']; ?></td>
                                    <td><?php echo $pesanan['ket']; ?></td>
                                    <td>
                                        <form action="<?php echo base_url('admin/update_status'); ?>" method="post">
                                            <input type="hidden" name="kode_akun" value="<?php echo $pesanan['kode_akun']; ?>">
                                            <input type="hidden" name="kode_transaksi" value="<?php echo $pesanan['kode_transaksi']; ?>">
                                            <select name="status" class="form-control">
                                                <option value="Pending" <?php echo ($pesanan['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                                <option value="Proses" <?php echo ($pesanan['status'] == 'Proses') ? 'selected' : ''; ?>>Proses</option>
                                                <option value="Done" <?php echo ($pesanan['status'] == 'Done') ? 'selected' : ''; ?>>Done</option>
                                            </select>
                                            <textarea name="ket" class="form-control" placeholder="Masukkan keterangan..."><?php echo $pesanan['ket']; ?></textarea>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </form>
                                    </td>
                                    <td> <a href="<?php echo site_url('admin/hapus_transaksi/'. $pesanan['kode_transaksi']); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("orderTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                td = tr[i].getElementsByTagName("td");
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            var table = document.getElementById("orderTable").getElementsByTagName("tbody")[0];
            var rows = Array.from(table.rows);

            rows.sort(function(a, b) {
                var dateA = new Date(a.cells[2].innerText);
                var dateB = new Date(b.cells[2].innerText);
                return dateB - dateA;
            });

            rows.forEach(function(row) {
                table.appendChild(row);
            });
        });
    </script>
</body>
</html>

