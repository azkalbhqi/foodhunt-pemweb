<?php include __DIR__ . '/../../layouts/user/header.php'; ?>

<a href="?route=user/food">Kembali</a>
<div class="feed showfood" >
    <br>
    <h2><?= htmlspecialchars($food['name']) ?></h2>
    <img src="public/food/<?= htmlspecialchars($food['image_url']) ?>" class="card-img" alt="<?= htmlspecialchars($food['name']) ?>">
    <div class="card-body">
        <p><?= htmlspecialchars($food['description']) ?></p>
        <strong>Rp<?= number_format($food['price'], 0, ',', '.') ?></strong>

        <form id="wishlistForm" action="?route=user/food/wishlist" method="POST" style="display:inline;">
            <input type="hidden" name="food_id" value="<?= htmlspecialchars($food['id']) ?>">
            <button type="submit" style="background:none; border:none; font-size:20px; cursor:pointer;">
                <?= $is_wishlisted ? '❤️' : '🤍' ?> Wishlist
            </button>
        </form>

        <p>Rating: <?= number_format($average_rating, 1) ?> / 5</p>

        <form id="ratingForm" method="POST" action="?route=user/food/rate" style="margin-top:10px;">
            <input type="hidden" name="food_id" value="<?= $food['id'] ?>">
            <label for="rating">Beri Rating:</label>
            <select name="rating" id="ratingSelect">
                <option value="">Pilih...</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>" <?= (isset($user_rating) && $user_rating == $i) ? 'selected' : '' ?>>
                        <?= $i ?> ⭐
                    </option>
                <?php endfor; ?>
            </select>
        </form>

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

        <form id="commentForm" method="POST" action="?route=user/food/comment" style="margin-top:10px;">
            <input type="hidden" name="food_id" value="<?= $food['id'] ?>">
            <textarea name="comment" rows="3" required placeholder="Tulis komentar Anda di sini..."></textarea><br>
            <button type="submit">Kirim Komentar</button>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../../layouts/user/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // --- Fungsi Kirim Data Sederhana (Tanpa JSON) ---
    async function simplePost(formElement) {
        const formData = new FormData(formElement); // Ambil semua data dari form
        try {
            const response = await fetch(formElement.action, { // Kirim ke alamat yang ada di 'action' form
                method: 'POST', // Metode POST
                body: formData // Data yang dikirim
            });

            // Kalau ada masalah dari server (bukan 200 OK)
            if (!response.ok) {
                // Di sini kita tidak akan bisa membaca pesan error spesifik dari PHP
                // karena PHP tidak mengembalikan JSON.
                // Kita hanya bisa bilang ada kesalahan umum.
                alert('Terjadi kesalahan. Silakan coba lagi.');
                return false; // Beri tahu kalau ada masalah
            }
            return true; // Beri tahu kalau sukses
        } catch (error) {
            console.error('AJAX Error:', error);
            alert('Terjadi kesalahan jaringan atau server.');
            return false; // Beri tahu kalau ada masalah
        }
    }

    // --- 1. Logika Wishlist ---
    const wishlistForm = document.getElementById('wishlistForm');
    if (wishlistForm) {
        wishlistForm.addEventListener('submit', async function(e) {
            e.preventDefault(); // Jangan refresh halaman!
            const success = await simplePost(this); // Kirim form
            if (success) {
                location.reload(); // Paksa reload halaman
            }
        });
    }

    // --- 2. Logika Rating ---
    const ratingForm = document.getElementById('ratingForm');
    const ratingSelect = document.getElementById('ratingSelect');
    if (ratingSelect) {
        ratingSelect.addEventListener('change', async function() { // Saat pilihan rating berubah
            const success = await simplePost(ratingForm); // Kirim form rating
            if (success) {
                location.reload(); // Paksa reload halaman
            }
        });
    }

    // --- 3. Logika Komentar ---
    const commentForm = document.getElementById('commentForm');
    if (commentForm) {
        commentForm.addEventListener('submit', async function(e) {
            e.preventDefault(); // Jangan refresh halaman!
            const success = await simplePost(this); // Kirim form komentar
            if (success) {
                this.querySelector('textarea[name="comment"]').value = ''; // Kosongkan kolom komentar
                location.reload(); // Paksa reload halaman
            }
        });
    }
});
</script>