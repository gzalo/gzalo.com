const matrixPatterns = [
  [],
  ['00100100', '00011000', '01111110', '11011011', '11111111', '10111101', '10100101', '00100100'],
  ['00000000', '00011000', '00011000', '00011000', '00011000', '00011000', '00011000', '00000000'],
  ['00011000', '00111100', '01111110', '11111111', '11111111', '01111110', '00111100', '00011000'],
];

function middle(element) {
  const rect = element.getBoundingClientRect();
  return [rect.left + rect.width / 2, rect.top + rect.height / 2];
}

function distance(a, b) {
  return Math.hypot(a[0] - b[0], a[1] - b[1]);
}

export function createBenchEffects(stage, objects) {
  const pieces = new Map(objects.map(piece => [piece.dataset.piece, piece]));
  const meter = pieces.get('rf');
  const iron = pieces.get('iron');
  const solder = pieces.get('solder');
  const tip = iron.querySelector('[data-tip]');
  const melt = stage.querySelector('[data-molten]');
  const status = stage.querySelector('[data-status]');
  const reduced = matchMedia('(prefers-reduced-motion: reduce)');
  const spanish = document.documentElement.lang === 'es';
  const emitters = ['doom', 'hugo', 'printer', 'board', 'console', 'microcomputer', 'iron'].map(id => pieces.get(id));
  const printer = pieces.get('printer').querySelector('.receipt');
  const matrix = pieces.get('console').querySelector('.matrix').getContext('2d');
  const micro = pieces.get('microcomputer');
  const microDisplay = micro.querySelector('.micro-display');
  const microLights = [...micro.querySelectorAll('.micro-lights i')];
  let frame = 0;
  let receiptNumber = 0;
  let receiptAnimation;
  let matrixMode = 0;
  let matrixFrame = 0;
  let matrixTimer;
  let microTimer;
  let address = 0;

  function announce(en, es) {
    status.textContent = spanish ? es : en;
  }

  function proximity() {
    frame = 0;
    const reach = Math.min(stage.clientWidth, stage.clientHeight) * .29;
    const meterPoint = middle(meter);
    const strength = meter.classList.contains('is-active')
      ? Math.max(0, ...emitters.map(piece => {
        const signal = Math.max(0, 1 - distance(meterPoint, middle(piece)) / reach);
        return signal * (piece.classList.contains('is-active') ? 1.6 : .78);
      }))
      : 0;
    meter.style.setProperty('--needle', `${Math.min(1, strength) * 82}deg`);

    const tipPoint = middle(tip);
    const spoolPoint = middle(solder.querySelector('.hardware'));
    const melting = iron.classList.contains('is-active')
      && distance(tipPoint, spoolPoint) < Math.max(27, solder.offsetWidth * .6);
    if (melting && melt.hidden) announce('Solder is melting.', 'El estaño se está derritiendo.');
    melt.hidden = !melting;
    solder.classList.toggle('is-melting', melting);
    if (melting) {
      const rect = stage.getBoundingClientRect();
      melt.style.left = `${tipPoint[0] - rect.left}px`;
      melt.style.top = `${tipPoint[1] - rect.top}px`;
    }
  }

  function queueProximity() {
    if (!frame) frame = requestAnimationFrame(proximity);
  }

  function printReceipt() {
    const stamps = ['=^.^=', '▓ ▓ ▓', '★ ★ ★', 'GZALO'];
    receiptNumber++;
    printer.textContent = `${stamps[(receiptNumber - 1) % stamps.length]}\n#${String(receiptNumber).padStart(3, '0')}`;
    receiptAnimation?.cancel();
    if (!reduced.matches) {
      receiptAnimation = printer.animate(
        [{ clipPath: 'inset(100% 0 0)' }, { clipPath: 'inset(0)' }],
        { duration: 480, easing: 'steps(8, end)' },
      );
    }
    announce(`Receipt ${receiptNumber} printed.`, `Ticket ${receiptNumber} impreso.`);
  }

  function drawMatrix() {
    if (!matrix) return;
    const pattern = matrixPatterns[matrixMode];
    matrix.fillStyle = '#170c0a';
    matrix.fillRect(0, 0, 56, 56);
    for (let y = 0; y < 8; y++) {
      for (let x = 0; x < 8; x++) {
        const column = (x + matrixFrame) % 8;
        matrix.beginPath();
        matrix.arc(x * 7 + 3.5, y * 7 + 3.5, 2.65, 0, Math.PI * 2);
        matrix.fillStyle = pattern[y]?.[column] === '1' ? '#ff4035' : '#481916';
        matrix.fill();
      }
    }
    matrixFrame++;
  }

  function cycleMatrix() {
    matrixMode = (matrixMode % (matrixPatterns.length - 1)) + 1;
    matrixFrame = 0;
    clearInterval(matrixTimer);
    drawMatrix();
    if (matrixMode && !reduced.matches) matrixTimer = setInterval(drawMatrix, 190);
    announce(`LED matrix mode ${matrixMode}.`, `Modo ${matrixMode} de la matriz LED.`);
  }

  function drawMicrocomputer() {
    const value = address.toString(16).toUpperCase().padStart(4, '0');
    microDisplay.textContent = `8080 RUN\nPC ${value}`;
    microLights.forEach((light, bit) => light.classList.toggle('lit', Boolean(address & (1 << bit))));
  }

  function runMicrocomputer(engaged) {
    clearInterval(microTimer);
    if (engaged) {
      address = 1;
      drawMicrocomputer();
      if (!reduced.matches) {
        microTimer = setInterval(() => {
          address = (address + 1) % 65536;
          drawMicrocomputer();
        }, 220);
      }
    } else {
      microDisplay.textContent = '';
      microLights.forEach(light => light.classList.remove('lit'));
    }
  }

  const alwaysOn = new Set(['iron', 'rf']);
  const turningTools = new Set(['leads', 'usb', 'driver', 'solder']);
  for (const id of alwaysOn) pieces.get(id).classList.add('is-active');
  drawMatrix();

  return {
    setEngaged(piece, engaged) {
      const id = piece.dataset.piece;
      piece.classList.toggle('is-active', engaged || alwaysOn.has(id));
      if (turningTools.has(id)) piece.classList.toggle('is-turned', engaged);
      if (id === 'printer' && engaged) printReceipt();
      if (id === 'microcomputer') runMicrocomputer(engaged);
      if (id === 'console') {
        if (engaged) cycleMatrix();
        else clearInterval(matrixTimer);
      }
      queueProximity();
    },
    queueProximity,
  };
}
