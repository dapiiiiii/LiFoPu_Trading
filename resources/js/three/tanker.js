// LiFoPu Transport bulk fuel tanker built from primitives, in the Transport palette
// (Deep Route Navy body, Pulse Orange bands, white mark). Local +z is the rear.
import * as THREE from 'three';
import { RoundedBoxGeometry } from 'three/addons/geometries/RoundedBoxGeometry.js';
import { markCanvas } from '../lib/brand.js';

export function createTanker() {
    const group = new THREE.Group();
    const wheels = [];

    const navy = new THREE.MeshPhysicalMaterial({ color: 0x0a1590, metalness: 0.3, roughness: 0.38, clearcoat: 0.7, clearcoatRoughness: 0.2, envMapIntensity: 0.55 });
    const pulse = new THREE.MeshStandardMaterial({ color: 0xff5c00, emissive: 0xff5c00, emissiveIntensity: 0.18, roughness: 0.35 });
    const steel = new THREE.MeshStandardMaterial({ color: 0xb9bcc6, metalness: 1, roughness: 0.22 });
    const chassisMat = new THREE.MeshStandardMaterial({ color: 0x0b0b10, metalness: 0.35, roughness: 0.7 });
    const rubber = new THREE.MeshStandardMaterial({ color: 0x0a0a0a, roughness: 0.92 });
    const tail = new THREE.MeshBasicMaterial({ color: 0xff2a1a });
    const amber = new THREE.MeshBasicMaterial({ color: 0xffae3b });

    const add = (geometry, material, x = 0, y = 0, z = 0) => {
        const mesh = new THREE.Mesh(geometry, material);
        mesh.position.set(x, y, z);
        mesh.castShadow = true;
        group.add(mesh);
        return mesh;
    };

    // Elliptical tank barrel (2.5 m × 2.0 m section, 7.2 m long) with domed ends.
    const barrel = new THREE.CylinderGeometry(1, 1, 7.2, 72, 1, true).rotateX(Math.PI / 2).scale(1.25, 1, 1);
    add(barrel, navy, 0, 2.15, 0);
    const dome = new THREE.SphereGeometry(1, 56, 20, 0, Math.PI * 2, 0, Math.PI / 2);
    add(dome.clone().rotateX(Math.PI / 2).scale(1.25, 1, 0.32), navy, 0, 2.15, 3.6);
    add(dome.clone().rotateX(-Math.PI / 2).scale(1.25, 1, 0.32), navy, 0, 2.15, -3.6);

    const band = new THREE.CylinderGeometry(1.012, 1.012, 0.24, 72, 1, true).rotateX(Math.PI / 2).scale(1.25, 1, 1);
    add(band, pulse, 0, 2.15, 3.05);
    add(band, pulse, 0, 2.15, -3.05);

    // White LiFoPu mark on the rear dome.
    const texture = new THREE.CanvasTexture(markCanvas(512, '#ffffff'));
    texture.colorSpace = THREE.SRGBColorSpace;
    texture.anisotropy = 4;
    const decal = new THREE.Mesh(
        new THREE.PlaneGeometry(0.78, 0.78 * (572.4 / 661.1)),
        new THREE.MeshStandardMaterial({ map: texture, transparent: true, roughness: 0.45, emissive: 0xffffff, emissiveMap: texture, emissiveIntensity: 0.22, polygonOffset: true, polygonOffsetFactor: -2 }),
    );
    decal.position.set(0, 2.18, 3.925);
    group.add(decal);

    // Chassis, bumper, lights, mud flaps.
    add(new THREE.BoxGeometry(2.3, 0.32, 9.8), chassisMat, 0, 0.95, -0.7);
    add(new THREE.BoxGeometry(2.42, 0.16, 0.14), chassisMat, 0, 0.72, 3.78);
    add(new THREE.BoxGeometry(1.5, 0.05, 0.02), pulse, 0, 0.74, 3.86);
    [-1, 1].forEach((side) => {
        add(new THREE.BoxGeometry(0.28, 0.12, 0.05), tail, side * 1.0, 0.86, 3.84);
        add(new THREE.BoxGeometry(0.5, 0.46, 0.03), rubber, side * 0.82, 0.56, 2.95);
        [-3, -1, 1].forEach((z) => add(new THREE.BoxGeometry(0.05, 0.06, 0.1), amber, side * 1.16, 0.98, z));
    });

    // Rear ladder and top walkway.
    [0.45, 0.72].forEach((x) => add(new THREE.BoxGeometry(0.04, 2.4, 0.04), steel, x, 2.0, 3.96));
    for (let y = 1.0; y < 3.1; y += 0.3) add(new THREE.BoxGeometry(0.27, 0.03, 0.03), steel, 0.585, y, 3.96);
    [-0.55, 0.55].forEach((x) => {
        add(new THREE.CylinderGeometry(0.025, 0.025, 6, 8).rotateX(Math.PI / 2), steel, x, 3.42, 0);
        [-2.8, 0, 2.8].forEach((z) => add(new THREE.CylinderGeometry(0.02, 0.02, 0.3, 6), steel, x, 3.28, z));
    });

    // Cab.
    add(new RoundedBoxGeometry(2.45, 2.6, 2.3, 4, 0.22), navy, 0, 1.95, -5.0);
    add(new THREE.BoxGeometry(2.47, 0.16, 2.32), pulse, 0, 1.25, -5.0);

    // Wheels: dual rear axles, single front axle.
    const wheelGeo = new THREE.CylinderGeometry(0.52, 0.52, 0.3, 28).rotateZ(Math.PI / 2);
    const hubGeo = new THREE.CylinderGeometry(0.22, 0.22, 0.31, 16).rotateZ(Math.PI / 2);
    const addWheel = (x, z) => {
        const wheel = new THREE.Group();
        wheel.position.set(x, 0.52, z);
        const tyre = new THREE.Mesh(wheelGeo, rubber);
        tyre.castShadow = true;
        wheel.add(tyre, new THREE.Mesh(hubGeo, steel));
        group.add(wheel);
        wheels.push(wheel);
    };
    [2.2, 0.9].forEach((z) => [-0.96, -0.62, 0.62, 0.96].forEach((x) => addWheel(x, z)));
    [-1.0, 1.0].forEach((x) => addWheel(x, -4.7));

    // Tail light glow sprites.
    const glowTex = radialTexture('rgba(255,60,30,1)');
    [-1, 1].forEach((side) => {
        const sprite = new THREE.Sprite(new THREE.SpriteMaterial({ map: glowTex, blending: THREE.AdditiveBlending, depthWrite: false, transparent: true, opacity: 0.85 }));
        sprite.scale.set(0.9, 0.9, 1);
        sprite.position.set(side * 1.0, 0.86, 3.9);
        group.add(sprite);
    });

    return { group, wheels };
}

export function radialTexture(color) {
    const canvas = document.createElement('canvas');
    canvas.width = canvas.height = 64;
    const ctx = canvas.getContext('2d');
    const g = ctx.createRadialGradient(32, 32, 0, 32, 32, 32);
    g.addColorStop(0, color);
    g.addColorStop(1, 'rgba(0,0,0,0)');
    ctx.fillStyle = g;
    ctx.fillRect(0, 0, 64, 64);
    const texture = new THREE.CanvasTexture(canvas);
    texture.colorSpace = THREE.SRGBColorSpace;
    return texture;
}
