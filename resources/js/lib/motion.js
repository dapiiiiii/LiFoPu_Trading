// Motion tokens. Keep in sync with the CSS custom properties in resources/css/tokens.css.
export const EASE = {
    out: 'expo.out',
    road: 'power3.inOut',
    portal: 'power4.inOut',
    soft: 'power2.out',
};

export const DUR = {
    ui: 0.18,
    move: 0.6,
    scene: 1.1,
    hero: 1.2,
};

export const DISTANCE = {
    reveal: 28,
    line: '110%',
};

export const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;
