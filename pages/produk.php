<?php
session_start();
include "../config/database.php";

$data_produk = $conn->query("SELECT * FROM obat ORDER BY id_obat DESC");

$keyword = $_GET['q'] ?? '';

if ($keyword) {
    $stmt = $conn->prepare("
        SELECT * FROM obat 
        WHERE nama_obat LIKE ? 
        OR kategori LIKE ?
        ORDER BY id_obat DESC
    ");
    $like = "%$keyword%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $data_produk = $stmt->get_result();
} else {
    $data_produk = $conn->query("SELECT * FROM obat ORDER BY id_obat DESC");
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Apotek Hidup</title>
    <link rel="stylesheet" href="../assets/css/produk.css">
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
                <li><a href="#">Produk</a></li>
                <li><a href="contact.php">Hubungi Kami</a></li>
            </ul>
        </nav>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="user-actions">
            <form action="produk.php" method="GET" class="search-container">
                <input type="text" name="q" class="search-input" placeholder="Cari obat..." required>
                <button type="submit" class="search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
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
            <button class="cart-btn"><i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span></button>
        </div>
    </header>
    <!-- NAVBAR -->

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

    <!-- PRODUK -->
    <section class="featured-products">
        <?php if ($data_produk->num_rows === 0): ?>
            <h1 style="text-align:center; margin-top:30px;">
                ❌ Produk tidak tersedia
            </h1>
        <?php endif; ?>
        <h2 class="section-title">Semua Produk</h2>

        <div class="product-grid">

            <?php while ($row = $data_produk->fetch_assoc()): ?>
                <div class="product-card slide-up">

                    <img class="produk-img" src="../assets/image/<?= $row['gambar']; ?>" alt="<?= $row['nama_obat']; ?>">

                    <div class="product-info">
                        <h3><?= $row['nama_obat']; ?></h3>
                        <p class="price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                        <p class="stok">Stok: <?= $row['stok']; ?></p>

                        <button class="add-to-cart btn-anim" data-id="<?= $row['id_obat']; ?>"
                            data-nama="<?= $row['nama_obat']; ?>" data-harga="<?= $row['harga']; ?>">
                            Tambah ke Keranjang
                        </button>

                    </div>

                </div>
            <?php endwhile; ?>

        </div>
    </section>
    <!-- PRODUK -->

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
    <script src="../assets/js/main.js"></script>
</body>

</html>