// Optional smooth scrolling. Disabled for the essential tier and reduced motion;
// anchors and keyboard scrolling keep working because Lenis drives native scroll.
import Lenis from 'lenis';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { isEssential } from '../lib/quality.js';
import { prefersReducedMotion } from '../lib/motion.js';

export function initSmooth() {
    if (isEssential() || prefersReducedMotion() || matchMedia('(pointer: coarse)').matches) return null;

    const lenis = new Lenis({
        duration: 1.05,
        smoothWheel: true,
        anchors: { offset: -80 },
        prevent: (node) => node.closest('dialog, .settings, .nav__overlay, .palette__list'),
    });
    lenis.on('scroll', ScrollTrigger.update);
    gsap.ticker.add((time) => lenis.raf(time * 1000));
    gsap.ticker.lagSmoothing(0);
    return lenis;
}

/** Scroll to an element or y position, with or without Lenis. */
export function scrollToTarget(lenis, target) {
    if (lenis) {
        lenis.scrollTo(target, { offset: -80 });
        return;
    }
    if (typeof target === 'number') window.scrollTo({ top: target, behavior: prefersReducedMotion() ? 'auto' : 'smooth' });
    else target.scrollIntoView({ behavior: prefersReducedMotion() ? 'auto' : 'smooth', block: 'start' });
}
