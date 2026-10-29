// Material moments and scroll-linked stories: canopy lights, bean-to-market map, tanker route,
// road timeline, network focus, the org chart, the mark story, the values dial and the at-a-glance counters.
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { isEssential } from '../lib/quality.js';
import { prefersReducedMotion } from '../lib/motion.js';

export function initMoments() {
    scenes();
    timeline();
    network();
    org();
    markStory();
    values();
    route();
    counters();
}

function scenes() {
    const activate = (el) => {
        if (el.matches('[data-canopy]')) el.classList.add('is-lit');
        if (el.matches('[data-coffee]')) setTimeout(() => el.classList.add('is-map'), isEssential() ? 0 : 900);
        el.classList.add('is-drawn');
    };
    const deactivate = (el) => {
        if (el.matches('[data-coffee]')) el.classList.remove('is-map');
    };

    document.addEventListener('lf:activate', (e) => activate(e.target));
    document.addEventListener('lf:deactivate', (e) => deactivate(e.target), true);

    // Scenes outside the roadside play when they come into view.
    const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            activate(entry.target);
            io.unobserve(entry.target);
        });
    }, { threshold: 0.3 });
    document.querySelectorAll('[data-canopy], [data-coffee], .scene--tanker, .scene--topo, .scene--crossroads').forEach((el) => {
        if (!el.closest('[data-roadside]')) io.observe(el);
    });
}

function timeline() {
    document.querySelectorAll('[data-timeline]').forEach((root) => {
        const body = root.querySelector('.timeline__body');
        const draw = root.querySelector('[data-timeline-draw]');
        const milestones = [...root.querySelectorAll('[data-milestone]')];

        // Calendar toggle (radiogroup with arrow keys).
        const radios = [...root.querySelectorAll('[data-calendar]')];
        const setCalendar = (cal) => {
            radios.forEach((r) => {
                const on = r.dataset.calendar === cal;
                r.setAttribute('aria-checked', String(on));
                r.tabIndex = on ? 0 : -1;
            });
            root.querySelectorAll('[data-cal]').forEach((el) => { el.hidden = el.dataset.cal !== cal; });
        };
        radios.forEach((r, i) => {
            r.addEventListener('click', () => setCalendar(r.dataset.calendar));
            r.addEventListener('keydown', (e) => {
                if (!['ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown'].includes(e.key)) return;
                e.preventDefault();
                const next = radios[(i + 1) % radios.length];
                setCalendar(next.dataset.calendar);
                next.focus();
            });
        });
        setCalendar('gc');

        if (isEssential()) {
            milestones.forEach((m) => m.classList.add('is-reached'));
            return;
        }
        ScrollTrigger.create({
            trigger: body,
            start: 'top 70%',
            end: 'bottom 70%',
            onUpdate: (self) => draw.style.setProperty('--draw', self.progress.toFixed(4)),
        });
        milestones.forEach((m) => {
            ScrollTrigger.create({ trigger: m, start: 'top 70%', onEnter: () => m.classList.add('is-reached'), onLeaveBack: () => m.classList.remove('is-reached') });
        });
    });
}

function network() {
    document.querySelectorAll('[data-network]').forEach((root) => {
        const focus = (lane) => {
            root.toggleAttribute('data-focus', !!lane);
            root.querySelectorAll('[data-lane]').forEach((el) => el.toggleAttribute('data-lane-active', el.dataset.lane === lane));
        };
        root.querySelectorAll('.net__node').forEach((node) => {
            node.addEventListener('pointerenter', () => focus(node.dataset.lane));
            node.addEventListener('focus', () => focus(node.dataset.lane));
            node.addEventListener('pointerleave', () => focus(null));
            node.addEventListener('blur', () => focus(null));
        });
    });
}

function org() {
    document.querySelectorAll('[data-org]').forEach((root) => {
        const cards = [...root.querySelectorAll('[data-org-unit]')];
        // Light one function's road from the roundabout down to its card.
        const focus = (index) => {
            if (index === null) delete root.dataset.focus;
            else root.dataset.focus = index;
            root.querySelectorAll('[data-org-route]').forEach((el) => el.toggleAttribute('data-active', el.dataset.orgRoute === index));
            cards.forEach((card) => card.toggleAttribute('data-active', card.dataset.orgUnit === index));
        };
        cards.forEach((card) => {
            card.addEventListener('pointerenter', (e) => e.pointerType === 'mouse' && focus(card.dataset.orgUnit));
            // Leaving with the mouse falls back to whichever card holds keyboard focus.
            card.addEventListener('pointerleave', (e) => e.pointerType === 'mouse' && focus(cards.includes(document.activeElement) ? document.activeElement.dataset.orgUnit : null));
            card.addEventListener('focus', () => focus(card.dataset.orgUnit));
            card.addEventListener('blur', () => focus(null));
        });

        if (isEssential()) return;
        // Roads and cards draw in as they reach the viewport.
        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-drawn');
                io.unobserve(entry.target);
            });
        }, { rootMargin: '0px 0px -10% 0px', threshold: 0.15 });
        root.querySelectorAll('[data-org-draw]').forEach((el) => io.observe(el));
    });
}

function markStory() {
    const root = document.querySelector('[data-mark-story]');
    if (!root) return;
    const items = [...root.querySelectorAll('[data-mark-step]')];
    const set = (step) => {
        if (step === null) delete root.dataset.step;
        else root.dataset.step = step;
        items.forEach((li) => li.setAttribute('aria-current', String(li.dataset.markStep === step)));
    };
    items.forEach((li) => {
        li.addEventListener('pointerenter', () => set(li.dataset.markStep));
        li.addEventListener('focus', () => set(li.dataset.markStep));
        li.addEventListener('pointerleave', () => set(null));
        li.addEventListener('blur', () => set(null));
    });
}

function values() {
    const root = document.querySelector('[data-values]');
    if (!root) return;
    const rows = [...root.querySelectorAll('[data-value]')];
    const nodes = [...root.querySelectorAll('[data-value-node]')];
    const chords = [...root.querySelectorAll('[data-value-chord]')];
    const stage = root.querySelector('.values__stage');
    const num = root.querySelector('[data-values-num]');
    const needle = root.querySelector('.values__needle');
    const still = isEssential() || prefersReducedMotion();
    let active = 0;
    let turn = 0;

    const render = () => {
        root.style.setProperty('--turn', `${turn}deg`);
        rows.forEach((row, i) => row.toggleAttribute('data-active', i === active));
        nodes.forEach((node, i) => node.toggleAttribute('data-active', i === active));
        chords.forEach((line) => line.toggleAttribute('data-lit', line.dataset.valueChord.split(' ').includes(String(active))));
        num.textContent = String(active + 1).padStart(2, '0');
    };
    // The ring turns the short way round, so the chosen value always arrives under the pointer.
    const set = (index) => {
        if (index === active) return;
        let diff = index - active;
        if (diff > rows.length / 2) diff -= rows.length;
        if (diff < -rows.length / 2) diff += rows.length;
        turn -= diff * (360 / rows.length);
        active = index;
        render();
        if (still) return;
        num.animate([{ opacity: 0, transform: 'translateY(30%)' }, { opacity: 1, transform: 'none' }], { duration: 600, easing: 'cubic-bezier(.16, 1, .3, 1)' });
        needle.animate([{ strokeDashoffset: 1 }, { strokeDashoffset: 0 }], { duration: 700, delay: 600, easing: 'cubic-bezier(.16, 1, .3, 1)', fill: 'backwards' });
    };

    rows.forEach((row, i) => {
        row.addEventListener('pointerenter', (e) => e.pointerType === 'mouse' && set(i));
        row.addEventListener('focus', () => set(i));
        row.addEventListener('click', () => set(i));
    });
    nodes.forEach((node, i) => node.addEventListener('click', () => set(i)));

    root.dataset.valuesReady = '';
    render();

    if (still) {
        stage.classList.add('is-lit');
        return;
    }
    // The star draws and the ring rolls into place when the dial comes into view.
    const io = new IntersectionObserver(([entry]) => {
        if (!entry.isIntersecting) return;
        stage.classList.add('is-lit');
        io.disconnect();
    }, { threshold: 0.35 });
    io.observe(stage);
}

function route() {
    const root = document.querySelector('[data-route]');
    if (!root) return;
    const path = root.querySelector('#route-road');
    const progress = root.querySelector('[data-route-progress]');
    const tanker = root.querySelector('[data-route-tanker]');
    const length = path.getTotalLength();

    const place = (p) => {
        const at = Math.max(0.001, Math.min(0.999, p));
        const pt = path.getPointAtLength(at * length);
        const ahead = path.getPointAtLength(Math.min(length, at * length + 4));
        const angle = Math.atan2(ahead.y - pt.y, ahead.x - pt.x) * (180 / Math.PI);
        tanker.setAttribute('transform', `translate(${pt.x.toFixed(1)} ${pt.y.toFixed(1)}) rotate(${angle.toFixed(1)})`);
        progress.style.setProperty('--route', p.toFixed(4));
    };

    if (isEssential() || prefersReducedMotion()) {
        place(1);
        return;
    }
    place(0);
    ScrollTrigger.create({
        trigger: root,
        start: 'top 75%',
        end: 'bottom 35%',
        scrub: 0.6,
        onUpdate: (self) => place(self.progress),
    });
}

function counters() {
    if (isEssential() || prefersReducedMotion()) return;
    document.querySelectorAll('[data-count]').forEach((el) => {
        const target = parseFloat(el.dataset.count);
        if (!Number.isFinite(target) || target >= 1900) return; // years are not counters
        const decimals = parseInt(el.dataset.decimals || '0', 10);
        const format = (v) => `${el.dataset.prefix || ''}${v.toFixed(decimals)}${el.dataset.suffix || ''}`;
        const final = el.textContent;
        const state = { v: 0 };
        // Screen readers get the real figure, never the animating one.
        const sr = document.createElement('span');
        sr.className = 'sr-only';
        sr.textContent = final;
        el.after(sr);
        el.setAttribute('aria-hidden', 'true');
        el.textContent = format(0);
        ScrollTrigger.create({
            trigger: el,
            start: 'top 85%',
            once: true,
            onEnter: () => gsap.to(state, {
                v: target,
                duration: 1.6,
                ease: 'power3.out',
                onUpdate: () => { el.textContent = format(state.v); },
                onComplete: () => { el.textContent = final; },
            }),
        });
    });
}
