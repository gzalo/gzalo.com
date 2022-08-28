// ctx.moveTo(100, 100);
// ctx.lineTo(200, 200);
// ctx.lineTo(300, 100);
// ctx.strokeStyle = "#FF00FF";
// ctx.lineWidth = 10;
// ctx.lineCap = "round";
// ctx.lineJoin = "round";
// ctx.stroke();

function redraw_1(){
  var c = document.getElementById("melex_1");
  var ctx = c.getContext("2d");
  ctx.clearRect(0, 0, c.width, c.height);

  for (let y = 0; y < 50; y++) {
    for (let x = 0; x < 50; x++) {
      ctx.beginPath();
      ctx.lineWidth = Math.random() + 1;
      ctx.strokeStyle = getRandomColorHue();
      ctx.arc(0 + x * 40, 0 + y * 40, Math.random() * 10 + 10, 0, 2 * Math.PI);
      ctx.stroke();
    }
  }

  function getRandomColor() {
    var letters = "0123456789ABCDEF";
    var color = "#";
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }

  function RGBToHex(r, g, b) {
    r = r.toString(16);
    g = g.toString(16);
    b = b.toString(16);

    if (r.length == 1) r = "0" + r;
    if (g.length == 1) g = "0" + g;
    if (b.length == 1) b = "0" + b;

    return "#" + r + g + b;
  }

  function HSVtoRGB(h, s, v) {
    var r, g, b, i, f, p, q, t;
    if (arguments.length === 1) {
      (s = h.s), (v = h.v), (h = h.h);
    }
    i = Math.floor(h * 6);
    f = h * 6 - i;
    p = v * (1 - s);
    q = v * (1 - f * s);
    t = v * (1 - (1 - f) * s);
    switch (i % 6) {
      case 0:
        (r = v), (g = t), (b = p);
        break;
      case 1:
        (r = q), (g = v), (b = p);
        break;
      case 2:
        (r = p), (g = v), (b = t);
        break;
      case 3:
        (r = p), (g = q), (b = v);
        break;
      case 4:
        (r = t), (g = p), (b = v);
        break;
      case 5:
        (r = v), (g = p), (b = q);
        break;
    }
    return RGBToHex(
      Math.round(r * 255),
      Math.round(g * 255),
      Math.round(b * 255)
    );
  }

  function getRandomColorHue() {
    const hue = Math.random() * 0.1;
    const saturation = 1;
    const value = 1;
    return HSVtoRGB(hue, saturation, value);
  }
}

redraw_1();
document.getElementById("redraw_1").addEventListener("click", redraw_1);