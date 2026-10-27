import 'lenis/dist/lenis.css';
import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { SplitText } from 'gsap/SplitText';

import { initSmooth } from './modules/smooth.js';
import { initNav } from './modules/nav.js';
import { initReveal } from './modules/reveal.js';
import { initSky } from './modules/sky.js';
import { initSpine } from './modules/spine.js';
import { initHero } from './modules/hero.js';
import { initRoadside } from './modules/roadside.js';
import { initMoments } from './modules/moments.js';
import { initOil } from './modules/oil.js';
import { initPalette } from './modules/palette.js';
import { initSettings } from './modules/settings.js';
import { initInquiry } from './modules/inquiry.js';
import { initPattern } from './modules/pattern.js';
import { initTransitions } from './modules/transitions.js';

gsap.registerPlugin(ScrollTrigger, SplitText);

function boot() {
    const lenis = initSmooth();
    const ctx = { lenis };

    initTransitions();
    initNav(ctx);
    initPalette(ctx);
    initSettings(ctx);
    initSky();
    initReveal();
    initHero();
    initRoadside();
    initMoments();
    initOil();
    initSpine(ctx);
    initInquiry();
    initPattern();

    // Fonts change line lengths; re-measure scroll positions once they settle.
    document.fonts?.ready.then(() => ScrollTrigger.refresh());
}

if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot);
else boot();
