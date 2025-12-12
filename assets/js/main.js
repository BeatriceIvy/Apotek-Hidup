// ===========================
// HAMBURGER MENU (Mobile Nav)
// ===========================
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector("nav ul");

if (hamburger && navMenu) {
    hamburger.addEventListener("click", () => {
        navMenu.classList.toggle("active");
        hamburger.classList.toggle("active");
        document.body.classList.toggle("no-scroll");
    });
}

// Close menu when clicking a link (mobile)
const navLinks = document.querySelectorAll("nav ul li a");
navLinks.forEach(link => {
    link.addEventListener("click", () => {
        if (navMenu.classList.contains("active")) {
            navMenu.classList.remove("active");
            hamburger.classList.remove("active");
            document.body.classList.remove("no-scroll");
        }
    });
});

// =============================
// DROPDOWN PROFILE (User/Admin)
// =============================
const profileBtn = document.querySelector(".profile-btn");
const dropdown = document.querySelector(".dropdown-content");

if (profileBtn && dropdown) {
    document.addEventListener("click", (e) => {
        if (profileBtn.contains(e.target)) {
            dropdown.classList.toggle("show");
        } else if (!dropdown.contains(e.target)) {
            dropdown.classList.remove("show");
        }
    });
}

// ===========================
// CART MODAL (Slide Right)
// ===========================
const cartBtn = document.querySelector(".cart-btn");
const cartModal = document.querySelector(".cart-modal");
const closeCart = document.querySelector(".close-cart");

if (cartBtn && cartModal) {
    cartBtn.addEventListener("click", () => {
        cartModal.classList.add("active");
        document.body.classList.add("no-scroll");
    });
}

if (closeCart && cartModal) {
    closeCart.addEventListener("click", () => {
        cartModal.classList.remove("active");
        document.body.classList.remove("no-scroll");
    });
}

// Close cart when clicking outside
window.addEventListener("click", (e) => {
    if (cartModal && e.target === cartModal) {
        cartModal.classList.remove("active");
        document.body.classList.remove("no-scroll");
    }
});

// ===========================
// TOGGLE PASSWORD (Login/Sign-up)
// ===========================
document.addEventListener('DOMContentLoaded', function () {

    // password show/hide
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.getElementById('password');

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            this.innerHTML =
                type === 'password'
                    ? '<i class="fas fa-eye icons"></i>'
                    : '<i class="fas fa-eye-slash icons"></i>';
        });
    }
});

// ===========================
// SEARCH BAR (Expand on Focus)
// ===========================
const searchInput = document.querySelector(".search-input");

if (searchInput) {
    searchInput.addEventListener("focus", () => {
        searchInput.classList.add("active");
    });

    searchInput.addEventListener("blur", () => {
        searchInput.classList.remove("active");
    });

    // SEARCHBAR → pindah ke produk.php
    const searchInput = document.querySelector(".search-input");
    const searchBtn = document.querySelector(".search-btn");

    if (searchBtn) {
        searchBtn.addEventListener("click", () => {
            const q = searchInput.value.trim();
            if (q.length === 0) return;

            window.location.href = `produk.php?search=${encodeURIComponent(q)}`;
        });
    }
}

// ===========================
// SMALL FADE-IN ANIMATION
// ===========================
const fadeElements = document.querySelectorAll(".fade-in");

const fadeObserver = new IntersectionObserver(
    (entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            }
        });
    },
    { threshold: 0.2 }
);

fadeElements.forEach(el => fadeObserver.observe(el));

document.addEventListener("DOMContentLoaded", () => {
    const cartBtn = document.querySelector(".cart-btn");
    const cartModal = document.querySelector(".cart-modal");
    const closeCart = document.querySelector(".close-cart");
    const cartItems = document.querySelector(".cart-items");
    const cartCount = document.querySelector(".cart-count");
    const totalPrice = document.querySelector(".total-price");

    let cart = [];

    // Buka keranjang
    cartBtn.addEventListener("click", () => {
        cartModal.classList.add("active");
    });

    // Tutup keranjang
    closeCart.addEventListener("click", () => {
        cartModal.classList.remove("active");
    });

    // Tambah ke keranjang
    document.querySelectorAll(".add-to-cart").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            const nama = btn.dataset.nama;
            const harga = parseInt(btn.dataset.harga);

            const item = { id, nama, harga };

            cart.push(item);
            updateCartUI();
        });
    });

    function updateCartUI() {
        cartItems.innerHTML = "";
        let total = 0;

        if (cart.length === 0) {
            cartItems.innerHTML = `<p class="empty-cart-messages">Keranjang belanja kosong</p>`;
        } else {
            cart.forEach(item => {
                total += item.harga;

                const el = document.createElement("div");
                el.classList.add("cart-item");
                el.innerHTML = `
                    <div style="flex:1">
                        <h4>${item.nama}</h4>
                        <p>Rp ${item.harga.toLocaleString()}</p>
                    </div>
                `;
                cartItems.appendChild(el);
            });
        }

        cartCount.textContent = cart.length;
        totalPrice.textContent = "Rp " + total.toLocaleString();
    }
});