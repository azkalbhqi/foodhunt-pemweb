<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>
<h2>Edit Makanan</h2>

<form method="POST" action="?route=admin/food/update/<?= $food['id'] ?>">
    <label>Nama Makanan</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($food['name']) ?>" required><br><br>

    <label>Deskripsi</label><br>
    <textarea name="description" required><?= htmlspecialchars($food['description']) ?></textarea><br><br>

    <label>Harga</label><br>
    <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($food['price']) ?>" required><br><br>

    <label>URL Gambar</label><br>
    <input type="file" name="image_url" value="<?= htmlspecialchars($food['image_url']) ?>"><br><br>

    <button type="submit">Update</button>
    <a href="?route=admin/food">Kembali</a>
</form>


