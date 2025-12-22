<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Apotek Hidup</title>
    <link rel="stylesheet" href="../assets/css/contact.css">
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
                <li><a href="#">Hubungi Kami</a></li>
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
                <p class="empty-cart-messages">Keranjang belanja kosong</p>
            </div>
            <div class="cart-total">
                <p>Total : <span class="total-price">Rp 0</span></p>
                <button class="checkout-btn" onclick="location.href = 'checkout.php'">Checkout</button>
            </div>
        </div>
    </div>
    <!-- KERANJANG -->

    <!-- HERO -->
    <section class="contact-hero">
        <div class="contact-container">
            <h1>Hubungi Kami</h1>
            <p>Jangan ragu untuk mengirimkan pesan, saran, dan pertanyaan seputar APOTEK HIDUP</p>
        </div>
    </section>
    <!-- HERO -->

    <!-- CONTACT CONTENT -->
    <section class="contact-section">
        <div class="container contact-grid fade-in slide-up">

            <!-- Form Kontak -->
            <div class="contact-form">
                <h3>Kirim Pesan</h3>
                <form action="../auth/contact_process.php" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="number" name="no_hp" placeholder="Nomor HP" required>
                    <input type="text" name="subjek" placeholder="Subjek" required>
                    <textarea name="pesan" rows="5" placeholder="Tulis pesanmu di sini..." required></textarea>
                    <button type="submit" class="btn-primary">Kirim Pesan</button>
                </form>
            </div>

            <!-- Info Kontak -->
            <div class="contact-info">
                <h3>Informasi Kontak</h3>
                <p><strong>Alamat:</strong><br> Fakultas Dakwah, UIN Salatiga, Jawa Tengah</p>
                <p><strong>Email:</strong><br> apotekhidup@gmail.com</p>
                <p><strong>Instagram:</strong><br> <a href="#" target="_blank">@ApotekHidup</a></p>
                <p><strong>YouTube:</strong><br> <a href="#" target="_blank">APOTEK HIDUP OFFICIAL</a></p>
            </div>

        </div>
    </section>


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
</body>

<script src="../assets/js/main.js"></script>

</html>