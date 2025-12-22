<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<h3>Keranjang kosong</h3>";
}

$cart = $_SESSION['cart'];
$total = 0;

if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION['redirect_after_login'] = 'checkout.php';

    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Apotek Hidup</title>
    <link rel="stylesheet" href="../assets/css/checkout.css">
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
                <li><a href="contact.php">Hubungi Kami</a></li>
            </ul>
        </nav>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="user-actions">
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Cari obat...">
                <button class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <div class="profile-dropdown">
                <button class="profile-btn"><i class="fa-solid fa-circle-user"></i></button>
                <div class="dropdown-content">
                    <a href="login.php" class="login-link">Login</a>
                    <a href="signup.php">Daftar</a>
                    <a href="profile.php">Profil Saya</a>
                    <a href="riwayat.php">Riwayat</a>
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
                <p class="empty-cart-messages">Keranjang belanja kosong</p>
            </div>
            <div class="cart-total">
                <p>Total : <span class="total-price">Rp 0</span></p>
                <button class="checkout-button" onclick="location.href = 'checkout.php'">Checkout</button>
            </div>
        </div>
    </div>
    <!-- KERANJANG -->

    <!-- checkout section start -->
    <section class="checkout-section">
        <div class="container">
            <h2 class="section-title">Checkout</h2>
            <div class="checkout-container">
                <div class="order-summary">
                    <h3>Ringkasan Pesanan</h3>
                    <ul>
                        <?php foreach ($cart as $item):
                            $subtotal = $item['harga'] * $item['qty'];
                            $total += $subtotal;
                            ?>
                            <li>
                                <?= $item['nama']; ?>
                                (<?= $item['qty']; ?> x Rp <?= number_format($item['harga']); ?>)
                                = <strong>Rp <?= number_format($subtotal); ?></strong>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="order-items">
                    </div>
                    <div class="order-total">
                        <p>Total: <span class="total-price"><?= number_format($total); ?></span></p>
                    </div>
                </div>

                <div class="checkout-form">
                    <h3>Informasi Pengiriman</h3>
                    <form id="payment-form" action="../auth/checkout_process.php" method="POST">
                        <div class="form-group">
                            <label for="name">Nama Penerima</label>
                            <input type="text" id="name" name="nama_penerima" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">No. Telepon</label>
                            <input type="tel" id="phone" name="no_hp" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat Lengkap</label>
                            <textarea id="address" rows="3" name="alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="payment">Metode Pembayaran</label>
                            <select name="payment_method" id="paymentMethod" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="qris">QRIS</option>
                                <option value="transfer">Transfer Bank</option>
                                <option value="cod">COD</option>
                            </select>
                        </div>
                        <button type="submit" class="submit-order-btn">Buat Pesanan</button>
                    </form>
                    <div id="paymentModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>

                            <!-- QRIS -->
                            <div id="qrisContent" class="payment-content">
                                <h3>Scan QRIS</h3>
                                <img src="../assets/image/qris.jpeg" alt="QRIS" width="200">
                                <p>Silakan scan QR untuk melakukan pembayaran</p>
                            </div>

                            <!-- TRANSFER -->
                            <div id="transferContent" class="payment-content">
                                <h3>Transfer Bank</h3>
                                <p><b>BCA</b> : 1234567890</p>
                                <p><b>BRI</b> : 0987654321</p>
                                <p><b>Atas Nama</b> : Apotek Hidup</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- checkout section end -->

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