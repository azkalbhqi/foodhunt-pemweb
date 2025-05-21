<?php include __DIR__ . '/../../layouts/user/header.php'; ?>

<h2>Wishlist Saya</h2>

<?php if (empty($wishlistFoods)): ?>
    <p>Kamu belum menambahkan makanan ke wishlist.</p>
<?php else: ?>
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse; margin-top:20px;">
        <thead style="background-color: #f2f2f2;">
            <tr>
                <th>Gambar</th>
                <th>Nama Makanan</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($wishlistFoods as $food): ?>
                <tr>
                    <td style="text-align: center;">
                        <img src="/foodhunt/public/food/<?= htmlspecialchars($food['image_url']) ?>" alt="<?= htmlspecialchars($food['name']) ?>" width="100">
                    </td>
                    <td><?= htmlspecialchars($food['name']) ?></td>
                    <td><?= htmlspecialchars($food['description']) ?></td>
                    <td>Rp<?= number_format($food['price'], 0, ',', '.') ?></td>
                    <td style="text-align: center;">
                        <form action="?route=user/wishlist/remove" method="POST" style="display:inline;">
                            <input type="hidden" name="food_id" value="<?= $food['id'] ?>">
                            <button type="submit" style="background-color: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                                Hapus ❤️
                            </button>
                        </form>
                        <br>
                        <a href="?route=user/food/show/<?= $food['id'] ?>">Lihat Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php include __DIR__ . '/../../layouts/user/footer.php'; ?>
