<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>
<h2>Tambah Paket Makan Spesial Baru</h2>
<form method="POST" action="?route=admin/bundling/store" enctype="multipart/form-data">
    <label>Nama Paket:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="description" rows="4" required></textarea><br><br>

    <label>Harga (Rp):</label><br>
    <input type="number" name="price" min="0" step="100" required><br><br>

    <label>Gambar Paket:</label><br>
    <input type="file" name="image" accept="image/*" required><br><br>

    <label>Pilih Makanan dalam Paket:</label><br>
    <?php if (count($foods) > 0): ?>
        <?php foreach ($foods as $food): ?>
            <input type="checkbox" name="food_ids[]" value="<?= $food['id'] ?>">
            <?= htmlspecialchars($food['name']) ?><br>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada makanan yang tersedia.</p>
    <?php endif; ?>
    <br>
    <button type="submit">Simpan Paket</button>
</form>
<a href="?route=admin/bundling">Kembali ke daftar paket</a>
