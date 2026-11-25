// Light and dark themes. The choice is set before first paint (layout head script);
// this wires the nav button and the mobile switch, remembers the choice and re-blends the skies.
import { blendSkies } from './sky.js';

const KEY = 'lf-theme';

export const currentTheme = () => (document.documentElement.dataset.theme === 'dark' ? 'dark' : 'light');

function sync() {
    const theme = currentTheme();
    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.setAttribute('aria-label', theme === 'dark' ? button.dataset.labelLight : button.dataset.labelDark);
    });
    document.querySelectorAll('[data-theme-set]').forEach((button) => {
        button.setAttribute('aria-checked', String(button.dataset.themeSet === theme));
    });
    const meta = document.querySelector('meta[name="theme-color"]');
    if (meta) meta.content = theme === 'dark' ? '#0d0c0b' : '#fbf9f5';
}

export function setTheme(theme) {
    const root = document.documentElement;
    if (theme === currentTheme()) return;

    // Cross-fade the switch, but never animate the very first paint.
    const reduce = matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!reduce) {
        root.classList.add('theme-fading');
        setTimeout(() => root.classList.remove('theme-fading'), 700);
    }

    root.dataset.theme = theme;
    try { localStorage.setItem(KEY, theme); } catch (e) { /* private mode: the choice lasts for this page only */ }
    sync();
    blendSkies();
    window.dispatchEvent(new CustomEvent('lf:theme', { detail: { theme } }));
}

export function initTheme() {
    sync();
    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.addEventListener('click', () => setTheme(currentTheme() === 'dark' ? 'light' : 'dark'));
    });
    document.querySelectorAll('[data-theme-set]').forEach((button) => {
        button.addEventListener('click', () => setTheme(button.dataset.themeSet));
    });
}
