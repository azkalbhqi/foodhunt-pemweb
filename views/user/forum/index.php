<?php include __DIR__ . '/../../layouts/user/header.php'; ?>

<h2>Forum Chat (User)</h2>

<div class="chat-container">
    <div id="chat-box" class="chat-box">
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $msg): ?>
                <?php
                // Logika untuk menentukan apakah pesan ini dari admin
                // Ini masih dijalankan di PHP saat halaman dimuat
                $is_admin_message = (strtolower($msg['user_name']) == 'admin');
                $message_class = $is_admin_message ? 'admin-message' : 'user-message';
                ?>
                <div class="chat-message <?= $message_class ?>">
                    <strong><?= htmlspecialchars($msg['user_name']) ?></strong>
                    <p><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
                    <small><?= $msg['created_at'] ?></small>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p id="no-messages-yet" style="text-align: center; color: #777;">Belum ada pesan di forum ini.</p>
        <?php endif; ?>
    </div>

    <form id="chatForm" method="POST" action="?route=forum/store" class="chat-form">
        <label>Nama:</label>
        <input type="text" name="user_name" value="<?= htmlspecialchars($_SESSION['user'] ?? 'Guest') ?>" readonly>

        <label>Pesan:</label>
        <textarea name="message" rows="3" required></textarea>

        <button type="submit">Kirim</button>
    </form>
</div>

<?php include __DIR__ . '/../../layouts/user/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatBox = document.getElementById('chat-box');
    const chatForm = document.getElementById('chatForm');
    const messageInput = chatForm.querySelector('textarea[name="message"]');

    // Fungsi untuk menggulir chatbox ke bawah
    function scrollToBottom() {
        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    }

    // Scroll ke bawah saat halaman dimuat
    scrollToBottom();

    // Event listener untuk pengiriman form
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault(); // Mencegah reload halaman

        const formData = new FormData(this); // Ambil data dari form
        const messageText = messageInput.value.trim();

        if (!messageText) {
            return;
        }

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                // Jika server mengembalikan status 200 OK (sukses)
                location.reload(); // Paksa reload halaman untuk melihat pesan baru
            } else {
                // Jika ada error (misal 401, 500, dll)
                alert('Gagal mengirim pesan. Silakan coba lagi.');
            }
        } catch (error) {
            console.error('AJAX Error:', error);
            alert('Terjadi kesalahan jaringan atau server.');
        }
    });
});
</script>