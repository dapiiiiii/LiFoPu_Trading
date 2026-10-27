// Guided inquiry builder: "What do you need?" → adapted details → contact.
// Works as a plain form without JavaScript; with it, steps, inline validation and an honest
// success/failure state that only appears after the server confirms.
export function initInquiry() {
    const root = document.querySelector('[data-inquiry]');
    const form = root?.querySelector('[data-inquiry-form]');
    if (!form) return;

    const steps = [...form.querySelectorAll('[data-step]')];
    const progress = [...root.querySelectorAll('[data-inquiry-progress] li')];
    const status = form.querySelector('[data-step-status]');
    const alertBox = form.querySelector('[data-inquiry-alert]');
    const result = root.querySelector('[data-inquiry-result]');
    const submit = form.querySelector('[data-inquiry-submit]');
    const subjects = JSON.parse(root.dataset.subjects || '{}');
    const msg = form.dataset;
    let current = 0;

    const interest = () => form.querySelector('input[name="interest"]:checked')?.value;

    const fieldError = (field, text) => {
        const wrap = field.closest('[data-field]');
        const error = wrap?.querySelector('.field__error') || form.querySelector(`[data-field-error="${field.name}"]`);
        wrap?.classList.toggle('field--invalid', !!text);
        if (text) field.setAttribute('aria-invalid', 'true');
        else field.removeAttribute('aria-invalid');
        if (error) {
            error.textContent = text || '';
            error.hidden = !text;
        }
    };

    // Only show (and submit) the detail fields relevant to the chosen interest.
    const applyInterest = () => {
        const value = interest();
        form.querySelectorAll('[data-for]').forEach((wrap) => {
            const on = !!value && wrap.dataset.for.split(' ').includes(value);
            wrap.hidden = !on;
            wrap.querySelectorAll('input, select, textarea').forEach((el) => { el.disabled = !on; });
        });
        const subject = form.querySelector('[name="subject"]');
        const known = Object.values(subjects);
        if (value && subject && (!subject.value || known.includes(subject.value))) subject.value = subjects[value];
    };

    const validateStep = (index) => {
        const fields = [...steps[index].querySelectorAll('input, select, textarea')].filter((el) => !el.disabled && el.name && el.type !== 'hidden');
        let firstInvalid = null;
        const radios = new Set();
        fields.forEach((field) => {
            if (field.type === 'radio') {
                if (radios.has(field.name)) return;
                radios.add(field.name);
                const ok = !field.required || !!form.querySelector(`input[name="${field.name}"]:checked`);
                fieldError(field, ok ? '' : 'Please choose one option.');
                if (!ok && !firstInvalid) firstInvalid = field;
                return;
            }
            let text = '';
            if (field.type === 'checkbox' && field.required && !field.checked) text = 'Please accept the Privacy Policy so we can respond.';
            else if (field.required && !field.value.trim()) text = 'This field is required.';
            else if (field.type === 'email' && field.value && !field.checkValidity()) text = 'Enter a valid email address.';
            else if (field.name === 'message' && field.value.trim().length > 0 && field.value.trim().length < 10) text = 'Please add a little more detail (at least 10 characters).';
            fieldError(field, text);
            if (text && !firstInvalid) firstInvalid = field;
        });
        firstInvalid?.focus();
        return !firstInvalid;
    };

    const show = (index, focus = true) => {
        current = Math.max(0, Math.min(steps.length - 1, index));
        steps.forEach((s, i) => s.toggleAttribute('data-current', i === current));
        progress.forEach((p, i) => {
            p.toggleAttribute('data-active', i === current);
            p.toggleAttribute('data-done', i < current);
        });
        status.textContent = msg.msgProgress.replace(':current', current + 1).replace(':total', steps.length) + ' — ' + steps[current].querySelector('legend').textContent;
        if (focus) {
            const legend = steps[current].querySelector('legend');
            legend.setAttribute('tabindex', '-1');
            legend.focus({ preventScroll: true });
            root.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    };

    form.addEventListener('change', (e) => {
        if (e.target.name === 'interest') {
            applyInterest();
            fieldError(e.target, '');
        }
    });
    form.addEventListener('input', (e) => {
        if (e.target.getAttribute('aria-invalid')) fieldError(e.target, '');
    });
    form.querySelectorAll('[data-step-next]').forEach((b) => b.addEventListener('click', () => validateStep(current) && show(current + 1)));
    form.querySelectorAll('[data-step-back]').forEach((b) => b.addEventListener('click', () => show(current - 1)));

    const showResult = (ok, title, message) => {
        result.hidden = false;
        result.classList.toggle('inquiry__result--success', ok);
        result.classList.toggle('inquiry__result--error', !ok);
        result.setAttribute('role', ok ? 'status' : 'alert');
        result.querySelector('[data-result-title]').textContent = title;
        result.querySelector('[data-result-message]').textContent = message;
        result.querySelector('[data-inquiry-reset]').hidden = !ok;
        form.hidden = ok;
        result.focus();
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        alertBox.hidden = true;
        for (let i = 0; i < steps.length; i++) {
            if (!validateStep(i)) {
                show(i);
                return;
            }
        }
        const label = submit.innerHTML;
        submit.disabled = true;
        submit.textContent = msg.msgSending;

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                body: new FormData(form),
            });
            const data = await response.json().catch(() => ({}));

            if (response.ok && data.ok) {
                showResult(true, msg.msgSuccess, data.message);
                return;
            }
            if (response.status === 422 && data.errors) {
                let firstStep = steps.length - 1;
                Object.entries(data.errors).forEach(([key, messages]) => {
                    const name = key.replace(/\.(\w+)/g, '[$1]');
                    const field = form.querySelector(`[name="${name}"]`) || form.querySelector(`[data-field-error="${key}"]`);
                    if (field?.name) {
                        fieldError(field, messages[0]);
                        const index = steps.findIndex((s) => s.contains(field));
                        if (index >= 0) firstStep = Math.min(firstStep, index);
                    } else if (field) {
                        field.textContent = messages[0];
                        field.hidden = false;
                    }
                });
                alertBox.innerHTML = `<p>${msg.msgValidation}</p>`;
                alertBox.hidden = false;
                show(firstStep);
                return;
            }
            showResult(false, msg.msgErrorTitle, response.status === 429 ? msg.msgThrottled : (data.message || msg.msgError));
        } catch {
            showResult(false, msg.msgErrorTitle, msg.msgError);
        } finally {
            submit.disabled = false;
            submit.innerHTML = label;
        }
    });

    root.querySelector('[data-inquiry-reset]')?.addEventListener('click', () => {
        form.reset();
        result.hidden = true;
        form.hidden = false;
        applyInterest();
        show(0);
    });
    // After an error, let people retry from the form.
    result.addEventListener('click', (e) => {
        if (result.classList.contains('inquiry__result--error') && e.target === result) result.hidden = true;
    });

    // Enhance: one step at a time. Server-side errors open the first step that has one.
    form.setAttribute('data-ready', '');
    applyInterest();
    const errored = steps.findIndex((s) => s.querySelector('.field--invalid, [data-field-error]:not([hidden])'));
    show(errored >= 0 ? errored : (interest() && new URLSearchParams(location.search).has('interest') ? 1 : 0), errored >= 0);
}
