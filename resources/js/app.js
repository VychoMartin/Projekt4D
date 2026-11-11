import './bootstrap';
 
document.addEventListener('DOMContentLoaded', () => {
 
    /* ---------- Zobrazení / skrytí hesla ---------- */
    document.querySelectorAll('.toggle-password').forEach((btn) => {
        btn.addEventListener('click', () => {
            const input = document.getElementById(btn.dataset.target);
            if (!input) return;
 
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
 
            const icon = btn.querySelector('i');
            if (icon) icon.className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
 
            btn.setAttribute('aria-label', show ? 'Skrýt heslo' : 'Zobrazit heslo');
        });
    });
 
    /* ---------- Toast ---------- */
    const toast = document.getElementById('toast');
    if (toast) {
        let timer;
 
        const closeToast = () => {
            clearTimeout(timer);
            toast.dataset.closing = 'true';          // spustí animaci zmizení
            setTimeout(() => toast.remove(), 400);   // odstranění z DOM
        };
 
        toast.querySelector('[data-toast-close]')?.addEventListener('click', closeToast);
        timer = setTimeout(closeToast, 4000);        // automaticky po 4 s
    }
 
    /* ---------- Potvrzovací okno ---------- */
    const modal = document.getElementById('confirm-modal');
    if (modal) {
        const title     = modal.querySelector('#confirm-title');
        const text      = modal.querySelector('#confirm-text');
        const okBtn     = modal.querySelector('[data-confirm-ok]');
        const cancelBtn = modal.querySelector('[data-confirm-cancel]');
        let pendingForm = null;
 
        const openModal = (form) => {
            pendingForm = form;
            title.textContent = form.dataset.confirmTitle || 'Opravdu to chcete udělat?';
            text.textContent  = form.dataset.confirm;
            okBtn.textContent = form.dataset.confirmButton || 'Potvrdit';
            modal.hidden = false;
            document.body.classList.add('overflow-hidden');
            cancelBtn.focus();
        };
 
        const closeModal = () => {
            modal.hidden = true;
            pendingForm = null;
            document.body.classList.remove('overflow-hidden');
        };
 
        // zachytí odeslání všech formulářů s data-confirm
        document.addEventListener('submit', (e) => {
            const form = e.target;
            if (form.dataset.confirm && !form.dataset.confirmed) {
                e.preventDefault();
                openModal(form);
            }
        });
 
        okBtn.addEventListener('click', () => {
            if (!pendingForm) return;
            pendingForm.dataset.confirmed = '1';
            pendingForm.submit();
        });
 
        cancelBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !modal.hidden) closeModal();
        });
    }
});
 