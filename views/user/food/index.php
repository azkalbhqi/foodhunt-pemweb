<?php include __DIR__ . '/../../layouts/user/header.php'; ?>

<h2>Temukan Makanan Lezat</h2>

<div class="feed">
    <?php foreach ($foods as $food): ?>
        
        <div class="card">
            <img src="/foodhunt/public/food/<?= htmlspecialchars($food['image_url']) ?>" alt="<?= htmlspecialchars($food['name']) ?>" class="card-img">
            <div class="card-body">
                <h3><?= htmlspecialchars($food['name']) ?></h3>
                <p><?= htmlspecialchars($food['description']) ?></p>
                <strong>Rp<?= number_format($food['price'], 0, ',', '.') ?></strong>


                <!-- Rating (tampilan saja) -->
                <p>Rating: <?= number_format($average_ratings[$food['id']] ?? 0, 1) ?> / 5</p>

                <div>
                <a href="?route=user/food/show/<?= $food['id'] ?>">Lihat Makanan</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/../../layouts/user/footer.php'; ?>
