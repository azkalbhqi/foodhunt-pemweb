<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Edit Makanan</h2>

<div class="container-form-and-lists"> <form method="POST" action="?route=admin/food/update/<?= $food['id'] ?>" enctype="multipart/form-data" class="modern-form"> <label for="name">Nama Makanan</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($food['name']) ?>" required>

        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" rows="5" required><?= htmlspecialchars($food['description']) ?></textarea>

        <label for="price">Harga</label>
        <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($food['price']) ?>" required>

        <label for="image_url">Gambar Baru (Opsional)</label>
        <input type="file" id="image_url" name="image_url">

        <div class="form-actions"> <button type="submit" class="button">Update</button>
            <a class="button-link" href="?route=admin/food">Kembali</a>
        </div>
    </form>

    <hr class="divider"> <h3>Komentar / Review</h3>
    <div class="list-container"> <?php if (!empty($reviews)): ?>
            <ul class="styled-list">
                <?php foreach ($reviews as $review): ?>
                    <li>
                        <strong><?= htmlspecialchars($review['username']) ?>:</strong>
                        <span><?= htmlspecialchars($review['comment']) ?></span>
                        <form class="inline-form" action="?route=admin/review/delete" method="POST">
                            <input type="hidden" name="review_id" value="<?= $review['id'] ?>">
                            <input type="hidden" name="redirect_food_id" value="<?= $food['id'] ?>">
                            <button id="delete-link" type="submit" onclick="return confirm('Hapus komentar ini?')">Hapus</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="no-items"><em>Belum ada komentar.</em></p>
        <?php endif; ?>
    </div>

    <hr class="divider">

    <h3>User yang Menambahkan ke Wishlist</h3>
    <div class="list-container"> <?php if (!empty($wishlists)): ?>
            <ul class="styled-list">
                <?php foreach ($wishlists as $wishlist): ?>
                    <li>
                        <span>User ID: **<?= $wishlist['user_id'] ?>**</span>
                        <form class="inline-form" action="?route=admin/wishlist/delete" method="POST">
                            <input type="hidden" name="wishlist_id" value="<?= $wishlist['id'] ?>">
                            <input type="hidden" name="redirect_food_id" value="<?= $food['id'] ?>">
                            <button class="delete-wishlist-button" type="submit" onclick="return confirm('Hapus dari wishlist?')">Hapus</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="no-items"><em>Tidak ada user yang menambahkan ini ke wishlist.</em></p>
        <?php endif; ?>
    </div>
</div> <?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>