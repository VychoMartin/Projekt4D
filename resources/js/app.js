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

   document.addEventListener('DOMContentLoaded', () => {
    const toast = document.getElementById('toast');
    if (!toast) return;

    let autoClose;

    const close = () => {
        clearTimeout(autoClose);              
        toast.classList.add('hide');           
        setTimeout(() => toast.remove(), 400); 
    };

    toast.querySelector('.toast-close').addEventListener('click', close);
    autoClose = setTimeout(close, 4000);       
});

    document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('confirm-modal');
    if (!modal) return;

    const text = modal.querySelector('#confirm-text');
    const okBtn = modal.querySelector('.modal-confirm');
    const cancelBtn = modal.querySelector('.modal-cancel');
    let pendingForm = null;

    const open = (form) => {
        pendingForm = form;
        text.textContent = form.dataset.confirm;
        okBtn.textContent = form.dataset.confirmButton || 'Potvrdit';
        modal.hidden = false;
        cancelBtn.focus();
    };

    const close = () => {
        modal.hidden = true;
        pendingForm = null;
    };

    // zachytí odeslání všech formulářů s data-confirm
    document.addEventListener('submit', (e) => {
        const form = e.target;
        if (form.dataset.confirm && !form.dataset.confirmed) {
            e.preventDefault();
            open(form);
        }
    });

    okBtn.addEventListener('click', () => {
        if (!pendingForm) return;
        pendingForm.dataset.confirmed = '1';
        pendingForm.submit();
    });

    cancelBtn.addEventListener('click', close);
    modal.addEventListener('click', (e) => { if (e.target === modal) close(); });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });
});
