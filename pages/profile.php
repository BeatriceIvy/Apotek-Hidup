<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

$user = $conn->query("
    SELECT nama, email, foto, created_at 
    FROM users 
    WHERE id = $id_user
")->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Apotek Hidup</title>
    <link rel="stylesheet" href="../assets/css/profile.css">
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
                </div>
            </div>
            <button class="cart-btn"><i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span></button>
        </div>
    </header>
    <!-- NAVBAR -->

    <!-- profile section start -->
    <section class="profile-section">
        <div class="container">
            <div class="profile-header">
                <h2>Profil Saya</h2>
                <div class="profile-actions">
                    <button type="button" id="editBtn" class="edit-profile-btn">
                        <i class="fas fa-edit"></i> Ubah Profil
                    </button>
                </div>
            </div>

            <div class="profile-container">
                <div class="profile-sidebar">
                    <div class="profile-card">
                        <div class="profile-avatar">
                            <img src="../assets/image/profile/<?= $user['foto'] ?>?v=<?= time() ?>"
                                alt="Profile Picture">


                            <form action="../auth/update_foto.php" method="POST" enctype="multipart/form-data">
                                <label class="change-avatar-btn">
                                    <i class="fas fa-camera"></i>
                                    <input type="file" name="foto" hidden onchange="this.form.submit()">
                                </label>
                            </form>
                        </div>

                        <h3 class="profile-name"><?= htmlspecialchars($user['nama']) ?></h3>
                        <p class="profile-email"><?= htmlspecialchars($user['email']) ?></p>

                        <div class="profile-meta">
                            <p>
                                <i class="fas fa-birthday-cake"></i>
                                Bergabung sejak <?= date('d F Y', strtotime($user['created_at'])) ?>
                            </p>

                        </div>
                        <div class="profile-actions">
                            <a href="riwayat_transaksi.php" class="btn-riwayat">
                                <i class="fas fa-sign-out-alt"></i> Riwayat Transaksi
                            </a>
                            <a href="../auth/logout.php" class="btn-logout">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>


                <div class="profile-content">
                    <div class="profile-info-card">
                        <h3><i class="fas fa-info-circle"></i> Informasi Pribadi</h3>
                        <form class="profile-form" action="../auth/profile_update.php" method="POST" id="profileForm">

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" value="<?= htmlspecialchars($user['nama']) ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
                                    readonly>
                            </div>

                            <div class="form-actions hidden" id="formActions">
                                <button type="button" id="cancelBtn" class="cancel-btn">Batal</button>
                                <button type="submit" class="save-btn">Simpan</button>
                            </div>

                        </form>


                    </div>
                    <div class="form-actions">
                        <button type="button" class="cancel-btn">Batal</button>
                        <button type="submit" class="save-btn">Simpan Perubahan</button>
                    </div>
                </div>
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
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            console.log("PROFILE JS READY");

            const editBtn = document.getElementById("editBtn");
            const cancelBtn = document.getElementById("cancelBtn");
            const formActions = document.getElementById("formActions");
            const inputs = document.querySelectorAll("#profileForm input");

            if (!editBtn) {
                console.error("editBtn NOT FOUND");
                return;
            }

            editBtn.addEventListener("click", () => {
                inputs.forEach(i => i.removeAttribute("readonly"));
                formActions.classList.remove("hidden");
                editBtn.classList.add("hidden");
            });

            cancelBtn.addEventListener("click", () => {
                inputs.forEach(i => i.setAttribute("readonly", true));
                formActions.classList.add("hidden");
                editBtn.classList.remove("hidden");
            });
        });

    </script>
    <!-- <script src="../assets/js/main.js"></script> -->
    <!-- profile section end-->

</body>

</html>