<?php include __DIR__ . '/../../layouts/user/header.php'; ?>
<h2>Daftar Event Kuliner</h2>

<link rel="stylesheet" href="/foodhunt/public/css/events.css">

<div class="event-container">
    <?php if (count($events) > 0): ?>
        <?php foreach ($events as $event): ?>
            <div class="event-card">
                <h3><?= htmlspecialchars($event['title']) ?></h3>
                <p><strong>Tanggal:</strong> <?= htmlspecialchars($event['event_date']) ?></p>
                <p><strong>Lokasi:</strong> <?= htmlspecialchars($event['location']) ?></p>
                <p><strong>Deskripsi:</strong> <?= htmlspecialchars($event['description']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada event kuliner tersedia saat ini.</p>
    <?php endif; ?>
</div>
