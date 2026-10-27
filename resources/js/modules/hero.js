// Dawn hero: the mark assembles, settles into the nav, the headline rises and the road awakens.
// Cinematic tier loads the real-time scene; enhanced uses layered poster parallax.
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { hasWebGL, isCinematic, isEssential } from '../lib/quality.js';
import { EASE, prefersReducedMotion } from '../lib/motion.js';

export function initHero() {
    const hero = document.querySelector('[data-hero]');
    if (!hero) {
        initPageHero();
        return;
    }

    const poster = hero.querySelector('.scene--dawn');
    if (isEssential()) {
        poster?.classList.add('is-drawn');
        return;
    }

    playIntro(hero, poster);

    if (isCinematic() && hasWebGL() && !prefersReducedMotion()) {
        loadScene(hero);
    } else {
        parallax(hero, poster);
    }
}

function playIntro(hero, poster) {
    const lines = hero.querySelectorAll('[data-hero-line] > span');
    const reveals = hero.querySelectorAll('[data-hero-reveal]');
    const mark = hero.querySelector('.hero__intro-mark');
    const pieces = mark ? [...mark.querySelectorAll('[data-mark]')] : [];
    const navLogo = document.querySelector('[data-nav-logo]');
    let firstVisit = true;
    try {
        firstVisit = !sessionStorage.getItem('lf-intro');
        sessionStorage.setItem('lf-intro', '1');
    } catch {
        // Ignore storage errors; play the full intro.
    }

    const tl = gsap.timeline({ defaults: { ease: EASE.out } });
    gsap.set(lines, { yPercent: 115 });
    gsap.set(reveals, { autoAlpha: 0, y: 24 });

    if (firstVisit && mark && navLogo) {
        // Each piece enters from its own direction, then the mark travels to the nav.
        // Offsets are in mark units (viewBox 661 × 572).
        const from = { body: { x: -520, y: 380, rotate: -14 }, long: { x: 380, y: -520, rotate: 10 }, mid: { x: 640, y: 180, rotate: 18 }, low: { x: 500, y: 520, rotate: -10 } };
        gsap.set(mark, { autoAlpha: 1 });
        gsap.set(navLogo, { autoAlpha: 0 });
        pieces.forEach((p) => gsap.set(p, { transformOrigin: '50% 50%', ...from[p.dataset.mark], autoAlpha: 0 }));
        tl.to(pieces, { x: 0, y: 0, rotate: 0, autoAlpha: 1, duration: 1.1, stagger: 0.08, ease: 'expo.out' })
            .add(() => {
                const a = mark.getBoundingClientRect();
                const b = navLogo.querySelector('.lf-logo__mark').getBoundingClientRect();
                gsap.to(mark, {
                    x: b.left + b.width / 2 - (a.left + a.width / 2),
                    y: b.top + b.height / 2 - (a.top + a.height / 2),
                    scale: b.width / a.width,
                    duration: 0.9,
                    ease: 'power4.inOut',
                    onComplete: () => {
                        gsap.set(navLogo, { autoAlpha: 1 });
                        gsap.to(mark, { autoAlpha: 0, duration: 0.2 });
                    },
                });
            }, '+=0.15')
            .to(lines, { yPercent: 0, duration: 1.2, stagger: 0.12 }, '-=0.1')
            .to(reveals, { autoAlpha: 1, y: 0, duration: 0.9, stagger: 0.1 }, '-=0.8');
    } else {
        tl.to(lines, { yPercent: 0, duration: 1.1, stagger: 0.1 }, 0.15)
            .to(reveals, { autoAlpha: 1, y: 0, duration: 0.8, stagger: 0.08 }, 0.45);
    }
    poster?.classList.add('is-drawn');

    // Never hold content hostage: any scroll or key finishes the intro instantly.
    const finish = () => {
        tl.progress(1);
        gsap.set(navLogo, { autoAlpha: 1 });
        if (mark) gsap.set(mark, { autoAlpha: 0 });
        window.removeEventListener('wheel', finish);
        window.removeEventListener('keydown', finish);
        window.removeEventListener('touchstart', finish);
    };
    window.addEventListener('wheel', finish, { passive: true, once: true });
    window.addEventListener('keydown', finish, { once: true });
    window.addEventListener('touchstart', finish, { passive: true, once: true });
}

async function loadScene(hero) {
    const canvas = hero.querySelector('[data-hero-canvas]');
    if (!canvas) return;
    let scene;
    try {
        const { createHeroScene } = await import('../three/heroScene.js');
        scene = createHeroScene(canvas);
    } catch (error) {
        console.warn('Hero 3D unavailable, keeping the poster.', error);
        parallax(hero, hero.querySelector('.scene--dawn'));
        return;
    }

    canvas.addEventListener('webglcontextlost', () => {
        hero.classList.remove('is-3d');
        scene.stop();
    });

    scene.start();
    scene.ready.then(() => hero.classList.add('is-3d'));

    hero.addEventListener('pointermove', (e) => {
        const r = hero.getBoundingClientRect();
        scene.setPointer((e.clientX - r.left) / r.width * 2 - 1, -((e.clientY - r.top) / r.height * 2 - 1));
    });

    ScrollTrigger.create({
        trigger: hero,
        start: 'top top',
        end: 'bottom top',
        onUpdate: (self) => scene.setScroll(self.progress),
        onToggle: (self) => (self.isActive ? scene.start() : scene.stop()),
    });
    document.addEventListener('visibilitychange', () => (document.hidden ? scene.stop() : ScrollTrigger.isInViewport(hero) && scene.start()));
}

function parallax(hero, poster) {
    if (!poster || prefersReducedMotion()) return;
    const layers = [...poster.querySelectorAll('[data-depth]')].map((el) => ({ el, depth: parseFloat(el.dataset.depth) }));
    const setters = layers.map(({ el }) => ({ x: gsap.quickTo(el, 'x', { duration: 1.2, ease: 'power3.out' }), y: gsap.quickTo(el, 'y', { duration: 1.2, ease: 'power3.out' }) }));
    let scroll = 0;
    let px = 0;
    let py = 0;
    const apply = () => layers.forEach(({ depth }, i) => {
        setters[i].x(px * depth * -60);
        setters[i].y(py * depth * -30 + scroll * depth * 220);
    });
    if (matchMedia('(pointer: fine)').matches) {
        hero.addEventListener('pointermove', (e) => {
            const r = hero.getBoundingClientRect();
            px = (e.clientX - r.left) / r.width - 0.5;
            py = (e.clientY - r.top) / r.height - 0.5;
            apply();
        });
    }
    ScrollTrigger.create({ trigger: hero, start: 'top top', end: 'bottom top', onUpdate: (self) => { scroll = self.progress; apply(); } });
}

function initPageHero() {
    const hero = document.querySelector('[data-page-hero]');
    if (!hero) return;
    const scene = hero.querySelector('[data-page-hero-scene] > *');
    requestAnimationFrame(() => scene?.classList.add('is-drawn'));
    if (isEssential() || prefersReducedMotion()) return;

    const content = hero.querySelectorAll('.page-hero__content > *:not(h1), .page-hero__caption');
    gsap.from(content, { autoAlpha: 0, y: 24, duration: 0.9, stagger: 0.08, ease: EASE.out, delay: 0.15 });
    gsap.to(hero.querySelector('[data-page-hero-scene]'), {
        yPercent: 12,
        scale: 1.06,
        ease: 'none',
        scrollTrigger: { trigger: hero, start: 'top top', end: 'bottom top', scrub: true },
    });
}
