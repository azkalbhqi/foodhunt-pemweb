<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>
<h2>Tambah Makanan</h2>

<form id="foodForm" enctype="multipart/form-data">
    <label>Nama Makanan</label><br>
    <input type="text" name="name" required><br><br>

    <label>Deskripsi</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Harga</label><br>
    <input type="number" name="price" step="0.01" required><br><br>

    <label>Upload Gambar</label><br>
    <input type="file" name="image" required><br><br>

    <button type="submit">Simpan</button>
</form>

<script>
document.getElementById('foodForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const btn = form.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.textContent = 'Menyimpan...';

    fetch('?route=admin/food/store', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())  // Sesuaikan jika respon JSON
    .then(data => {
        alert('Makanan berhasil disimpan!');
        form.reset();
    })
    .catch(err => {
        alert('Terjadi kesalahan saat menyimpan makanan.');
        console.error(err);
    })
    .finally(() => {
        btn.disabled = false;
        btn.textContent = 'Simpan';
    });
});
</script>
<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>
