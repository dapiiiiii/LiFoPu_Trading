// Lubricant ribbon: a slow, viscous Gold Flame ribbon that bends toward the pointer with weight and drag.
// Raw WebGL so it costs a few kilobytes; the SVG ribbon stays as the fallback.
import { hasWebGL, isEssential } from '../lib/quality.js';
import { prefersReducedMotion } from '../lib/motion.js';

const VERT = `attribute vec2 p; void main(){ gl_Position = vec4(p, 0.0, 1.0); }`;

const FRAG = `
precision highp float;
uniform vec2 uRes;
uniform float uTime;
uniform vec2 uPointer;
uniform float uPull;

float hash(vec2 p){ return fract(sin(dot(p, vec2(41.3, 289.1))) * 43758.5453); }
float noise(vec2 p){
    vec2 i = floor(p), f = fract(p);
    vec2 u = f * f * (3.0 - 2.0 * f);
    return mix(mix(hash(i), hash(i + vec2(1, 0)), u.x), mix(hash(i + vec2(0, 1)), hash(i + vec2(1, 1)), u.x), u.y);
}

// Ribbon centre line, bent toward the pointer.
float centre(float x, float t){
    float y = 0.08 * sin(x * 2.2 + t * 0.35) + 0.05 * sin(x * 4.7 - t * 0.5) + 0.03 * sin(x * 9.0 + t * 0.8);
    float d = x - uPointer.x;
    y += (uPointer.y - y) * uPull * exp(-d * d * 6.0) * 0.55;
    return y;
}

void main(){
    vec2 uv = (gl_FragCoord.xy - 0.5 * uRes) / uRes.y;
    float t = uTime;
    float c = centre(uv.x, t);
    float width = 0.13 + 0.03 * sin(uv.x * 3.0 + t * 0.4);
    float v = (uv.y - c) / width; // -1..1 across the ribbon
    vec3 bg = mix(vec3(0.043, 0.031, 0.02), vec3(0.11, 0.075, 0.035), smoothstep(-0.8, 0.6, -length(uv - vec2(0.0, 0.05))));
    float inside = 1.0 - smoothstep(0.92, 1.0, abs(v));
    // Cylindrical normal across the ribbon.
    float nz = sqrt(max(0.0, 1.0 - v * v));
    vec3 n = normalize(vec3(0.0, v, nz));
    float flow = noise(vec2(uv.x * 6.0 - t * 0.6, v * 2.0)) * 0.6 + noise(vec2(uv.x * 18.0 - t * 1.2, v * 5.0)) * 0.4;
    vec3 L = normalize(vec3(-0.3, 0.7, 0.6));
    float diff = max(dot(n, L), 0.0);
    float spec = pow(max(dot(reflect(-L, n), vec3(0.0, 0.0, 1.0)), 0.0), 40.0);
    vec3 deep = vec3(0.16, 0.08, 0.01);
    vec3 gold = vec3(0.78, 0.6, 0.13);   // Gold Flame #C69822
    vec3 amber = vec3(0.9, 0.55, 0.12);
    vec3 col = mix(deep, mix(gold, amber, flow), pow(nz, 0.8) * (0.55 + diff * 0.6));
    col += vec3(1.0, 0.93, 0.75) * spec * (0.7 + flow * 0.6);
    col += vec3(1.0, 0.85, 0.5) * pow(1.0 - abs(v), 12.0) * 0.08;
    float shadow = exp(-pow((uv.y - c + width * 1.6) / (width * 0.9), 2.0)) * 0.35;
    bg *= 1.0 - shadow;
    gl_FragColor = vec4(mix(bg, col, inside), 1.0);
}`;

export function initOil() {
    const scenes = document.querySelectorAll('[data-oil]');
    if (!scenes.length || isEssential() || !hasWebGL() || prefersReducedMotion()) return;
    scenes.forEach(setup);
}

function setup(root) {
    const canvas = root.querySelector('[data-oil-canvas]');
    const gl = canvas.getContext('webgl', { antialias: false, premultipliedAlpha: false });
    if (!gl) return;

    const compile = (type, src) => {
        const s = gl.createShader(type);
        gl.shaderSource(s, src);
        gl.compileShader(s);
        return s;
    };
    const prog = gl.createProgram();
    gl.attachShader(prog, compile(gl.VERTEX_SHADER, VERT));
    gl.attachShader(prog, compile(gl.FRAGMENT_SHADER, FRAG));
    gl.linkProgram(prog);
    if (!gl.getProgramParameter(prog, gl.LINK_STATUS)) return;
    gl.useProgram(prog);

    const buf = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, buf);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 3, -1, -1, 3]), gl.STATIC_DRAW);
    const loc = gl.getAttribLocation(prog, 'p');
    gl.enableVertexAttribArray(loc);
    gl.vertexAttribPointer(loc, 2, gl.FLOAT, false, 0, 0);

    const u = {
        res: gl.getUniformLocation(prog, 'uRes'),
        time: gl.getUniformLocation(prog, 'uTime'),
        pointer: gl.getUniformLocation(prog, 'uPointer'),
        pull: gl.getUniformLocation(prog, 'uPull'),
    };

    // Spring physics: the ribbon follows with weight, then relaxes.
    const pointer = { x: 0, y: 0, tx: 0, ty: 0, pull: 0, tpull: 0, vx: 0, vy: 0 };
    let running = false;
    let raf = 0;
    let last = 0;
    let time = 0;

    const resize = () => {
        const dpr = Math.min(window.devicePixelRatio, 1.5);
        canvas.width = Math.round(canvas.clientWidth * dpr);
        canvas.height = Math.round(canvas.clientHeight * dpr);
        gl.viewport(0, 0, canvas.width, canvas.height);
    };

    const frame = (now) => {
        raf = requestAnimationFrame(frame);
        const dt = Math.min((now - (last || now)) / 1000, 0.05);
        last = now;
        time += dt;
        const k = 18;
        const damping = 7;
        pointer.vx += ((pointer.tx - pointer.x) * k - pointer.vx * damping) * dt;
        pointer.vy += ((pointer.ty - pointer.y) * k - pointer.vy * damping) * dt;
        pointer.x += pointer.vx * dt;
        pointer.y += pointer.vy * dt;
        pointer.pull += (pointer.tpull - pointer.pull) * Math.min(1, dt * 2.5);
        gl.uniform2f(u.res, canvas.width, canvas.height);
        gl.uniform1f(u.time, time);
        gl.uniform2f(u.pointer, pointer.x, pointer.y);
        gl.uniform1f(u.pull, pointer.pull);
        gl.drawArrays(gl.TRIANGLES, 0, 3);
    };

    const start = () => {
        if (running) return;
        running = true;
        last = 0;
        raf = requestAnimationFrame(frame);
        root.classList.add('is-live');
    };
    const stop = () => {
        running = false;
        cancelAnimationFrame(raf);
    };

    const host = root.closest('.page-hero, .roadside__frame, section') || root;
    host.addEventListener('pointermove', (e) => {
        const r = canvas.getBoundingClientRect();
        pointer.tx = (e.clientX - r.left - r.width / 2) / r.height;
        pointer.ty = -(e.clientY - r.top - r.height / 2) / r.height;
        pointer.tpull = 1;
    });
    host.addEventListener('pointerleave', () => { pointer.tpull = 0; });

    resize();
    new ResizeObserver(resize).observe(canvas);
    new IntersectionObserver(([entry]) => (entry.isIntersecting ? start() : stop())).observe(root);
    document.addEventListener('visibilitychange', () => document.hidden && stop());
}
