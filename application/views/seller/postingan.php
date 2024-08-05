<div class="container">
    <h2><?php echo $title; ?></h2>
    <a href="<?php echo site_url('seller/posting'); ?>" class="btn btn-primary">Posting Akun Baru</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Kode Akun</th>
                <th>ID User</th>
                <th>Status</th>
                <th>Nama Akun</th>
                <th>Gambar</th>
                <th>Username</th>
                <th>Rank</th>
                <th>Jumlah Hero</th>
                <th>Jumlah Skin</th>
                <th>Harga</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($akun as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['kode_akun']); ?></td>
                    <td><?php echo htmlspecialchars($item['id_user']); ?></td>
                    <td><?php echo htmlspecialchars($item['status']); ?></td>
                    <td><?php echo htmlspecialchars($item['nama_akun']); ?></td>
                    <td>
                        <img src="<?php echo base_url('uploads/' . $item['gambar1']); ?>" alt="Gambar Akun" width="50">
                    </td>
                    <td><?php echo htmlspecialchars($item['username']); ?></td>
                    <td><?php echo htmlspecialchars($item['rank']); ?></td>
                    <td><?php echo htmlspecialchars($item['jumlah_hero']); ?></td>
                    <td><?php echo htmlspecialchars($item['jumlah_skin']); ?></td>
                    <td><?php echo htmlspecialchars($item['harga']); ?></td>
                    <td><?php echo htmlspecialchars($item['deskripsi']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
