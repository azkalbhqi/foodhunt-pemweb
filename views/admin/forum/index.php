<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Forum Chat (Admin)</h2>

<div id="chat-container" style="border:1px solid #ccc; padding:10px; height:300px; overflow-y:auto;">
    <?php foreach ($messages as $msg): ?>
        <?php
        // Tentukan apakah pesan ini dari admin atau bukan
        $is_admin_message = (strtolower($msg['user_name']) === 'admin');
        $message_alignment = $is_admin_message ? 'text-align: right;' : 'text-align: left;';
        ?>
        <div id="message-<?= $msg['id'] ?>" style="margin-bottom:10px; <?= $message_alignment ?>">
            <strong><?= htmlspecialchars($msg['user_name']) ?></strong> <small>(<?= $msg['created_at'] ?>)</small><br>
            <p><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
            <button class="delete-message-btn" data-id="<?= $msg['id'] ?>" style="color:red; font-size:smaller; background:none; border:none; cursor:pointer;">Hapus</button>
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

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>

<script>
// Skrip kirim pesan (tetap sama)
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('?route=forum/store', { method: 'POST', body: formData })
    .then(res => {
        if (!res.ok) throw new Error('Gagal kirim pesan');
        return res.text();
    })
    .then(() => {
        this.message.value = '';
        location.reload(); // Memuat ulang halaman untuk memperbarui chat
    })
    .catch(err => alert(err.message));
});

// Skrip hapus pesan (tetap sama)
document.querySelectorAll('.delete-message-btn').forEach(button => {
    button.addEventListener('click', function() {
        const messageId = this.dataset.id;
        const messageElement = document.getElementById('message-' + messageId);

        if (confirm('Yakin ingin menghapus pesan ini?')) {
            fetch(`?route=forum/delete/${messageId}`, {
                method: 'POST'
            })
            .then(response => {
                if (response.ok) {
                    if (messageElement) {
                        messageElement.remove();
                        const hrElement = messageElement.nextElementSibling;
                        if (hrElement && hrElement.tagName === 'HR') {
                            hrElement.remove();
                        }
                    }
                } else {
                    return response.json().then(errorData => {
                        alert('Gagal menghapus: ' + (errorData.message || 'Terjadi kesalahan.'));
                    });
                }
            })
            .catch(error => {
                console.error('Error saat menghapus:', error);
                alert('Terjadi kesalahan jaringan atau server.');
            });
        }
    });
});
</script>