// Fungsi kirim pesan (dummy)
function sendMessage(event) {
  event.preventDefault();

  const nama = document.getElementById('nama').value;
  const email = document.getElementById('email').value;
  const pesan = document.getElementById('pesan').value;
  const statusMsg = document.getElementById('statusMsg');

  if (nama && email && pesan) {
    statusMsg.innerText = "✅ Pesan kamu sudah dikirim! Terima kasih, " + nama + " 🙌";
    statusMsg.style.color = "green";
    document.getElementById('contactForm').reset();
  } else {
    statusMsg.innerText = "⚠️ Mohon isi semua field sebelum mengirim.";
    statusMsg.style.color = "red";
  }
}

// Animasi Fade-up
document.addEventListener("DOMContentLoaded", () => {
  const fadeElements = document.querySelectorAll('.fade-up');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.2 });

  fadeElements.forEach(el => observer.observe(el));
});