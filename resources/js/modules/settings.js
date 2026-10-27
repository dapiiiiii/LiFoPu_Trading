// Experience settings popover: visual quality tier, ambient sound, language.
import { getQuality, setQuality } from '../lib/quality.js';
import { setSound, soundOn } from './sound.js';

export function initSettings() {
    const panel = document.querySelector('[data-settings]');
    const button = document.querySelector('[data-settings-open]');
    if (!panel || !button) return;

    const radios = [...panel.querySelectorAll('[data-quality-option]')];
    radios.forEach((r) => {
        r.checked = r.value === getQuality();
        r.addEventListener('change', () => r.checked && setQuality(r.value));
    });

    // Sound is opt-in per visit: the remembered preference only pre-sets the switch.
    const toggle = panel.querySelector('[data-sound-toggle]');
    toggle.setAttribute('aria-checked', 'false');
    toggle.addEventListener('click', () => setSound(toggle.getAttribute('aria-checked') !== 'true'));
    if (soundOn()) toggle.dataset.remembered = 'on';

    const setOpen = (open) => {
        panel.hidden = !open;
        button.setAttribute('aria-expanded', String(open));
        if (open) panel.querySelector('input:checked, input, button')?.focus();
    };
    button.addEventListener('click', () => setOpen(panel.hidden));
    document.addEventListener('click', (e) => {
        if (!panel.hidden && !panel.contains(e.target) && !button.contains(e.target)) setOpen(false);
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !panel.hidden) {
            setOpen(false);
            button.focus();
        }
    });

    // Flash messages from the server (e.g. locale not yet available) surface as a toast.
    const toast = document.querySelector('[data-toast]');
    if (toast && toast.textContent.trim()) setTimeout(() => { toast.textContent = ''; }, 6000);
}
