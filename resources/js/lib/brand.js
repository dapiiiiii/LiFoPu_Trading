// LiFoPu mark geometry, mirrored from app/Support/Brand.php for canvas/WebGL use.
export const MARK_W = 661.1;
export const MARK_H = 572.4;

export const MARK_PATHS = [
    'M330.6 0L0 572.4L447.4 345.4L198.2 364.9Z',
    'M330.6 0L504.2 314.9L661.1 572.4L521.7 314.9Z',
    'M454.8 350.4L554.5 467.8L661.1 572.4L562.6 454.9Z',
    'M337.7 410.4L438.9 453.3L661.1 572.4L559.5 529.2L467.5 483.5Z',
];

export const COLORS = {
    ignite: '#d84500',
    gold: '#c69822',
    navy: '#000080',
    pulse: '#ff5c00',
    ink: '#0d0c0b',
    paper: '#f6f1ea',
};

/** Draw the mark onto a 2D canvas and return it. */
export function markCanvas(size = 512, color = '#ffffff') {
    const canvas = document.createElement('canvas');
    const scale = size / MARK_W;
    canvas.width = size;
    canvas.height = Math.ceil(MARK_H * scale);
    const ctx = canvas.getContext('2d');
    ctx.scale(scale, scale);
    ctx.fillStyle = color;
    MARK_PATHS.forEach((d) => ctx.fill(new Path2D(d)));
    return canvas;
}
