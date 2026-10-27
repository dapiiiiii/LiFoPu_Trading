// Day-to-dusk arc: each section blends from the previous section's sky into its own,
// and its light source travels with scroll progress (--p). Text colours never change,
// so contrast stays at the verified values for every stage.
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { isEssential } from '../lib/quality.js';

const luminance = (color) => {
    const m = color.match(/^#?([0-9a-f]{6})$/i);
    if (!m) return null;
    const [r, g, b] = [0, 2, 4].map((i) => parseInt(m[1].slice(i, i + 2), 16) / 255)
        .map((c) => (c <= 0.03928 ? c / 12.92 : ((c + 0.055) / 1.055) ** 2.4));
    return 0.2126 * r + 0.7152 * g + 0.0722 * b;
};

export function initSky() {
    const sections = [...document.querySelectorAll('main > section, main > nav, .footer')];
    let prevBottom = '#0d0c0b';

    sections.forEach((section) => {
        const style = getComputedStyle(section);
        const top = style.getPropertyValue('--sky-top').trim();
        const bottom = style.getPropertyValue('--sky-bottom').trim();
        if (section.classList.contains('section') && top) {
            // Blend only between skies of similar brightness; light/dark changes cut cleanly.
            const a = luminance(prevBottom);
            const b = luminance(top);
            if (a !== null && b !== null && Math.abs(a - b) < 0.35) section.style.setProperty('--sky-prev', prevBottom);
        }
        prevBottom = section.matches('.section, .cta') && bottom ? bottom : '#0d0c0b';
    });

    if (isEssential()) return;

    document.querySelectorAll('.section, .cta').forEach((section) => {
        ScrollTrigger.create({
            trigger: section,
            start: 'top bottom',
            end: 'bottom top',
            onUpdate: (self) => section.style.setProperty('--p', self.progress.toFixed(3)),
        });
    });
}
