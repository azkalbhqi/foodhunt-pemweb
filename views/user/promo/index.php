<?php include __DIR__ . '/../../layouts/user/header.php'; ?>

<h2>Daftar Promo</h2>

<link rel="stylesheet" href="/foodhunt/public/css/promos.css">

<div class="promo-container">
    <?php if (count($promos) > 0): ?>
        <?php foreach ($promos as $promo): ?>
            <div class="promo-card">
                <h3><?= htmlspecialchars($promo['title']) ?></h3>
                <p><strong>Kategori:</strong> <?= htmlspecialchars($promo['category']) ?></p>
                <p><strong>Restoran:</strong> <?= htmlspecialchars($promo['restaurant_name']) ?></p>
                <p><strong>Periode:</strong> <?= htmlspecialchars($promo['start_date']) ?> s/d <?= htmlspecialchars($promo['end_date']) ?></p>
                <p><strong>Kode Voucher:</strong> <?= htmlspecialchars($promo['voucher_code'] ?: '-') ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada promo tersedia saat ini.</p>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>
