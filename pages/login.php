<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Apotek Hidup</title>
  <link rel="stylesheet" href="../assets/css/login.css">
  <link rel="stylesheet" href="../assets/css/animation.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="icon" type="image/png" href="../assets/image/logo.png">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
</head>

<body>
  <!-- NAVBAR -->
  <header class="header">
    <div class="logo">
      <img src="../assets/image/logo.png" class="logo-img" alt="logo apotek hidup">
      APOTEK HIDUP
    </div>
    <nav>
      <ul>
        <li><a href="home.php">Beranda</a></li>
        <li><a href="produk.php">Produk</a></li>
        <li><a href="contact.php">Tentang Kami</a></li>
      </ul>
    </nav>
    <div class="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="user-actions">
      <form action="produk.php" method="GET" class="search-container">
        <input type="text" class="search-input" placeholder="Cari obat...">
        <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
      <div class="profile-dropdown">
        <button class="profile-btn"><i class="fa-solid fa-circle-user"></i></button>
        <div class="dropdown-content">
          <a href="login.php" class="login-link">Login</a>
          <a href="signup.php">Daftar</a>
          <a href="profile.php">Profil Saya</a>
          <!-- <a href="../auth/logout.php">Logout</a> -->
        </div>
      </div>
    </div>
    <button class="cart-btn"><i class="fas fa-shopping-cart"></i>
      <span class="cart-count">0</span></button>
    </div>
  </header>
  <!-- NAVBAR -->

  <!-- LOGIN SECTION -->
  <section class="login-section">
    <div class="container">
      <div class="login-container fade-in">
        <h2>Masuk ke Akun Anda</h2>
        <?php if (isset($_GET['error'])): ?>
          <div class="alert">
            <?php if ($_GET['error'] == 'password')
              echo "Password salah!"; ?>
            <?php if ($_GET['error'] == 'notfound')
              echo "Akun tidak ditemukan!"; ?>
          </div>
        <?php endif; ?>
        <form id="loginForm" class="login-form" action="../auth/login_process.php" method="POST">
          <div class="form-group">
            <label for="login">Email/Username</label>
            <input type="text" id="login" name="login" placeholder="Email atau Username" required>
            <i class="fas fa-envelope icon"></i>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <i class="fas fa-lock icon"></i>
            <button type="button" class="toggle-password"><i class="fas fa-eye icons"></i></button>
          </div>
          <div class="form-options">
            <a href="lupa_password.php" class="forgot-password">Lupa Password?</a>
          </div>
          <button type="submit" class="login-submit">Masuk</button>
          <div class="register-link">
            Belum punya akun? <a href="signup.php">Daftar Sekarang</a>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!-- LOGIN SECTION -->

  <!-- KERANJANG -->
  <div class="cart-modal">
    <div class="cart-content">
      <div class="cart-header">
        <h3>Keranjang Belanja</h3>
        <button class="close-cart">&times;</button>
      </div>
      <div class="cart-items">
        <p class="empty-cart-message">Keranjang belanja kosong</p>
      </div>
      <div class="cart-total">
        <p>Total : <span class="total-price">Rp 0</span></p>
        <button class="checkout-btn" onclick="location.href = 'checkout.php'">Checkout</button>
      </div>
    </div>
  </div>
  <!-- KERANJANG -->

  <!-- FOOTER -->
  <footer class="store-footer">
    <div class="footer-content">
      <div class="footer-section">
        <h4>Tentang Kami</h4>
        <p>Apotek terlengkap dan termurah se-Salatiga.</p>
      </div>
      <div class="footer-section">
        <h4>Kontak</h4>
        <p>Email: apotekhidup@gmail.com</p>
        <p>Telepon: 085123456789</p>
      </div>
      <div class="footer-section">
        <h4>Social Media</h4>
        <div class="social-icons">
          <a href="https://www.instagram.com/iamsunraku/">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="https://www.facebook.com/profile.php?id=100073343155289">
            <i class="fab fa-facebook"></i>
          </a>
          <a href="whatsapp.com">
            <i class="fab fa-whatsapp"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="copyright">
      <p>&copy; 2025 Apotek Hidup. All rights reserved.</p>
    </div>
  </footer>
  <!-- FOOTER -->

  <!-- js -->
  <script src="../assets/js/main.js"></script>
</body>

</html>