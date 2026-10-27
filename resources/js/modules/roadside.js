// Capability roadside: four stops on one road. Pointer, tap and arrow keys travel between stops;
// all descriptions stay in the DOM and visible, the interaction only changes the scene.
export function initRoadside() {
    const root = document.querySelector('[data-roadside]');
    if (!root) return;

    const stops = [...root.querySelectorAll('[data-stop]')];
    const scenes = [...root.querySelectorAll('[data-scene]')];
    const captions = [...root.querySelectorAll('[data-caption]')];
    const vehicle = root.querySelector('[data-roadside-vehicle]');
    const links = stops.map((s) => s.querySelector('[data-stop-link]'));
    let current = null;

    const activate = (slug) => {
        if (slug === current) return;
        current = slug;
        const index = stops.findIndex((s) => s.dataset.stop === slug);
        stops.forEach((s) => s.toggleAttribute('data-active', s.dataset.stop === slug));
        scenes.forEach((s) => s.toggleAttribute('data-active', s.dataset.scene === slug));
        captions.forEach((c) => c.toggleAttribute('data-active', c.dataset.caption === slug));
        if (vehicle) {
            vehicle.style.left = `${((index + 0.5) / stops.length) * 100}%`;
            vehicle.style.color = getComputedStyle(stops[index]).getPropertyValue('--accent');
        }
        const scene = scenes[index]?.firstElementChild;
        scene?.dispatchEvent(new CustomEvent('lf:activate', { bubbles: true }));
        scenes.forEach((s, i) => i !== index && s.firstElementChild?.dispatchEvent(new CustomEvent('lf:deactivate')));
    };

    stops.forEach((stop, i) => {
        stop.addEventListener('pointerenter', (e) => e.pointerType === 'mouse' && activate(stop.dataset.stop));
        stop.addEventListener('focusin', () => activate(stop.dataset.stop));
        stop.addEventListener('click', (e) => {
            // First tap on touch selects the stop; the link itself still navigates.
            if (!e.target.closest('a')) activate(stop.dataset.stop);
        });
        links[i]?.addEventListener('keydown', (e) => {
            const map = { ArrowRight: 1, ArrowDown: 1, ArrowLeft: -1, ArrowUp: -1 };
            let next = null;
            if (e.key in map) next = (i + map[e.key] + links.length) % links.length;
            if (e.key === 'Home') next = 0;
            if (e.key === 'End') next = links.length - 1;
            if (next === null) return;
            e.preventDefault();
            links[next].focus();
        });
    });

    // Light the first stop once the section is in view.
    const io = new IntersectionObserver(([entry]) => {
        if (!entry.isIntersecting) return;
        current = null;
        activate(stops.find((s) => s.hasAttribute('data-active'))?.dataset.stop || stops[0].dataset.stop);
        io.disconnect();
    }, { threshold: 0.35 });
    io.observe(root);
}
