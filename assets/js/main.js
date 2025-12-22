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
// cart
// ===========================
document.addEventListener("DOMContentLoaded", () => {

  document.body.addEventListener("click", e => {
    if (e.target.classList.contains("add-to-cart")) {
      console.log("ADD TO CART DIKLIK");
      console.log("ID:", e.target.dataset.id);
      console.log("NAMA:", e.target.dataset.nama);
      console.log("HARGA:", e.target.dataset.harga);

      fetch("/Apotek Hidup/auth/cart_add.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          id: e.target.dataset.id,
          nama: e.target.dataset.nama,
          harga: e.target.dataset.harga
        })
      }).then(() => loadCart());
    }
  });

  document.querySelector(".cart-btn").onclick = () => {
    document.querySelector(".cart-modal").style.display = "block";
    loadCart();
  };

  document.querySelector(".close-cart").onclick = () => {
    document.querySelector(".cart-modal").style.display = "none";
  };
});

function loadCart() {
  fetch("/Apotek Hidup/auth/cart_get.php")
    .then(res => res.json())
    .then(data => {
      const cartItems = document.querySelector(".cart-items");
      const totalPrice = document.querySelector(".total-price");
      const cartCount = document.querySelector(".cart-count");

      cartItems.innerHTML = "";
      let total = 0;
      let totalQty = 0;

      if (data.length === 0) {
        cartItems.innerHTML =
          '<p class="empty-cart-message">Keranjang belanja kosong</p>';
        totalPrice.textContent = "Rp 0";
        if (cartCount) cartCount.textContent = "0";
        return;
      }

      data.forEach(item => {
        total += item.harga * item.qty;
        totalQty += item.qty;

        cartItems.innerHTML += `
          <div class="cart-item">
            <p><strong>${item.nama}</strong></p>
            <p>${item.qty} x Rp ${item.harga.toLocaleString()}</p>
          </div>
        `;
      });

      totalPrice.textContent = "Rp " + total.toLocaleString();
      if (cartCount) cartCount.textContent = totalQty;
    });
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
});

// Payment

const paymentSelect = document.getElementById("paymentMethod");
const modal = document.getElementById("paymentModal");
const closeBtn = document.querySelector(".close");

const qris = document.getElementById("qrisContent");
const transfer = document.getElementById("transferContent");

paymentSelect.addEventListener("change", function () {
  // reset
  qris.style.display = "none";
  transfer.style.display = "none";
  modal.style.display = "none";

  if (this.value === "qris") {
    qris.style.display = "block";
    modal.style.display = "block";
  }

  if (this.value === "transfer") {
    transfer.style.display = "block";
    modal.style.display = "block";
  }

  // COD = tidak melakukan apa-apa
});

closeBtn.onclick = () => modal.style.display = "none";

window.onclick = (e) => {
  if (e.target === modal) modal.style.display = "none";
};

// profil
