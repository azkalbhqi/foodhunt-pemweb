<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Forum Chat (Admin)</h2>

<div id="chat-container" style="border:1px solid #ccc; padding:10px; height:300px; overflow-y:auto;">
    <?php foreach ($messages as $msg): ?>
        <div style="margin-bottom:10px;">
            <strong><?= htmlspecialchars($msg['user_name']) ?></strong> <small>(<?= $msg['created_at'] ?>)</small><br>
            <p><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
            <a href="?route=forum/delete/<?= $msg['id'] ?>" onclick="return confirm('Hapus pesan ini?')" style="color:red; font-size:smaller;">Hapus</a>
        </div>
        <hr>
    <?php endforeach; ?>
</div>

<form method="POST" action="?route=forum/store" style="margin-top:10px;">
    <label>Nama:</label><br>
    <input type="text" name="user_name" value="Admin" readonly><br><br>

    <label>Pesan:</label><br>
    <textarea name="message" rows="3" required></textarea><br><br>

    <button type="submit">Kirim</button>
</form>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('?route=forum/store', {
        method: 'POST',
        body: formData
    })
    .then(res => {
        if (!res.ok) throw new Error('Gagal kirim pesan');
        return res.text();
    })
    .then(() => {
        this.message.value = '';
        // Ambil seluruh halaman, lalu update chat container dengan konten chat dari halaman baru
        fetch(window.location.href)
        .then(res => res.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newChat = doc.getElementById('chat-container');
            document.getElementById('chat-container').innerHTML = newChat.innerHTML;
        });
    })
    .catch(err => alert(err.message));
});
 // load pesan saat pertama kali halaman dibuka
</script>


<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>
