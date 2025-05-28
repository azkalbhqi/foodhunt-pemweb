<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Buat Event Kuliner Baru</h2>

<div class="container-form-and-lists"> <form id="eventForm" method="POST" action="?route=admin/event/store" class="modern-form">
        <label for="title">Nama Event</label>
        <input type="text" id="title" name="title" required>

        <label for="event_date">Tanggal Acara</label>
        <input type="date" id="event_date" name="event_date" required>

        <label for="location">Lokasi</label>
        <input type="text" id="location" name="location" required>

        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" rows="5" required></textarea>

        <div class="form-actions">
            <button type="submit" class="button">Simpan Event</button>
            <a class="button-link" href="?route=admin/event">Kembali ke Daftar Event</a>
        </div>
    </form>
    <div id="eventResponse" class="form-response-message"></div> </div>

<script>
document.getElementById('eventForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Mencegah form dari submit default

    const form = e.target;
    const formData = new FormData(form);
    const responseDiv = document.getElementById('eventResponse');
    const submitButton = form.querySelector('button[type="submit"]');

    // Reset pesan respons dan styling
    responseDiv.textContent = '';
    responseDiv.className = 'form-response-message'; // Reset class

    // Menonaktifkan tombol dan mengubah teks
    submitButton.disabled = true;
    submitButton.textContent = 'Menyimpan...';

    fetch(form.action, {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.text(); // Atau response.json() jika PHP mengembalikan JSON
    })
    .then(data => {
        responseDiv.classList.add('success'); // Tambah class success
        responseDiv.textContent = 'Event berhasil disimpan!';
        form.reset(); // Mengatur ulang form setelah berhasil
    })
    .catch(error => {
        responseDiv.classList.add('error'); // Tambah class error
        responseDiv.textContent = 'Terjadi kesalahan saat menyimpan event: ' + error.message;
        console.error('Terjadi kesalahan:', error);
    })
    .finally(() => {
        // Mengaktifkan kembali tombol dan mengembalikan teks aslinya
        submitButton.disabled = false;
        submitButton.textContent = 'Simpan Event';
    });
});
</script>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>