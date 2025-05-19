<?php include __DIR__ . '/../../layouts/admin/header.php'; ?>

<h2>Selamat datang, <?= htmlspecialchars($_SESSION['user']) ?>!</h2>
<p>Ini adalah halaman dashboard admin <strong>FoodHunt</strong>. Kelola konten dan pantau aktivitas platform di sini.</p>

<link rel="stylesheet" href="/foodhunt/public/css/admin_dashboard.css">

<div class="dashboard-overview">
    <div class="stat-box">
        <h3>20</h3>
        <p>Total Paket Makan</p>
    </div>
    <div class="stat-box">
        <h3>12</h3>
        <p>Promo Aktif</p>
    </div>
    <div class="stat-box">
        <h3>5</h3>
        <p>Event Kuliner</p>
    </div>
</div>

<div class="quick-links">
    <h3>Navigasi Cepat</h3>
    <ul>
        <li><a href="?route=admin/bundling">Kelola Paket Makan Spesial</a></li>
        <li><a href="?route=admin/promo">Kelola Promo</a></li>
        <li><a href="?route=admin/event">Kelola Event Kuliner</a></li>
        <li><a href="?route=admin/user">Kelola Pengguna</a></li>
        <li><a href="?route=auth/logout" class="logout">Logout</a></li>
    </ul>
</div>

<?php include __DIR__ . '/../../layouts/admin/footer.php'; ?>
