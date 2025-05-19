<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Daftar Makanan</h2>

<div class="actions">
    <a href="?route=admin/food/create" class="btn-primary">+ Tambah Makanan</a>
</div>

<div class="table-wrapper">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($foods as $food): ?>
                <tr>
                    <td><?= htmlspecialchars($food['name']) ?></td>
                    <td><?= htmlspecialchars($food['description']) ?></td>
                    <td>Rp<?= number_format($food['price'], 0, ',', '.') ?></td>
                    <td>
                        <?php if ($food['image_url']): ?>
                            <img src="/foodhunt/public/food/<?= htmlspecialchars($food['image_url']) ?>" alt="Gambar makanan" class="thumbnail">
                        <?php else: ?>
                            <span class="no-image">Tidak ada gambar</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="?route=admin/food/edit/<?= $food['id'] ?>" class="btn-action edit">Edit</a>
                        <a href="?route=admin/food/delete/<?= $food['id'] ?>" class="btn-action delete" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>
