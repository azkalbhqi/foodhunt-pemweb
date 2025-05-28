<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Selamat datang, <?= htmlspecialchars($_SESSION['user'] ?? 'Admin') ?>!</h2>
<p>Ini adalah halaman dashboard admin <strong>FoodHunt</strong>. Kelola konten dan pantau aktivitas platform di sini.</p>

<?php /* Removed: <link rel="stylesheet" href="/foodhunt/public/css/admin_dashboard.css">
   It's generally better to include all CSS in your header.php or a dedicated CSS bundle.
   If admin_dashboard.css is crucial and not in header.php, ensure it's loaded globally or in header.php.
*/ ?>

<div class="dashboard-overview">
    <div class="stat-box">
        <h3><?= htmlspecialchars($totalBundles ?? 0) ?></h3>
        <p>Total Paket Makan</p>
    </div>
    <div class="stat-box">
        <h3><?= htmlspecialchars($totalFoods ?? 0) ?></h3>
        <p>Total Makanan</p>
    </div>
    <div class="stat-box">
        <h3><?= htmlspecialchars($totalEvents ?? 0) ?></h3>
        <p>Total Event Kuliner</p>
    </div>
    <?php /* If you also added Promo model, uncomment this:
    <div class="stat-box">
        <h3><?= htmlspecialchars($totalPromos ?? 0) ?></h3>
        <p>Total Promo Aktif</p>
    </div>
    */ ?>
</div>

<div class="quick-links">
    <h3>Navigasi Cepat</h3>
    <ul>
        <li><a href="?route=admin/food">Kelola Makanan</a></li>
        <li><a href="?route=admin/bundling">Kelola Paket Makan Spesial</a></li>
        <li><a href="?route=admin/promo">Kelola Promo</a></li>
        <li><a href="?route=admin/event">Kelola Event Kuliner</a></li>
        <li><a href="?route=admin/user">Kelola Pengguna</a></li>
        <li><a href="?route=admin/forum">Lihat Pesan Forum</a></li>
        <li><a href="?route=user/profile">Edit Profil Saya</a></li>
        <li><a href="?route=auth/logout" class="logout">Logout</a></li>
    </ul>
</div>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>