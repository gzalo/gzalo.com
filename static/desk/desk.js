import { createBenchEffects } from "./desk-effects.js";

const stage = document.querySelector('[data-stage]');
const inspection = stage.querySelector('[data-inspection]');
const inspectionContent = inspection.querySelector('[data-inspection-content]');
const pieces = [...stage.querySelectorAll('[data-piece]')];
const effects = createBenchEffects(stage, pieces);
const compact = matchMedia('(max-aspect-ratio: 4/5)');
const storageKey = 'gzalo.workbench.photos.v1';
const shifts = {
  ArrowLeft: [-1, 0],
  ArrowRight: [1, 0],
  ArrowUp: [0, -1],
  ArrowDown: [0, 1],
};

function readPositions() {
  try {
    const saved = JSON.parse(localStorage.getItem(storageKey));
    return saved && typeof saved === 'object' ? saved : {};
  } catch {
    return {};
  }
}

function clamp(value, min, max) {
  return Math.max(min, Math.min(value, max));
}

let positions = readPositions();
let drag;
let suppressClick;
let hovered;
let focused;
let picked;

function save() {
  try {
    localStorage.setItem(storageKey, JSON.stringify(positions));
  } catch {
    // Rearranging the current desk also works without browser storage.
  }
}

function mode() {
  return compact.matches ? 'portrait' : 'landscape';
}

function place(piece, x, y) {
  const { clientWidth: width, clientHeight: height } = stage;
  // Leave a grabbable strip visible when a large object hangs off the edge.
  const marginX = Math.min(52, piece.offsetWidth * .45);
  const marginY = Math.min(48, piece.offsetHeight * .45);
  const xLimit = (marginX - piece.offsetWidth / 2) / width;
  const yLimit = (marginY - piece.offsetHeight / 2) / height;
  const xOnDesk = clamp(x, xLimit, 1 - xLimit);
  const yOnDesk = clamp(y, yLimit, 1 - yLimit);
  piece.style.setProperty('--x', `${xOnDesk * 100}%`);
  piece.style.setProperty('--y', `${yOnDesk * 100}%`);
  piece.style.setProperty('--depth', String(Math.round(clamp(yOnDesk, 0, 1) * 1000)));
  return [xOnDesk, yOnDesk];
}

function returnToBench(piece) {
  const saved = positions[mode()]?.[piece.dataset.piece];
  const computed = getComputedStyle(piece);
  const home = ['--home-x', '--home-y'].map(key => parseFloat(computed.getPropertyValue(key)) / 100);
  const [x, y] = Array.isArray(saved) && saved.length === 2 && saved.every(Number.isFinite) ? saved : home;
  place(piece, x, y);
}

function centerInForeground(piece) {
  const { clientWidth: width, clientHeight: height } = stage;
  const desired = Math.max(1.23, Math.min(width, height) * .48 / Math.max(piece.offsetWidth, piece.offsetHeight));
  const fitting = Math.min((width - 34) / piece.offsetWidth, (height - 80) / piece.offsetHeight);
  piece.style.setProperty('--foreground-scale', String(Math.min(desired, fitting)));
  place(piece, .5, .49);
}

function arrange() {
  for (const piece of pieces) {
    if (piece === drag?.piece) continue;
    if (piece === picked) centerInForeground(piece);
    else returnToBench(piece);
  }
  effects.queueProximity();
}

function remember(piece, position) {
  const layout = mode();
  positions[layout] = { ...positions[layout], [piece.dataset.piece]: position };
  save();
}

function center(piece) {
  return ['--x', '--y'].map(key => parseFloat(piece.style.getPropertyValue(key)) / 100);
}

function syncEngagement(piece) {
  if (!piece) return;
  const engaged = piece === hovered || piece === focused || piece === picked
    || (piece === drag?.piece && drag.moved);
  if (piece.classList.contains('is-engaged') === engaged) return;
  piece.classList.toggle('is-engaged', engaged);
  effects.setEngaged(piece, engaged);
}

function selectForeground(piece) {
  const previous = picked;
  picked = piece === previous ? undefined : piece;
  if (previous) {
    previous.classList.remove('is-picked');
    previous.querySelector('[data-use]').setAttribute('aria-pressed', 'false');
    returnToBench(previous);
    syncEngagement(previous);
  }
  if (picked) {
    picked.classList.add('is-picked');
    picked.querySelector('[data-use]').setAttribute('aria-pressed', 'true');
    centerInForeground(picked);
    syncEngagement(picked);
  }
  effects.queueProximity();
}

function renderedCenter(piece) {
  const rect = piece.getBoundingClientRect();
  const bench = stage.getBoundingClientRect();
  return [(rect.left + rect.width / 2 - bench.left) / bench.width,
    (rect.top + rect.height / 2 - bench.top) / bench.height];
}

function inspect(record) {
  inspectionContent.replaceChildren(record.content.cloneNode(true));
  inspection.showModal();
}

for (const piece of pieces) {
  const control = piece.querySelector('[data-use]');
  const details = piece.querySelector('[data-details]');
  control.setAttribute('aria-describedby', 'bench-keys');
  control.setAttribute('aria-pressed', 'false');
  control.disabled = false;
  piece.hidden = false;
  if (details) {
    const record = stage.querySelector(`[data-record="${piece.dataset.piece}"]`);
    details.setAttribute('aria-haspopup', 'dialog');
    details.addEventListener('click', event => {
      if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
      event.preventDefault();
      inspect(record);
    });
  }

  piece.addEventListener('pointerenter', event => {
    if (event.pointerType === 'touch' || drag) return;
    const previous = hovered;
    hovered = piece;
    syncEngagement(previous);
    syncEngagement(piece);
  });

  piece.addEventListener('pointerleave', () => {
    if (hovered !== piece) return;
    hovered = undefined;
    syncEngagement(piece);
  });

  control.addEventListener('focus', () => {
    if (!control.matches(':focus-visible')) return;
    focused = piece;
    syncEngagement(piece);
  });

  control.addEventListener('blur', () => {
    if (focused === piece) focused = undefined;
    syncEngagement(piece);
  });

  control.addEventListener('click', event => {
    if (suppressClick === piece && event.detail !== 0) {
      suppressClick = undefined;
      return;
    }
    selectForeground(piece);
  });

  control.addEventListener('keydown', event => {
    const shift = shifts[event.key];
    if (!shift || event.altKey || event.ctrlKey || event.metaKey) return;
    event.preventDefault();
    const [x, y] = center(piece);
    if (picked === piece) {
      picked = undefined;
      piece.classList.remove('is-picked');
      control.setAttribute('aria-pressed', 'false');
      syncEngagement(piece);
    }
    const step = event.shiftKey ? 30 : 12;
    remember(piece, place(piece, x + shift[0] * step / stage.clientWidth, y + shift[1] * step / stage.clientHeight));
    effects.queueProximity();
  });

  control.addEventListener('pointerdown', event => {
    suppressClick = undefined;
    if (!event.isPrimary || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || drag) return;
    const [x, y] = renderedCenter(piece);
    drag = { piece, pointer: event.pointerId, x, y, startX: event.clientX, startY: event.clientY, moved: false };
    control.setPointerCapture(event.pointerId);
  });
}

stage.addEventListener('pointermove', event => {
  if (!drag || event.pointerId !== drag.pointer) return;
  const dx = event.clientX - drag.startX;
  const dy = event.clientY - drag.startY;
  if (!drag.moved && Math.hypot(dx, dy) < 5) return;
  drag.moved = true;
  drag.piece.classList.add('is-dragging');
  syncEngagement(drag.piece);
  drag.piece.style.setProperty('--tilt', `${clamp(dx / 15, -8, 8)}deg`);
  place(drag.piece, drag.x + dx / stage.clientWidth, drag.y + dy / stage.clientHeight);
  effects.queueProximity();
});

function release(event) {
  if (!drag || event.pointerId !== drag.pointer) return;
  const { piece, moved } = drag;
  drag = undefined;
  if (!moved) return;
  suppressClick = piece;
  if (picked === piece) {
    picked = undefined;
    piece.classList.remove('is-picked');
    piece.querySelector('[data-use]').setAttribute('aria-pressed', 'false');
  }
  piece.classList.remove('is-dragging');
  syncEngagement(piece);
  piece.style.removeProperty('--tilt');
  remember(piece, place(piece, ...center(piece)));
  effects.queueProximity();
}

for (const event of ['pointerup', 'pointercancel', 'lostpointercapture']) {
  stage.addEventListener(event, release);
}

inspection.querySelector('[data-close]').addEventListener('click', () => inspection.close());
inspection.addEventListener('click', event => {
  if (event.target === inspection) inspection.close();
});
stage.addEventListener('click', event => {
  if (event.target === stage && picked) selectForeground(picked);
});
stage.addEventListener('keydown', event => {
  if (event.key === 'Escape' && picked && !inspection.open && !event.defaultPrevented) {
    selectForeground(picked);
  }
});
stage.addEventListener('transitionend', event => {
  if (event.target.matches('.hardware, .piece')) effects.queueProximity();
});
arrange();
new ResizeObserver(arrange).observe(stage);
