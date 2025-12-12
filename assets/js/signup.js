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

//login facebook or google
function redirFacebook() {
    window.location.href = "https://www.facebook.com/";
}

function redirGoogle() {
    window.location.href = "https://accounts.google.com/";
}