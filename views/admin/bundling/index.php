<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Daftar Paket Makan Spesial</h2>

<div class="actions">
    <a href="?route=admin/bundling/create" class="btn-primary">+ Tambah Paket Baru</a>
</div>

<div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Isi Paket</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($bundles) > 0): ?>
            <?php foreach ($bundles as $bundle): ?>
            <tr>
                <td><?= htmlspecialchars($bundle['id']) ?></td>
                <td><?= htmlspecialchars($bundle['title']) ?></td>
                <td>Rp <?= number_format($bundle['price'], 0, ',', '.') ?></td>
                <td>
                    <?php if ($bundle['image_url']): ?>
                        <img src="/foodhunt/public/uploads/<?= htmlspecialchars($bundle['image_url']) ?>" alt="Gambar paket" class="thumbnail">
                    <?php else: ?>
                        <span class="no-image">Tidak ada gambar</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php
                    $items = \Bundling::getBundleItems($bundle['id']);
                    echo count($items) > 0
                        ? htmlspecialchars(implode(', ', array_column($items, 'name')))
                        : '<span class="no-items">Belum ada makanan</span>';
                    ?>
                </td>
                <td>
                    <a href="?route=admin/bundling/edit/<?= $bundle['id'] ?>" class="btn-action edit">Edit</a>
                    <a href="?route=admin/bundling/delete/<?= $bundle['id'] ?>" onclick="return confirm('Yakin mau hapus paket ini?')" class="btn-action delete">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" class="empty-data">Belum ada paket makan spesial.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>
