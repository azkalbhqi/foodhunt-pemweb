<?php include __DIR__ . '/../../layouts/user/header.php'; ?>
<h2>Daftar Paket Makan Spesial</h2>

<link rel="stylesheet" href="/foodhunt/public/css/bundles.css">

<div class="bundle-container">
    <?php if (count($bundles) > 0): ?>
        <?php foreach ($bundles as $bundle): ?>
            <div class="bundle-card">
                <div class="bundle-image">
                    <?php if ($bundle['image_url']): ?>
                        <img src="public/uploads/<?= htmlspecialchars($bundle['image_url']) ?>" alt="Gambar paket">
                    <?php else: ?>
                        <div class="no-image">Tidak ada gambar</div>
                    <?php endif; ?>
                </div>
                <div class="bundle-content">
                    <h3><?= htmlspecialchars($bundle['title']) ?></h3>
                    <p class="price">Rp <?= number_format($bundle['price'], 0, ',', '.') ?></p>
                    <p class="items">
                        <strong>Isi Paket:</strong>
                        <?php
                        $items = \Bundling::getBundleItems($bundle['id']);
                        if (count($items) > 0) {
                            $names = array_column($items, 'name');
                            echo htmlspecialchars(implode(', ', $names));
                        } else {
                            echo 'Belum ada makanan';
                        }
                        ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada paket makan spesial.</p>
    <?php endif; ?>
</div>
