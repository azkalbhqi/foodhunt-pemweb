<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>
<h2>Edit Paket Makan Spesial</h2>
<form method="POST" action="?route=admin/bundling/update/<?= $bundle['id'] ?>" enctype="multipart/form-data">
    <label>Nama Paket:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($bundle['title']) ?>" required><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="description" rows="4" required><?= htmlspecialchars($bundle['description']) ?></textarea><br><br>

    <label>Harga (Rp):</label><br>
    <input type="number" name="price" min="0" step="100" value="<?= $bundle['price'] ?>" required><br><br>

    <label>Gambar Paket:</label><br>
    <?php if ($bundle['image_url']): ?>
        <img src="<?= htmlspecialchars($bundle['image_url']) ?>" alt="Gambar paket" width="150"><br>
    <?php endif; ?>
    <input type="file" name="image" accept="image/*"><br>
    <small>Kosongkan jika tidak ingin mengubah gambar.</small><br><br>

    <label>Pilih Makanan dalam Paket:</label><br>
    <?php
    $selectedIds = [];
    foreach ($bundleItems as $item) {
        $selectedIds[] = $item['id'];
    }
    ?>
    <?php if (count($foods) > 0): ?>
        <?php foreach ($foods as $food): ?>
            <input type="checkbox" name="food_ids[]" value="<?= $food['id'] ?>"
                <?= in_array($food['id'], array_column($bundleItems, 'id')) ? 'checked' : '' ?>>
            <?= htmlspecialchars($food['name']) ?><br>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada makanan yang tersedia.</p>
    <?php endif; ?>
    <br>
    <button type="submit">Update Paket</button>
</form>
<a href="?route=admin/bundling">Kembali ke daftar paket</a>
