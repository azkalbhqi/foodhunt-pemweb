<?php include __DIR__ . '/../../layouts/user/header.php'; ?>


<a href="?route=user/food">Kembali</a>
<div class="feed showfood" >
    <br>
    <h2><?= htmlspecialchars($food['name']) ?></h2>
    <img src="/foodhunt/public/food/<?= htmlspecialchars($food['image_url']) ?>" class="card-img" alt="<?= htmlspecialchars($food['name']) ?>">
    <div class="card-body">
        <p><?= htmlspecialchars($food['description']) ?></p>
        <strong>Rp<?= number_format($food['price'], 0, ',', '.') ?></strong>

        <!-- Wishlist -->
        <form action="?route=user/food/wishlist" method="POST" style="display:inline;">
            <input type="hidden" name="food_id" value="<?= $food['id'] ?>">
            <button type="submit" style="background:none; border:none; font-size:20px;">
                <?= $is_wishlisted ? '❤️' : '🤍' ?> Wishlist
            </button>
        </form>

        <!-- Rating -->
        <p>Rating: <?= number_format($average_rating, 1) ?> / 5</p>

        <!-- Form Rating -->
        <form method="POST" action="?route=user/food/rate" style="margin-top:10px;">
            <input type="hidden" name="food_id" value="<?= $food['id'] ?>">
            <label for="rating">Beri Rating:</label>
            <select name="rating" id="rating" onchange="this.form.submit()">
                <option value="">Pilih...</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?> ⭐</option>
                <?php endfor; ?>
            </select>
        </form>

        <!-- Komentar -->
        <div class="reviews" style="margin-top:20px;">
            <h4>Komentar:</h4>
            <?php if (!empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div style="margin-top: 5px; font-size: small;">
                        <strong><?= htmlspecialchars($review['username']) ?>:</strong> <?= htmlspecialchars($review['comment']) ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="font-size: small;">Belum ada komentar.</p>
            <?php endif; ?>
        </div>

        <!-- Form Komentar -->
        <form method="POST" action="?route=user/food/comment" style="margin-top:10px;">
            <input type="hidden" name="food_id" value="<?= $food['id'] ?>">
              <textarea name="comment" rows="3" required></textarea><br>
            <button type="submit">Kirim Komentar</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/user/footer.php'; ?>
