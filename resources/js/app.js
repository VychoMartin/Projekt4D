import './bootstrap';
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-password').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const input = document.getElementById(btn.dataset.target);
            const show = input.type === 'password';

            input.type = show ? 'text' : 'password';
            const icon = btn.querySelector('i');
icon.className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
            btn.setAttribute('aria-label', show ? 'Skrýt heslo' : 'Zobrazit heslo');
        });
    });
});
