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
document.querySelectorAll('.role-select').forEach(select => {
    const row = select.closest('tr');
    const input = row.querySelector('.specializace-input');

    const toggle = () => {
        const isTechnik = select.value === 'technik';
        input.style.visibility = isTechnik ? 'visible' : 'hidden';
        input.disabled = !isTechnik;
    };

    select.addEventListener('change', toggle);
    toggle();
});
