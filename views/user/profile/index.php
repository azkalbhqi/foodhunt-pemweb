<?php include __DIR__ . '/../../layouts/user/header.php'; ?>

<div class="profile-container">
    <div class="profile-header">
        <img src="public/assets/logo.png" alt="FoodHunt Logo" class="profile-logo">
        <h2 class="profile-title">Profil Saya</h2>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="profile-alert profile-alert-success">
            <?= htmlspecialchars($_SESSION['success']) ?>
        </div>
    <?php endif; ?>

    <?php if (is_array($user)): ?>
    <form method="POST" action="?route=user/profile/update" class="profile-form">
        <label for="username" class="profile-form-label">Username:</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required class="profile-form-input">

        <label for="password" class="profile-form-label">Password Baru (opsional):</label>
        <input type="password" id="password" name="password" placeholder="Biarkan kosong jika tidak diubah" class="profile-form-input">

        <button type="submit" class="profile-btn">Simpan Perubahan</button>
    </form>
<?php else: ?>
    <p class="profile-alert profile-alert-danger">Data pengguna tidak ditemukan.</p>
<?php endif; ?>
</div>
