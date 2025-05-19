<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Daftar Promo</h2>

<div class="actions">
    <a href="?route=admin/promo/create" class="btn-primary">+ Tambah Promo Baru</a>
</div>

<div class="table-wrapper">
    <table class="styled-table">
        <thead>
            <tr>
                <th>Nama Promo</th>
                <th>Kategori</th>
                <th>Restoran</th>
                <th>Periode</th>
                <th>Kode Voucher</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promos as $promo): ?>
            <tr>
                <td><?= htmlspecialchars($promo['title']) ?></td>
                <td><?= htmlspecialchars($promo['category']) ?></td>
                <td><?= htmlspecialchars($promo['restaurant_name']) ?></td>
                <td><?= htmlspecialchars($promo['start_date']) ?> s/d <?= htmlspecialchars($promo['end_date']) ?></td>
                <td><?= htmlspecialchars($promo['voucher_code'] ?: '-') ?></td>
                <td>
                    <a href="?route=admin/promo/edit/<?= $promo['id'] ?>" class="btn-action edit">Edit</a>
                    <a href="?route=admin/promo/delete/<?= $promo['id'] ?>" class="btn-action delete" onclick="return confirm('Hapus promo ini?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>
