// Adaptive quality tiers: cinematic (3D/video), enhanced (layered imagery), essential (static).
// The initial tier is chosen by the inline script in components/layout.blade.php.
const KEY = 'lf-quality';
const html = document.documentElement;

export const TIERS = ['cinematic', 'enhanced', 'essential'];

export const getQuality = () => html.dataset.quality || 'enhanced';
export const isCinematic = () => getQuality() === 'cinematic';
export const isEssential = () => getQuality() === 'essential';

export function setQuality(tier) {
    if (!TIERS.includes(tier)) return;
    try {
        if (tier === html.dataset.qualityAuto) localStorage.removeItem(KEY);
        else localStorage.setItem(KEY, tier);
    } catch {
        // Storage can be blocked; the choice then lasts for this page only.
    }
    html.dataset.quality = tier;
    // Modules initialise per tier, so a clean reload is the most reliable switch.
    window.location.reload();
}

let webgl;
export function hasWebGL() {
    if (webgl !== undefined) return webgl;
    try {
        const canvas = document.createElement('canvas');
        webgl = !!(canvas.getContext('webgl2') || canvas.getContext('webgl'));
    } catch {
        webgl = false;
    }
    return webgl;
}
