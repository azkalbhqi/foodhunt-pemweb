<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>
<h2>Edit Promo</h2>

<form id="promoForm" method="POST" action="?route=admin/promo/update/<?= $promo['id'] ?>">
    <label>Nama Promo</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($promo['title']) ?>" required><br><br>

    <label>Deskripsi Promo</label><br>
    <textarea name="description" rows="4" required><?= htmlspecialchars($promo['description']) ?></textarea><br><br>

    <label>Kategori Promo</label><br>
    <select name="category" required>
        <option value="">--Pilih Kategori--</option>
        <option value="diskon" <?= $promo['category'] === 'diskon' ? 'selected' : '' ?>>Diskon</option>
        <option value="bundling" <?= $promo['category'] === 'bundling' ? 'selected' : '' ?>>Bundling</option>
        <option value="voucher" <?= $promo['category'] === 'voucher' ? 'selected' : '' ?>>Voucher</option>
        <!-- Tambah kategori lain jika perlu -->
    </select><br><br>

    <label>Restoran Terkait</label><br>
    <select name="restaurant_id" required>
        <option value="">--Pilih Restoran--</option>
        <?php foreach ($restaurants as $restaurant): ?>
            <option value="<?= $restaurant['id'] ?>" <?= $restaurant['id'] == $promo['restaurant_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($restaurant['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Tanggal Mulai</label><br>
    <input type="date" name="start_date" value="<?= $promo['start_date'] ?>" required><br><br>

    <label>Tanggal Berakhir</label><br>
    <input type="date" name="end_date" value="<?= $promo['end_date'] ?>" required><br><br>

    <label>Kode Voucher (Opsional)</label><br>
    <input type="text" name="voucher_code" value="<?= htmlspecialchars($promo['voucher_code']) ?>"><br><br>

    <button type="submit">Update Promo</button>
</form>

<div id="responseMessage" style="margin-top:10px;"></div>

<script>
document.getElementById('promoForm').addEventListener('submit', function(e) {
    e.preventDefault(); // cegah form submit biasa

    const form = e.target;
    const formData = new FormData(form);
    const responseMessage = document.getElementById('responseMessage');

    fetch(form.action, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        responseMessage.style.color = 'green';
        responseMessage.textContent = 'Promo berhasil diperbarui!';
    })
    .catch(error => {
        responseMessage.style.color = 'red';
        responseMessage.textContent = 'Terjadi kesalahan saat memperbarui promo.';
        console.error('Error:', error);
    });
});
</script>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>
