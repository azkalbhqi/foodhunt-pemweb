<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Tambah Makanan</h2>

<div class="container-form-and-lists"> <form id="foodForm" enctype="multipart/form-data" class="modern-form"> <label for="name">Nama Makanan</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" rows="5" required></textarea>

        <label for="price">Harga</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="image">Upload Gambar</label>
        <input type="file" id="image" name="image" required>

        <div class="form-actions"> <button type="submit" class="button">Simpan</button>
            <a class="button-link" href="?route=admin/food">Kembali ke Daftar Makanan</a> </div>
    </form>
</div>

<script>
document.getElementById('foodForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Mencegah form dari submit default

    const form = e.target;
    const formData = new FormData(form);
    const submitButton = form.querySelector('button[type="submit"]');

    // Menonaktifkan tombol dan mengubah teks
    submitButton.disabled = true;
    submitButton.textContent = 'Menyimpan...';

    fetch('?route=admin/food/store', {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            // Jika respons bukan 2xx (misal 400, 500), throw error
            return response.text().then(text => { throw new Error(text) });
        }
        return response.text(); // Atau response.json() jika PHP mengembalikan JSON
    })
    .then(data => {
        alert('Makanan berhasil disimpan!');
        form.reset(); // Mengatur ulang form setelah berhasil
    })
    .catch(error => {
        // Menangani error yang dilempar dari .then() atau fetch itu sendiri
        console.error('Terjadi kesalahan:', error);
        alert('Terjadi kesalahan saat menyimpan makanan: ' + error.message);
    })
    .finally(() => {
        // Mengaktifkan kembali tombol dan mengembalikan teks aslinya
        submitButton.disabled = false;
        submitButton.textContent = 'Simpan';
    });
});
</script>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>