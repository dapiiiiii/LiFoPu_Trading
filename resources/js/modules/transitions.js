// Triangle portal page transitions use cross-document View Transitions (see motion.css).
// Here we only opt out for the essential tier; unsupported browsers simply navigate.
import { isEssential } from '../lib/quality.js';

export function initTransitions() {
    window.addEventListener('pageswap', (e) => {
        if (e.viewTransition && isEssential()) e.viewTransition.skipTransition();
    });
    window.addEventListener('pagereveal', (e) => {
        if (e.viewTransition && isEssential()) e.viewTransition.skipTransition();
    });
}
