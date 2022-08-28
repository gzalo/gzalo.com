function redraw(){
  var c = document.getElementById("melex");
  var ctx = c.getContext("2d");

  ctx.strokeStyle = "#000";
  ctx.lineWidth = 2;

  ctx.clearRect(0, 0, c.width, c.height);
  const ancho = 100;

  for (let y = 0; y < 6; y++) {
    for (let x = 0; x < 6; x++) {
      const centroX = 100 + x * ancho;
      const centroY = 100 + y * ancho;

      const tipoCirculo = Math.floor(Math.random() * 6);

      if (tipoCirculo == 1) {
        ctx.beginPath();
        ctx.arc(centroX, centroY, ancho / 2, 0, 2 * Math.PI);
        ctx.stroke();
      } else if (tipoCirculo == 2) {
        ctx.beginPath();
        ctx.arc(centroX, centroY, ancho / 2, 0, 1 * Math.PI);
        ctx.stroke();
      } else if (tipoCirculo == 3) {
        ctx.beginPath();
        ctx.arc(centroX, centroY, ancho / 2, 1 * Math.PI, 2 * Math.PI);
        ctx.stroke();
      } else if (tipoCirculo == 4) {
        ctx.beginPath();
        ctx.arc(centroX, centroY, ancho / 2, 0.5 * Math.PI, 1.5 * Math.PI);
        ctx.stroke();
      } else if (tipoCirculo == 5) {
        ctx.beginPath();
        ctx.arc(centroX, centroY, ancho / 2, 1.5 * Math.PI, 2.5 * Math.PI);
        ctx.stroke();
      }

      const tipoCuadrado = Math.floor(Math.random() * 2);

      if (tipoCuadrado == 1) {
        ctx.strokeRect(centroX - ancho / 2, centroY - ancho / 2, ancho, ancho);
      }

      const tipoTriangulo = Math.floor(Math.random() * 2);

      if (tipoTriangulo == 1) {
        ctx.beginPath();
        ctx.moveTo(centroX - ancho / 2, centroY - ancho / 2);
        ctx.lineTo(centroX + ancho / 2, centroY + ancho / 2);
        ctx.lineTo(centroX + ancho / 2, centroY - ancho / 2);
        ctx.lineTo(centroX - ancho / 2, centroY - ancho / 2);
        ctx.stroke();
      }
    }
  }
}

redraw();
document.getElementById("redraw").addEventListener("click", redraw);
