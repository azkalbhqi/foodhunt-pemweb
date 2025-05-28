<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Tambah Paket Makan Spesial Baru</h2>

<div class="container-form-and-lists"> <form method="POST" action="?route=admin/bundling/store" enctype="multipart/form-data" class="modern-form">
        <label for="title">Nama Paket</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" rows="5" required></textarea>

        <label for="price">Harga (Rp)</label>
        <input type="number" id="price" name="price" min="0" step="100" required>

        <label for="image">Gambar Paket</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <div class="food-selection-section"> <label>Pilih Makanan dalam Paket:</label>
            <?php if (count($foods) > 0): ?>
                <div class="checkbox-group"> <?php foreach ($foods as $food): ?>
                        <div class="checkbox-item">
                            <input type="checkbox" id="food_<?= $food['id'] ?>" name="food_ids[]" value="<?= $food['id'] ?>">
                            <label for="food_<?= $food['id'] ?>"><?= htmlspecialchars($food['name']) ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="no-items">Belum ada makanan yang tersedia. Silakan <a href="?route=admin/food/create">tambah makanan baru</a> terlebih dahulu.</p>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="button">Simpan Paket</button>
            <a class="button-link" href="?route=admin/bundling">Kembali ke Daftar Paket</a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>