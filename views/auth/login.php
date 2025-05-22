<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - FoodHunt</title>
  <link rel="stylesheet" href="assets/css/authStyle.css">
</head>
<body>
  <div class="container">
    <!-- Logo dan Branding -->
    <div class="brand">
      <img src="public/assets/logo.png" alt="FoodHunt Logo" class="logo">
      <h1>FoodHunt</h1>
    </div>

    <h2>Login</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <div style="color:red; margin-bottom:10px;">
        <?= htmlspecialchars($_SESSION['error']) ?>
        <?php unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="?route=auth/login">
      <input 
        type="text" 
        name="username" 
        placeholder="Username" 
        required 
        value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
      ><br>

      <input 
        type="password" 
        name="password" 
        placeholder="Password" 
        required
      ><br>

      <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="?route=auth/register">Daftar di sini</a></p>
  </div>
</body>
</html>
