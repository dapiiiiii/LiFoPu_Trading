// Road-line scroll spine: progress, section markers and the triangle "vehicle".
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { scrollToTarget } from './smooth.js';

export function initSpine({ lenis }) {
    const spine = document.querySelector('[data-spine]');
    const list = spine?.querySelector('[data-spine-list]');
    if (!spine || !list) return;

    const seen = new Set();
    const sections = [...document.querySelectorAll('main [data-spine-label]')].filter((s) => {
        const label = s.dataset.spineLabel;
        if (!label || seen.has(label)) return false;
        seen.add(label);
        return true;
    });
    if (sections.length < 3) return;

    const stops = sections.map((section, i) => {
        const li = document.createElement('li');
        li.className = 'spine__stop';
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'spine__btn';
        btn.innerHTML = `<span class="spine__label">${section.dataset.spineLabel}</span>`;
        btn.setAttribute('aria-label', `${i + 1}. ${section.dataset.spineLabel}`);
        btn.addEventListener('click', () => {
            scrollToTarget(lenis, section);
            section.setAttribute('tabindex', '-1');
            section.focus({ preventScroll: true });
        });
        li.append(btn);
        list.append(li);
        return { section, li, btn };
    });

    const layout = () => {
        const max = document.documentElement.scrollHeight - window.innerHeight;
        stops.forEach(({ section, li }) => {
            const top = section.getBoundingClientRect().top + window.scrollY;
            li.style.top = `${Math.min(100, Math.max(0, (top / Math.max(max, 1)) * 100))}%`;
        });
    };

    const update = () => {
        const max = document.documentElement.scrollHeight - window.innerHeight;
        const p = Math.min(1, Math.max(0, window.scrollY / Math.max(max, 1)));
        spine.style.setProperty('--progress', p.toFixed(4));
        const mid = window.innerHeight * 0.45;
        let active = stops[0];
        stops.forEach((stop) => {
            if (stop.section.getBoundingClientRect().top <= mid) active = stop;
        });
        stops.forEach((stop) => stop.btn.setAttribute('aria-current', String(stop === active)));
    };

    spine.hidden = false;
    layout();
    update();
    window.addEventListener('scroll', update, { passive: true });
    ScrollTrigger.addEventListener('refresh', () => { layout(); update(); });
    window.addEventListener('resize', layout);
}
