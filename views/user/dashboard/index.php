<?php include __DIR__ . '/../../layouts/user/header.php'; ?>

<link rel="stylesheet" href="/foodhunt/public/css/user_dashboard.css">

<!-- Hero Section -->
<div class="welcome-section">
    <h2>Selamat Datang, <?= htmlspecialchars($_SESSION['user']) ?>!</h2>
    <p><strong>FOODHUNT</strong> memudahkan kamu menjelajahi kuliner terbaik — cepat, informatif, dan penuh inspirasi.</p>
</div>

<!-- About Section -->
<div class="container">
    <section class="intro-text">
        <h3>Mengapa FOODHUNT?</h3>
        <p>
            Lebih dari sekadar direktori makanan, <strong>FOODHUNT</strong> adalah teman kulinermu untuk menemukan makanan viral, promo eksklusif, dan event menarik di berbagai lokasi. 
            Dirancang untuk para foodies yang haus eksplorasi rasa!
        </p>
    </section>

    <!-- Features Section -->
    <section class="intro-text">
        <h3>Fitur Unggulan</h3>
        <ul style="padding-left: 20px; list-style-type: disc; color: #444;">
            <li>📍 Rekomendasi restoran viral dan tersembunyi</li>
            <li>🔥 Promo dan bundling makanan spesial setiap minggu</li>
            <li>🎉 Update event kuliner dan festival makanan terdekat</li>
            <li>📝 Ulasan pengguna dan komunitas kuliner aktif</li>
        </ul>
    </section>

    <!-- Community Section -->
    <section class="intro-text">
        <h3>Bergabung dalam Komunitas</h3>
        <p>
            Di era kuliner digital yang dinamis, kamu tidak perlu ketinggalan tren. <strong>FOODHUNT</strong> hadir sebagai jembatan antara rasa, tempat, dan pengalaman. Temukan, simpan, dan bagikan rekomendasi makanan favoritmu bersama ribuan pengguna lainnya.
        </p>
    </section>
</div>

<!-- Action Buttons -->
<div class="user-actions">
    <a href="?route=user/bundling" class="dashboard-card">
        <img src="/foodhunt/public/assets/food-icon.png" alt="Paket Makan">
        <h3>Paket Makan Spesial</h3>
        <p>Jelajahi bundling makanan hemat & lezat</p>
    </a>
    <a href="?route=user/wishlist" class="dashboard-card">
        <img src="/foodhunt/public/assets/wishlist-icon.png" alt="Wishlist">
        <h3>Wishlist Saya</h3>
        <p>Simpan makanan favoritmu dengan mudah</p>
    </a>
</div>

<?php include __DIR__ . '/../../layouts/user/footer.php'; ?>
