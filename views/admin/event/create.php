<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Buat Event Kuliner Baru</h2>

<form id="eventForm" method="POST" action="?route=admin/event/store">
    <label for="title">Nama Event:</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="event_date">Tanggal Acara:</label><br>
    <input type="date" id="event_date" name="event_date" required><br><br>

    <label for="location">Lokasi:</label><br>
    <input type="text" id="location" name="location" required><br><br>

    <label for="description">Deskripsi:</label><br>
    <textarea id="description" name="description" rows="5" required></textarea><br><br>

    <button type="submit">Simpan Event</button>
</form>
<div id="eventResponse" style="margin-top:10px;"></div>
<script>
document.getElementById('eventForm').addEventListener('submit', function(e) {
    e.preventDefault(); // cegah form submit biasa

    const form = e.target;
    const formData = new FormData(form);
    const responseDiv = document.getElementById('eventResponse');

    fetch(form.action, {
        method: 'POST',
        body: formData,
    })
    .then(res => res.text())  // kalau server balikin plain text, kalau JSON bisa diganti .json()
    .then(data => {
        responseDiv.style.color = 'green';
        responseDiv.textContent = 'Event berhasil disimpan!';
        form.reset();
    })
    .catch(err => {
        responseDiv.style.color = 'red';
        responseDiv.textContent = 'Terjadi kesalahan saat menyimpan event.';
        console.error(err);
    });
});
</script>
