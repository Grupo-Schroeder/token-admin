const themeToggle = document.querySelector('[data-theme-toggle]');

if (themeToggle instanceof HTMLButtonElement) {
    const updateThemeButton = () => {
        const isDark = document.documentElement.classList.contains('dark');

        themeToggle.setAttribute('aria-label', isDark ? 'Activar modo claro' : 'Activar modo oscuro');
        themeToggle.setAttribute('aria-pressed', String(isDark));
    };

    updateThemeButton();

    themeToggle.addEventListener('click', () => {
        const isDark = document.documentElement.classList.toggle('dark');

        localStorage.setItem('leben-theme', isDark ? 'dark' : 'light');
        updateThemeButton();
    });
}

const confirmDialog = document.querySelector('[data-confirm-dialog]');
const confirmDialogTitle = document.querySelector('[data-confirm-title]');
const confirmDialogMessage = document.querySelector('[data-confirm-message]');
const confirmDialogCancel = document.querySelector('[data-confirm-cancel]');
const confirmDialogAccept = document.querySelector('[data-confirm-accept]');

if (
    confirmDialog instanceof HTMLDialogElement
    && confirmDialogTitle instanceof HTMLElement
    && confirmDialogMessage instanceof HTMLElement
    && confirmDialogCancel instanceof HTMLButtonElement
    && confirmDialogAccept instanceof HTMLButtonElement
) {
    let pendingConfirmationForm = null;

    document.addEventListener('submit', (event) => {
        const form = event.target;

        if (!(form instanceof HTMLFormElement) || !form.hasAttribute('data-confirm-message')) {
            return;
        }

        if (form.dataset.confirmed === 'true') {
            delete form.dataset.confirmed;

            return;
        }

        event.preventDefault();
        pendingConfirmationForm = form;

        confirmDialogTitle.textContent = form.dataset.confirmTitle ?? 'Confirmar acción';
        confirmDialogMessage.textContent = form.dataset.confirmMessage ?? '';
        confirmDialogAccept.textContent = form.dataset.confirmLabel ?? 'Confirmar';

        const isDangerousAction = form.dataset.confirmTone === 'danger';

        confirmDialogAccept.classList.toggle('button-danger', isDangerousAction);
        confirmDialogAccept.classList.toggle('button-primary', !isDangerousAction);

        confirmDialog.showModal();
    });

    confirmDialogCancel.addEventListener('click', () => confirmDialog.close());

    confirmDialogAccept.addEventListener('click', () => {
        if (!pendingConfirmationForm) {
            return;
        }

        const form = pendingConfirmationForm;

        pendingConfirmationForm = null;
        form.dataset.confirmed = 'true';
        confirmDialog.close();
        form.requestSubmit();
    });

    confirmDialog.addEventListener('close', () => {
        pendingConfirmationForm = null;
    });
}

document.addEventListener('click', async (event) => {
    const button = event.target instanceof Element
        ? event.target.closest('[data-copy-target]')
        : null;

    if (!(button instanceof HTMLButtonElement)) {
        return;
    }

    const source = document.getElementById(button.dataset.copyTarget ?? '');

    if (!source) {
        return;
    }

    const value = source instanceof HTMLInputElement || source instanceof HTMLTextAreaElement
        ? source.value
        : source.textContent?.trim() ?? '';

    let copied = false;

    try {
        await navigator.clipboard.writeText(value);
        copied = true;
    } catch {
        const fallback = document.createElement('textarea');
        fallback.value = value;
        fallback.setAttribute('readonly', '');
        fallback.style.position = 'fixed';
        fallback.style.opacity = '0';
        document.body.append(fallback);
        fallback.select();

        try {
            copied = document.execCommand('copy');
        } catch {
            copied = false;
        } finally {
            fallback.remove();
        }
    }

    const feedback = document.getElementById(button.dataset.copyFeedback ?? '');
    const originalLabel = button.dataset.copyLabel ?? button.textContent.trim();

    button.disabled = true;
    button.textContent = copied ? 'Copiado' : 'No se pudo copiar';

    if (feedback) {
        feedback.textContent = copied
            ? 'Copiado al portapapeles.'
            : 'No se pudo copiar. Seleccioná y copiá el valor manualmente.';
    }

    window.setTimeout(() => {
        button.textContent = originalLabel;
        button.disabled = false;
    }, 1800);
});
