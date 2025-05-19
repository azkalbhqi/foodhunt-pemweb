<?php include __DIR__ . '/../../layouts/user/header.php'; ?>

<h2>Forum Chat (User)</h2>

<div class="chat-container">
    <div class="chat-box">
        <?php foreach ($messages as $msg): ?>
            <div class="chat-message <?= $msg['user_name'] == 'User' ? 'user' : '' ?>">
                <strong><?= htmlspecialchars($msg['user_name']) ?></strong>
                <p><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
                <small><?= $msg['created_at'] ?></small>
            </div>
        <?php endforeach; ?>
    </div>

    <form method="POST" action="?route=forum/store" class="chat-form">
        <label>Nama:</label>
        <input type="text" name="user_name" value="<?= htmlspecialchars($_SESSION['user']) ?>" readonly>

        <label>Pesan:</label>
        <textarea name="message" rows="3" required></textarea>

        <button type="submit">Kirim</button>
    </form>
</div>
