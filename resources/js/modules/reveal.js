// Scroll reveals: staggered fades for [data-reveal], masked line reveals for [data-split].
import { gsap } from 'gsap';
import { SplitText } from 'gsap/SplitText';
import { isEssential } from '../lib/quality.js';
import { EASE, prefersReducedMotion } from '../lib/motion.js';

export function initReveal() {
    if (isEssential()) return;
    const html = document.documentElement;
    html.classList.add('motion-ready');

    const items = [...document.querySelectorAll('[data-reveal]')];
    // Stagger siblings that enter together.
    items.forEach((el) => {
        const siblings = [...el.parentElement.children].filter((c) => c.hasAttribute('data-reveal'));
        el.style.setProperty('--reveal-delay', `${Math.min(siblings.indexOf(el), 6) * 90}ms`);
    });

    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-in');
            io.unobserve(entry.target);
        });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.05 });
    items.forEach((el) => io.observe(el));

    if (prefersReducedMotion()) return;

    // Line-by-line mask reveals for headings, after fonts load so lines split correctly.
    const splitAll = () => {
        document.querySelectorAll('[data-split]').forEach((el) => {
            if (el.closest('[data-hero]')) return;
            const split = SplitText.create(el, { type: 'lines', mask: 'lines', linesClass: 'split-line', autoSplit: true,
                onSplit(self) {
                    return gsap.from(self.lines, {
                        yPercent: 110,
                        duration: 1.1,
                        ease: EASE.out,
                        stagger: 0.09,
                        scrollTrigger: { trigger: el, start: 'top 88%', once: true },
                    });
                },
            });
            el.addEventListener('lf:unsplit', () => split.revert(), { once: true });
        });
    };
    if (document.fonts?.status === 'loaded') splitAll();
    else document.fonts?.ready.then(splitAll) ?? splitAll();
}
