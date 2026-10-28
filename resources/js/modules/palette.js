// Command palette (Ctrl/Cmd + K): keyboard-first quick navigation using a native modal <dialog>.
import { setQuality, isEssential } from '../lib/quality.js';
import { toggleSound } from './sound.js';

export function initPalette({ lenis }) {
    // Not [data-palette]: that attribute sets colour themes on <body> and service links.
    const dialog = document.querySelector('[data-command-palette]');
    const input = dialog?.querySelector('[data-palette-input]');
    if (!dialog || !input) return;
    const options = [...dialog.querySelectorAll('[data-palette-option]')];
    const groups = [...dialog.querySelectorAll('.palette__group')];
    const empty = dialog.querySelector('[data-palette-empty]');
    let visible = options;
    let active = 0;
    let opener = null;

    const isMac = /Mac|iPhone|iPad/.test(navigator.platform);
    document.querySelectorAll('[data-shortcut-label]').forEach((el) => { el.textContent = isMac ? '⌘ K' : 'Ctrl K'; });

    const highlight = (i) => {
        active = (i + visible.length) % Math.max(visible.length, 1);
        options.forEach((o) => o.setAttribute('aria-selected', 'false'));
        const el = visible[active];
        if (el) {
            el.setAttribute('aria-selected', 'true');
            input.setAttribute('aria-activedescendant', el.id);
            el.scrollIntoView({ block: 'nearest' });
        } else {
            input.removeAttribute('aria-activedescendant');
        }
    };

    const filter = () => {
        const q = input.value.trim().toLowerCase();
        visible = options.filter((o) => {
            const match = !q || q.split(/\s+/).every((w) => o.dataset.keywords.includes(w));
            o.hidden = !match;
            return match;
        });
        groups.forEach((g) => { g.hidden = !g.querySelector('[data-palette-option]:not([hidden])'); });
        if (empty) empty.hidden = visible.length > 0;
        highlight(0);
    };

    const open = () => {
        if (dialog.open) return;
        opener = document.activeElement;
        input.value = '';
        filter();
        dialog.showModal();
        lenis?.stop();
        input.focus();
    };
    const close = () => dialog.open && dialog.close();

    const run = (el) => {
        if (!el) return;
        if (el.dataset.href) {
            // Sister-company websites open in a new tab, like their links elsewhere on the site.
            if (el.hasAttribute('data-external')) {
                close();
                window.open(el.dataset.href, '_blank', 'noopener');
            } else {
                window.location.href = el.dataset.href;
            }
            return;
        }
        close();
        if (el.dataset.action === 'effects') setQuality(isEssential() ? document.documentElement.dataset.qualityAuto : 'essential');
        if (el.dataset.action === 'sound') toggleSound();
    };

    dialog.addEventListener('close', () => {
        lenis?.start();
        opener?.focus?.();
    });
    dialog.addEventListener('click', (e) => {
        if (e.target === dialog) close();
        const option = e.target.closest('[data-palette-option]');
        if (option) run(option);
    });
    dialog.addEventListener('pointermove', (e) => {
        const option = e.target.closest('[data-palette-option]');
        if (option && !option.hidden) highlight(visible.indexOf(option));
    });
    input.addEventListener('input', filter);
    input.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowDown') { e.preventDefault(); highlight(active + 1); }
        if (e.key === 'ArrowUp') { e.preventDefault(); highlight(active - 1); }
        if (e.key === 'Enter') { e.preventDefault(); run(visible[active]); }
    });

    document.querySelectorAll('[data-palette-open]').forEach((b) => b.addEventListener('click', open));
    document.addEventListener('keydown', (e) => {
        if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            dialog.open ? close() : open();
        }
    });
}
