<?php include __DIR__ . '/../../layouts/user/header.php'; ?>

<h2>Daftar Event Kuliner</h2>

<link rel="stylesheet" href="/foodhunt/public/css/events.css">

<div class="event-grid"> <?php if (count($events) > 0): ?>
        <?php foreach ($events as $event): ?>
            <div class="event-card">
                <div class="event-card-header">
                    <h3><?= htmlspecialchars($event['title']) ?></h3>
                </div>
                <div class="event-card-body">
                    <p><strong>Tanggal:</strong> <?= htmlspecialchars($event['event_date']) ?></p>
                    <p><strong>Lokasi:</strong> <?= htmlspecialchars($event['location']) ?></p>
                    <p class="event-description"><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($event['description'])) ?></p>
                </div>
                </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-events-message">Belum ada event kuliner tersedia saat ini.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../layouts/user/footer.php'; ?>