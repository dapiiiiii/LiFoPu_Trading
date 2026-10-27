// The brand pattern drifts gently with the pointer — footer and final CTA only.
import { isEssential } from '../lib/quality.js';
import { prefersReducedMotion } from '../lib/motion.js';

export function initPattern() {
    if (isEssential() || prefersReducedMotion() || !matchMedia('(pointer: fine)').matches) return;

    document.querySelectorAll('[data-pattern-zone]').forEach((zone) => {
        const svg = zone.querySelector('[data-pattern-shift]');
        const pattern = svg?.querySelector('pattern');
        if (!pattern) return;
        const scale = parseFloat(pattern.dataset.scale || '0.05');
        let x = 0;
        let y = 0;
        let tx = 0;
        let ty = 0;
        let raf = 0;

        const tick = () => {
            x += (tx - x) * 0.06;
            y += (ty - y) * 0.06;
            pattern.setAttribute('patternTransform', `translate(${x.toFixed(2)} ${y.toFixed(2)}) scale(${scale})`);
            raf = Math.abs(tx - x) + Math.abs(ty - y) > 0.05 ? requestAnimationFrame(tick) : 0;
        };
        zone.addEventListener('pointermove', (e) => {
            const r = zone.getBoundingClientRect();
            tx = ((e.clientX - r.left) / r.width - 0.5) * -28;
            ty = ((e.clientY - r.top) / r.height - 0.5) * -18;
            if (!raf) raf = requestAnimationFrame(tick);
        });
        zone.addEventListener('pointerleave', () => {
            tx = 0;
            ty = 0;
            if (!raf) raf = requestAnimationFrame(tick);
        });
    });
}
