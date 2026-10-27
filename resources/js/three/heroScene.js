// "The Road Awakens": real-time dawn highway for the cinematic tier.
// Camera matches the SVG poster (38° FOV, eye 1.7 m in the left lane, horizon at 62%), so the
// tanker sits to the right of the headline.
import * as THREE from 'three';
import { NOISE } from './noise.glsl.js';
import { createTanker } from './tanker.js';

const SPEED = 15; // m/s of apparent travel
const FOG = { near: 40, far: 620 };

const PALETTES = {
    dawn: { top: '#0b1230', mid: '#4b4038', low: '#d9733a', horizon: '#f7b366', sun: '#fff0cf', elevation: 0.012 },
    morning: { top: '#25416e', mid: '#9a8a7c', low: '#f0b27a', horizon: '#f9d5a4', sun: '#fff6e2', elevation: 0.05 },
};

const lerpColor = (a, b, t) => new THREE.Color(a).lerp(new THREE.Color(b), t);

export function createHeroScene(canvas) {
    const renderer = new THREE.WebGLRenderer({ canvas, antialias: true, powerPreference: 'high-performance' });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.6));
    renderer.outputColorSpace = THREE.SRGBColorSpace;
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 0.6;
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFShadowMap;

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(38, 16 / 9, 0.1, 2000);
    const base = new THREE.Vector3(-2.0, 1.7, 0);
    const look = new THREE.Vector3();

    const uniforms = {
        uTime: { value: 0 },
        uOffset: { value: 0 },
        uRoute: { value: 0 },
        uSunDir: { value: new THREE.Vector3() },
        uSunColor: { value: new THREE.Color() },
        uTop: { value: new THREE.Color() },
        uMid: { value: new THREE.Color() },
        uLow: { value: new THREE.Color() },
        uHorizon: { value: new THREE.Color() },
        uFogNear: { value: FOG.near },
        uFogFar: { value: FOG.far },
    };

    // --- Sky dome ---
    const sky = new THREE.Mesh(
        new THREE.SphereGeometry(900, 48, 24),
        new THREE.ShaderMaterial({
            uniforms,
            side: THREE.BackSide,
            depthWrite: false,
            vertexShader: /* glsl */ `
                varying vec3 vDir;
                void main() {
                    vDir = normalize(position);
                    gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
                }`,
            fragmentShader: /* glsl */ `
                uniform vec3 uTop, uMid, uLow, uHorizon, uSunColor, uSunDir;
                varying vec3 vDir;
                void main() {
                    vec3 d = normalize(vDir);
                    float h = d.y;
                    vec3 col = mix(uHorizon, uLow, smoothstep(0.0, 0.05, h));
                    col = mix(col, uMid, smoothstep(0.04, 0.18, h));
                    col = mix(col, uTop, smoothstep(0.16, 0.6, h));
                    col = mix(uHorizon * 0.85, col, smoothstep(-0.04, 0.0, h));
                    float s = max(dot(d, normalize(uSunDir)), 0.0);
                    col += uSunColor * (pow(s, 2400.0) * 18.0 + pow(s, 90.0) * 0.9 + pow(s, 8.0) * 0.28);
                    col = mix(col, uHorizon * 1.08, exp(-abs(h) * 22.0) * 0.35);
                    gl_FragColor = vec4(col, 1.0);
                    #include <tonemapping_fragment>
                    #include <colorspace_fragment>
                }`,
        }),
    );
    scene.add(sky);

    // --- Distant amba silhouettes ---
    const ridgeMaterial = (seed, plateau, color, haze) => new THREE.ShaderMaterial({
        uniforms: { ...uniforms, uSeed: { value: seed }, uPlateau: { value: plateau }, uColor: { value: new THREE.Color(color) }, uHaze: { value: haze } },
        transparent: true,
        depthWrite: false,
        vertexShader: /* glsl */ `varying vec2 vUv; void main() { vUv = uv; gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0); }`,
        fragmentShader: /* glsl */ `
            uniform float uSeed, uPlateau, uHaze;
            uniform vec3 uColor, uHorizon;
            varying vec2 vUv;
            ${NOISE}
            void main() {
                float x = vUv.x * 7.0 + uSeed;
                float h = 0.32 + fbm(vec2(x, uSeed)) * 0.38 + snoise(vec2(x * 4.0, uSeed)) * 0.03;
                float top = uPlateau + 0.04 * snoise(vec2(x * 0.6, uSeed * 3.0));
                h = h > top ? top + (h - top) * 0.08 : h; // flat-topped ambas
                float a = 1.0 - smoothstep(h - 0.003, h + 0.003, vUv.y);
                if (a < 0.01) discard;
                vec3 col = mix(uColor, uHorizon, uHaze * (1.0 - vUv.y * 0.4));
                gl_FragColor = vec4(col, a);
                #include <tonemapping_fragment>
                #include <colorspace_fragment>
            }`,
    });
    [[-870, 4.2, 0.62, '#c98a5c', 0.55], [-770, 9.7, 0.55, '#8e4d2c', 0.32], [-670, 17.3, 0.46, '#5a2c19', 0.18]].forEach(([z, seed, plateau, color, haze]) => {
        const ridge = new THREE.Mesh(new THREE.PlaneGeometry(2600, 110), ridgeMaterial(seed, plateau, color, haze));
        ridge.position.set(0, 42, z);
        ridge.renderOrder = -1;
        scene.add(ridge);
    });

    // --- Terrain: highland relief that scrolls under the road ---
    const terrainGeo = new THREE.PlaneGeometry(1300, 720, 170, 120).rotateX(-Math.PI / 2).translate(0, 0, -260);
    const terrain = new THREE.Mesh(terrainGeo, new THREE.ShaderMaterial({
        uniforms,
        vertexShader: /* glsl */ `
            uniform float uOffset;
            varying vec3 vWorld;
            varying vec3 vN;
            varying float vH;
            ${NOISE}
            float heightAt(vec2 xz) {
                float d = abs(xz.x);
                float shoulder = smoothstep(8.0, 46.0, d);
                float hills = fbm(xz * 0.007) * 22.0 + fbm(xz * 0.03) * 4.0;
                float rise = smoothstep(60.0, 520.0, d) * (40.0 + 30.0 * fbm(xz * 0.002));
                float h = max(hills + rise, -1.5) * shoulder;
                return h > 30.0 ? 30.0 + (h - 30.0) * 0.12 : h; // flat-topped ambas
            }
            void main() {
                vec3 p = position;
                vec2 xz = vec2(p.x, p.z - uOffset);
                float h = heightAt(xz);
                float e = 3.0;
                float hx = heightAt(xz + vec2(e, 0.0)) - heightAt(xz - vec2(e, 0.0));
                float hz = heightAt(xz + vec2(0.0, e)) - heightAt(xz - vec2(0.0, e));
                vN = normalize(vec3(-hx, 2.0 * e, -hz));
                p.y = h - 0.06;
                vec4 w = modelMatrix * vec4(p, 1.0);
                vWorld = w.xyz;
                vH = h;
                gl_Position = projectionMatrix * viewMatrix * w;
            }`,
        fragmentShader: /* glsl */ `
            uniform vec3 uSunDir, uSunColor, uTop, uHorizon;
            uniform float uFogNear, uFogFar;
            varying vec3 vWorld;
            varying vec3 vN;
            varying float vH;
            void main() {
                vec3 n = normalize(vN);
                vec3 L = normalize(uSunDir);
                vec3 base = mix(vec3(0.13, 0.08, 0.05), vec3(0.3, 0.2, 0.1), smoothstep(0.0, 24.0, vH));
                float diff = max(dot(n, L), 0.0);
                vec3 col = base * (uTop * 0.6 + vec3(0.05)) * (n.y * 0.5 + 0.5) + base * uSunColor * diff * 1.6;
                vec3 V = normalize(cameraPosition - vWorld);
                float rim = pow(1.0 - max(dot(n, V), 0.0), 3.0) * max(dot(-V, L), 0.0);
                col += uSunColor * rim * 0.35;
                float fog = smoothstep(uFogNear, uFogFar, length(vWorld - cameraPosition));
                col = mix(col, uHorizon, fog);
                gl_FragColor = vec4(col, 1.0);
                #include <tonemapping_fragment>
                #include <colorspace_fragment>
            }`,
    }));
    scene.add(terrain);

    // --- Road with scrolling markings and the orange route line ---
    const roadGeo = new THREE.PlaneGeometry(9, 720, 1, 1).rotateX(-Math.PI / 2).translate(0, 0.01, -260);
    const road = new THREE.Mesh(roadGeo, new THREE.ShaderMaterial({
        uniforms,
        vertexShader: /* glsl */ `
            varying vec3 vWorld;
            void main() {
                vec4 w = modelMatrix * vec4(position, 1.0);
                vWorld = w.xyz;
                gl_Position = projectionMatrix * viewMatrix * w;
            }`,
        fragmentShader: /* glsl */ `
            uniform float uOffset, uRoute, uFogNear, uFogFar;
            uniform vec3 uSunDir, uSunColor, uHorizon;
            varying vec3 vWorld;
            float hash(vec2 p) { return fract(sin(dot(p, vec2(12.9898, 78.233))) * 43758.5453); }
            void main() {
                float x = vWorld.x;
                float z = vWorld.z - uOffset;
                vec3 col = vec3(0.05, 0.046, 0.044) * (0.88 + hash(floor(vec2(x, z) * 30.0)) * 0.18);
                float shoulder = smoothstep(4.0, 4.5, abs(x));
                col = mix(col, vec3(0.12, 0.08, 0.05), shoulder);
                float edge = 1.0 - smoothstep(0.05, 0.08, abs(abs(x) - 3.5));
                float dash = step(mod(z, 9.0), 3.0) * (1.0 - smoothstep(0.06, 0.09, abs(x)));
                vec3 V = normalize(cameraPosition - vWorld);
                vec3 R = reflect(-V, vec3(0.0, 1.0, 0.0));
                col += uSunColor * pow(max(dot(R, normalize(uSunDir)), 0.0), 40.0) * 0.8;
                float ahead = -vWorld.z;
                float route = step(ahead, uRoute * 640.0) * step(-12.0, ahead);
                float core = 1.0 - smoothstep(0.03, 0.06, abs(x - 0.22));
                float glow = exp(-abs(x - 0.22) * 9.0) * 0.5;
                col += vec3(1.0, 0.36, 0.08) * (core * 2.2 + glow) * route;
                col = mix(col, vec3(0.86, 0.82, 0.75), max(edge * 0.75, dash * 0.9));
                float fog = smoothstep(uFogNear, uFogFar, length(vWorld - cameraPosition));
                col = mix(col, uHorizon, fog);
                gl_FragColor = vec4(col, 1.0);
                #include <tonemapping_fragment>
                #include <colorspace_fragment>
            }`,
    }));
    scene.add(road);

    // --- Tanker ---
    const { group: tanker, wheels } = createTanker();
    tanker.position.set(1.9, 0, -22); // rear of the tank ~18 m ahead
    scene.add(tanker);

    const catcher = new THREE.Mesh(new THREE.PlaneGeometry(14, 44).rotateX(-Math.PI / 2), new THREE.ShadowMaterial({ opacity: 0.55 }));
    catcher.position.set(1.9, 0.02, -12);
    catcher.receiveShadow = true;
    scene.add(catcher);

    // --- Utility poles on the right shoulder ---
    const POLES = 40;
    const SPACING = 18;
    const poleMat = new THREE.MeshStandardMaterial({ color: 0x1a120c, roughness: 0.9 });
    const poles = new THREE.InstancedMesh(new THREE.CylinderGeometry(0.11, 0.14, 8, 8).translate(0, 4, 0), poleMat, POLES);
    const bars = new THREE.InstancedMesh(new THREE.BoxGeometry(2.1, 0.1, 0.1).translate(0, 7.6, 0), poleMat, POLES);
    const poleZ = Array.from({ length: POLES }, (_, i) => 12 - i * SPACING);
    const m4 = new THREE.Matrix4();
    const placePoles = () => {
        poleZ.forEach((z, i) => {
            m4.makeTranslation(6.5, 0, z);
            poles.setMatrixAt(i, m4);
            bars.setMatrixAt(i, m4);
        });
        poles.instanceMatrix.needsUpdate = true;
        bars.instanceMatrix.needsUpdate = true;
    };
    placePoles();
    scene.add(poles, bars);

    // --- Backlit road dust ---
    const DUST = 700;
    const dustPos = new Float32Array(DUST * 3);
    for (let i = 0; i < DUST; i++) {
        dustPos[i * 3] = -10 + Math.random() * 24;
        dustPos[i * 3 + 1] = 0.2 + Math.random() * 5;
        dustPos[i * 3 + 2] = -70 + Math.random() * 76;
    }
    const dustGeo = new THREE.BufferGeometry();
    dustGeo.setAttribute('position', new THREE.BufferAttribute(dustPos, 3));
    const dust = new THREE.Points(dustGeo, new THREE.ShaderMaterial({
        uniforms: { ...uniforms, uPixel: { value: renderer.getPixelRatio() } },
        transparent: true,
        depthWrite: false,
        blending: THREE.AdditiveBlending,
        vertexShader: /* glsl */ `
            uniform float uPixel;
            uniform vec3 uSunDir;
            varying float vLit;
            void main() {
                vec4 mv = modelViewMatrix * vec4(position, 1.0);
                vec3 world = (modelMatrix * vec4(position, 1.0)).xyz;
                vLit = pow(max(dot(normalize(world - cameraPosition), normalize(uSunDir)), 0.0), 6.0);
                gl_PointSize = (2.0 + vLit * 5.0) * uPixel * (10.0 / -mv.z);
                gl_Position = projectionMatrix * mv;
            }`,
        fragmentShader: /* glsl */ `
            uniform vec3 uSunColor;
            varying float vLit;
            void main() {
                float d = length(gl_PointCoord - 0.5);
                float a = smoothstep(0.5, 0.0, d) * (0.08 + vLit * 0.7);
                gl_FragColor = vec4(uSunColor * (0.6 + vLit), a);
            }`,
    }));
    scene.add(dust);

    // --- Lights ---
    const hemi = new THREE.HemisphereLight(0x3d4c7c, 0x3a2416, 0.9);
    const sun = new THREE.DirectionalLight(0xffc48a, 2.6);
    sun.castShadow = true;
    sun.shadow.mapSize.set(1024, 1024);
    Object.assign(sun.shadow.camera, { left: -9, right: 9, top: 9, bottom: -9, near: 1, far: 140 });
    sun.shadow.bias = -0.0005;
    sun.target = tanker;
    scene.add(hemi, sun, sun.target);

    // --- Palette & sun position ---
    const state = { time: 0, intro: 0, scroll: 0, pointer: new THREE.Vector2(), pointerTarget: new THREE.Vector2(), running: false, raf: 0, last: 0 };
    let envRT = null;
    const pmrem = new THREE.PMREMGenerator(renderer);

    const applyPalette = () => {
        const t = Math.min(1, state.scroll * 0.9);
        const a = PALETTES.dawn;
        const b = PALETTES.morning;
        uniforms.uTop.value.copy(lerpColor(a.top, b.top, t));
        uniforms.uMid.value.copy(lerpColor(a.mid, b.mid, t));
        uniforms.uLow.value.copy(lerpColor(a.low, b.low, t));
        uniforms.uHorizon.value.copy(lerpColor(a.horizon, b.horizon, t));
        uniforms.uSunColor.value.copy(lerpColor(a.sun, b.sun, t));
        const rise = THREE.MathUtils.lerp(-0.02, a.elevation, easeOut(state.intro)) + (b.elevation - a.elevation) * t;
        const az = THREE.MathUtils.degToRad(8.3);
        uniforms.uSunDir.value.set(Math.sin(az), rise, -Math.cos(az)).normalize();
        // Shadow-casting light sits higher than the visible sun so shadows stay readable.
        sun.position.copy(tanker.position).add(new THREE.Vector3(Math.sin(az) * 40, 9, -Math.cos(az) * 40));
        sun.color.copy(uniforms.uSunColor.value);
        hemi.color.copy(uniforms.uTop.value).multiplyScalar(1.6);
    };

    const buildEnvironment = () => {
        const envScene = new THREE.Scene();
        envScene.add(sky.clone());
        envRT?.dispose();
        envRT = pmrem.fromScene(envScene, 0, 1, 1000);
        scene.environment = envRT.texture;
    };

    applyPalette();
    buildEnvironment();

    const resize = () => {
        const { clientWidth: w, clientHeight: h } = canvas;
        if (!w || !h) return;
        renderer.setSize(w, h, false);
        camera.aspect = w / h;
        // Keep the road framed on portrait screens by widening the view.
        camera.fov = camera.aspect < 1 ? 52 : 38;
        camera.updateProjectionMatrix();
    };
    resize();
    const ro = new ResizeObserver(resize);
    ro.observe(canvas);

    const frame = (now) => {
        state.raf = requestAnimationFrame(frame);
        const dt = Math.min((now - (state.last || now)) / 1000, 1 / 20);
        state.last = now;
        state.time += dt;

        uniforms.uTime.value = state.time;
        uniforms.uOffset.value += SPEED * dt;
        state.intro = Math.min(1, state.intro + dt / 3.2);
        uniforms.uRoute.value = easeInOut(Math.min(1, Math.max(0, (state.time - 0.6) / 2.6)));
        renderer.toneMappingExposure = THREE.MathUtils.lerp(0.6, 1.0, easeOut(state.intro));
        applyPalette();

        wheels.forEach((w) => { w.rotation.x -= (SPEED * dt) / 0.52; });
        tanker.position.y = Math.sin(state.time * 7.3) * 0.015 + Math.sin(state.time * 13.1) * 0.008;
        tanker.rotation.z = Math.sin(state.time * 2.1) * 0.004;

        for (let i = 0; i < POLES; i++) {
            poleZ[i] += SPEED * dt;
            if (poleZ[i] > 16) poleZ[i] -= POLES * SPACING;
        }
        placePoles();

        const pos = dustGeo.attributes.position;
        for (let i = 0; i < DUST; i++) {
            let z = pos.getZ(i) + SPEED * 0.85 * dt;
            if (z > 6) z -= 76;
            pos.setZ(i, z);
            pos.setY(i, pos.getY(i) + Math.sin(state.time + i) * 0.002);
        }
        pos.needsUpdate = true;

        state.pointer.lerp(state.pointerTarget, 1 - Math.pow(0.001, dt));
        const s = state.scroll;
        camera.position.set(
            base.x + state.pointer.x * 0.6 - s * 1.2,
            base.y + state.pointer.y * 0.25 + s * 6.5,
            base.z + s * 4,
        );
        look.set(base.x - s * 1.6 + state.pointer.x * 0.3, base.y + 8.4 - s * 14, -100);
        camera.lookAt(look);

        renderer.render(scene, camera);
    };

    let readyResolve;
    const ready = new Promise((resolve) => { readyResolve = resolve; });

    return {
        ready,
        start() {
            if (state.running) return;
            state.running = true;
            state.last = 0;
            state.raf = requestAnimationFrame((t) => {
                frame(t);
                readyResolve();
            });
        },
        stop() {
            state.running = false;
            cancelAnimationFrame(state.raf);
        },
        setPointer(x, y) { state.pointerTarget.set(x, y); },
        setScroll(p) { state.scroll = p; },
        dispose() {
            this.stop();
            ro.disconnect();
            envRT?.dispose();
            pmrem.dispose();
            scene.traverse((o) => {
                o.geometry?.dispose();
                [].concat(o.material || []).forEach((m) => { m.map?.dispose(); m.dispose(); });
            });
            renderer.dispose();
        },
    };
}

const easeOut = (t) => 1 - Math.pow(1 - t, 3);
const easeInOut = (t) => (t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2);
