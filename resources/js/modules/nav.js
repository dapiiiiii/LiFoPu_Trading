// Navigation: solid-after-scroll, hide on scroll down, accessible dropdown, full-screen mobile menu.
export function initNav({ lenis }) {
    const nav = document.querySelector('[data-nav]');
    if (!nav) return;

    const hasDarkHero = !!document.querySelector('[data-hero], [data-page-hero]');
    let lastY = window.scrollY;

    const onScroll = () => {
        const y = window.scrollY;
        nav.classList.toggle('is-solid', !hasDarkHero || y > 24);
        nav.classList.toggle('is-hidden', y > 480 && y > lastY + 4 && !nav.classList.contains('is-open'));
        if (y < lastY - 4 || y < 480) nav.classList.remove('is-hidden');
        lastY = y;
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    // --- Dropdown ---
    nav.querySelectorAll('[data-dropdown]').forEach((item) => {
        const toggle = item.querySelector('[data-dropdown-toggle]');
        const panel = item.querySelector('[data-dropdown-panel]');
        let timer;
        const set = (open) => {
            toggle.setAttribute('aria-expanded', String(open));
            panel.hidden = !open;
        };
        toggle.addEventListener('click', () => set(panel.hidden));
        item.addEventListener('pointerenter', (e) => {
            if (e.pointerType !== 'mouse') return;
            clearTimeout(timer);
            set(true);
        });
        item.addEventListener('pointerleave', (e) => {
            if (e.pointerType !== 'mouse') return;
            timer = setTimeout(() => set(false), 220);
        });
        item.addEventListener('focusout', (e) => {
            if (!item.contains(e.relatedTarget)) set(false);
        });
        item.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !panel.hidden) {
                set(false);
                toggle.focus();
            }
        });
    });

    // --- Mobile overlay ---
    const burger = nav.querySelector('[data-menu-toggle]');
    const overlay = nav.querySelector('[data-menu]');
    const label = nav.querySelector('[data-menu-label]');
    if (!burger || !overlay) return;

    const focusables = () => [burger, ...overlay.querySelectorAll('a[href], button')];
    const setMenu = (open) => {
        burger.setAttribute('aria-expanded', String(open));
        label.textContent = open ? label.dataset.close : label.dataset.open;
        overlay.hidden = !open;
        nav.classList.toggle('is-open', open);
        nav.classList.add('is-solid');
        document.documentElement.style.overflow = open ? 'hidden' : '';
        if (open) {
            lenis?.stop();
            overlay.querySelector('a')?.focus();
        } else {
            lenis?.start();
            onScroll();
        }
    };
    burger.addEventListener('click', () => setMenu(overlay.hidden));
    overlay.addEventListener('click', (e) => {
        if (e.target.closest('a')) setMenu(false);
    });
    document.addEventListener('keydown', (e) => {
        if (overlay.hidden) return;
        if (e.key === 'Escape') {
            setMenu(false);
            burger.focus();
        }
        if (e.key === 'Tab') {
            const items = focusables();
            const first = items[0];
            const last = items[items.length - 1];
            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        }
    });
    matchMedia('(min-width: 1024px)').addEventListener('change', (e) => {
        if (e.matches && !overlay.hidden) setMenu(false);
    });
}
