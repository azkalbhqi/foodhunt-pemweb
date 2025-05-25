<?php session_start(); ?>
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
    <div class="brand">
      <img src="public/assets/logo.png" alt="FoodHunt Logo" class="logo">
      <h1>FoodHunt</h1>
    </div>

    <h2>Login</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="error-message">
        <?= htmlspecialchars($_SESSION['error']) ?>
        <?php unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="?route=auth/login" autocomplete="off">
      <input 
        type="text" 
        name="usernameOrEmail" 
        placeholder="Username atau Email" 
        required 
        value="<?= isset($_POST['usernameOrEmail']) ? htmlspecialchars($_POST['usernameOrEmail']) : '' ?>"
      ><br>

      <input 
        type="password" 
        name="password" 
        placeholder="Password" 
        id="passwordInput"
        required
        value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>"
      ><br>

      <label>
        <input type="checkbox" onclick="togglePassword()"> Tampilkan Password
      </label>

      <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="?route=auth/register">Daftar di sini</a></p>
  </div>

  <script>
    function togglePassword() {
      const input = document.getElementById("passwordInput");
      input.type = input.type === "password" ? "text" : "password";
    }
  </script>
</body>
</html>
