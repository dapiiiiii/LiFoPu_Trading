// Opt-in ambient sound: a low engine hum and soft wind, synthesised with Web Audio.
// Muted by default, never autoplays, remembered per browser.
const KEY = 'lf-sound';
let audio = null;

function build() {
    const ctx = new (window.AudioContext || window.webkitAudioContext)();
    const master = ctx.createGain();
    master.gain.value = 0;
    master.connect(ctx.destination);

    // Engine: two detuned low oscillators with a slow throttle wobble.
    const engine = ctx.createGain();
    engine.gain.value = 0.16;
    const lowpass = ctx.createBiquadFilter();
    lowpass.type = 'lowpass';
    lowpass.frequency.value = 180;
    [46, 46.7, 92.4].forEach((f, i) => {
        const osc = ctx.createOscillator();
        osc.type = i === 2 ? 'triangle' : 'sawtooth';
        osc.frequency.value = f;
        const g = ctx.createGain();
        g.gain.value = i === 2 ? 0.25 : 0.5;
        osc.connect(g).connect(lowpass);
        osc.start();
    });
    const lfo = ctx.createOscillator();
    lfo.frequency.value = 0.18;
    const lfoGain = ctx.createGain();
    lfoGain.gain.value = 0.04;
    lfo.connect(lfoGain).connect(engine.gain);
    lfo.start();
    lowpass.connect(engine).connect(master);

    // Wind: filtered noise with a slow gust envelope.
    const buffer = ctx.createBuffer(1, ctx.sampleRate * 3, ctx.sampleRate);
    const data = buffer.getChannelData(0);
    let last = 0;
    for (let i = 0; i < data.length; i++) {
        last = (last + 0.02 * (Math.random() * 2 - 1)) / 1.02; // brown noise
        data[i] = last * 3.5;
    }
    const noise = ctx.createBufferSource();
    noise.buffer = buffer;
    noise.loop = true;
    const band = ctx.createBiquadFilter();
    band.type = 'bandpass';
    band.frequency.value = 420;
    band.Q.value = 0.6;
    const wind = ctx.createGain();
    wind.gain.value = 0.22;
    const gust = ctx.createOscillator();
    gust.frequency.value = 0.07;
    const gustGain = ctx.createGain();
    gustGain.gain.value = 0.12;
    gust.connect(gustGain).connect(wind.gain);
    gust.start();
    noise.connect(band).connect(wind).connect(master);
    noise.start();

    return { ctx, master };
}

export const soundOn = () => {
    try { return localStorage.getItem(KEY) === 'on'; } catch { return false; }
};

export function setSound(on) {
    try { localStorage.setItem(KEY, on ? 'on' : 'off'); } catch { /* storage blocked */ }
    if (on && !audio) audio = build();
    if (audio) {
        const { ctx, master } = audio;
        if (on) ctx.resume();
        master.gain.cancelScheduledValues(ctx.currentTime);
        master.gain.setTargetAtTime(on ? 0.35 : 0, ctx.currentTime, 0.6);
        if (!on) setTimeout(() => !soundOn() && ctx.suspend(), 2500);
    }
    document.querySelectorAll('[data-sound-toggle]').forEach((b) => b.setAttribute('aria-checked', String(on)));
    window.dispatchEvent(new CustomEvent('lf:sound', { detail: on }));
}

export const toggleSound = () => setSound(!(audio && soundOn()));
