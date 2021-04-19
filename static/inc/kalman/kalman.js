//Constantes
const anchoMovil=16, altoMovil=16;
const anchoPantalla=800, altoPantalla=640;

//Canvas
var cvs,ctx,frames=0;
var fpsElemento;

//Posición, velocidad y aceleración real
var posRealX,posRealY;
var velRealX,velRealY;
var accRealX,accRealY;

//Kalman
var x = new Array(4);
var p;
const h = 1/60;

//Estado de teclas
var teclas_w = 0, teclas_a = 0, teclas_s = 0, teclas_d = 0, teclas_shift = 0;

//Imágenes
var particula;

//Parámetros a cambiar
var desvioAceleracion = 360;
var sigmaDist = 20;

document.onkeydown = function(e){
	key = (e==null)?event.keyCode:e.which;
	if(key==87) teclas_w = 1;
	if(key==65) teclas_a = 1;	
	if(key==83) teclas_s = 1;	
	if(key==68) teclas_d = 1;
	if(key==16) teclas_shift = 1;
};

document.onkeyup = function(e){
	key = (e==null)?event.keyCode:e.which;
	if(key==87) teclas_w = 0;
	if(key==65) teclas_a = 0;	
	if(key==83) teclas_s = 0;	
	if(key==68) teclas_d = 0;
	if(key==16) teclas_shift = 0;
}

// Standard Normal variate 
function normal_random(mean, variance) {
  if (mean == undefined)
    mean = 0.0;
  if (variance == undefined)
    variance = 1.0;
  var V1, V2, S;
  do {
    var U1 = Math.random();
    var U2 = Math.random();
    V1 = 2 * U1 - 1;
    V2 = 2 * U2 - 1;
    S = V1 * V1 + V2 * V2;
  } while (S > 1);

  X = Math.sqrt(-2 * Math.log(S) / S) * V1;
//Y = Math.sqrt(-2 * Math.log(S) / S) * V2;
  X = mean + Math.sqrt(variance) * X;
//Y = mean + Math.sqrt(variance) * Y ;
  return X;
}
function logicaJuego(){
	//Render
	ctx.clearRect(0, 0, cvs.width, cvs.height);

	//Lógica de juego
	var camVel = 7200, camX = 0, camY = 0;
	
	if(teclas_shift)
		camVel = 18000;
	
	if(teclas_w) camY-=camVel;
	if(teclas_s) camY+=camVel;
	if(teclas_a) camX-=camVel;
	if(teclas_d) camX+=camVel;
	
	//Paso de física
	accRealX = camX - 12*velRealX;
	accRealY = camY - 12*velRealY;
	//Euler
	velRealX += accRealX*h;
	velRealY += accRealY*h;
	posRealY += velRealY*h;
	posRealX += velRealX*h;
		
	//Kalman
	accMedidaX = accRealX + normal_random(0,Math.pow(desvioAceleracion,2));
	accMedidaY = accRealY + normal_random(0,Math.pow(desvioAceleracion,2));
	A = math.matrix([[1,0,h,0],[0,1,0,h],[0,0,1,0],[0,0,0,1]]);
	Q = math.diag([desvioAceleracion*h, desvioAceleracion*h, desvioAceleracion*h*h, desvioAceleracion*h*h]);
	Da = math.matrix([0,0,h*accMedidaX,h*accMedidaY]);

	//Predicción Kalman
	x = math.add(math.multiply(A,x), Da);
    p = math.add(math.multiply(A,math.multiply(p,math.transpose(A))), Q);
		
	//Actualización Kalman
    distancias = [
        math.distance([0,0],[x._data[0], x._data[1]]),
        math.distance([anchoPantalla,0],[x._data[0], x._data[1]]),
		math.distance([0,altoPantalla],[x._data[0], x._data[1]]),
		math.distance([anchoPantalla,altoPantalla],[x._data[0], x._data[1]])
        ];	
	
	distancias_medidas = [
        math.distance([0,0],[posRealX,posRealY])+normal_random(0,Math.pow(sigmaDist,2)),
        math.distance([anchoPantalla,0],[posRealX,posRealY])+normal_random(0,Math.pow(sigmaDist,2)),
		math.distance([0,altoPantalla],[posRealX,posRealY])+normal_random(0,Math.pow(sigmaDist,2)),
		math.distance([anchoPantalla,altoPantalla],[posRealX,posRealY])+normal_random(0,Math.pow(sigmaDist,2))
        ];
	for(i=0;i<4;i++)
		if(distancias_medidas[i] < 0)
			distancias_medidas[i] = 0;
		
	//Triangulación a ojo
	ctx.beginPath();
	ctx.ellipse(0, 0, distancias_medidas[0], distancias_medidas[0], 0, 0, 2 * Math.PI);
	ctx.strokeStyle="#AAF";
	ctx.stroke();			
	ctx.beginPath();
	ctx.ellipse(anchoPantalla, 0, distancias_medidas[1], distancias_medidas[1], 0, 0, 2 * Math.PI);
	ctx.stroke();			
	ctx.beginPath();
	ctx.ellipse(0, altoPantalla, distancias_medidas[2], distancias_medidas[2], 0, 0, 2 * Math.PI);
	ctx.stroke();		
	ctx.beginPath();
	ctx.ellipse(anchoPantalla, altoPantalla, distancias_medidas[3], distancias_medidas[3], 0, 0, 2 * Math.PI);
	ctx.stroke();		
	
	
	R = math.diag([sigmaDist*sigmaDist,sigmaDist*sigmaDist,sigmaDist*sigmaDist,sigmaDist*sigmaDist]); 		

    C = [[(x._data[0]-0)/distancias[0],(x._data[1]-0)/distancias[0],0,0],
         [(x._data[0]-anchoPantalla)/distancias[1],(x._data[1]-0)/distancias[1],0,0],
         [(x._data[0]-0)/distancias[2],(x._data[1]-altoPantalla)/distancias[2],0,0],
         [(x._data[0]-anchoPantalla)/distancias[3],(x._data[1]-altoPantalla)/distancias[3],0,0]];
    
    K = math.multiply(math.multiply(p,math.transpose(C)),math.inv(math.add(math.multiply(math.multiply(C,p),math.transpose(C)),R)));
    x = math.add(x, math.multiply(K, math.subtract(distancias_medidas, distancias)));
    p = math.multiply(math.subtract(math.eye(4),math.multiply(K,C)),p);
		
		
	//Limitar los valores de posición
	posRealX = Math.min(Math.max(posRealX, anchoMovil/2), anchoPantalla-anchoMovil/2);
	posRealY = Math.min(Math.max(posRealY, altoMovil/2), altoPantalla-altoMovil/2);
	x._data[0] = Math.min(Math.max(x._data[0], anchoMovil/2), anchoPantalla-anchoMovil/2);
	x._data[1] = Math.min(Math.max(x._data[1], altoMovil/2), altoPantalla-altoMovil/2);	
		
	//Render
	ctx.drawImage(particula, 0, 0, particula.width, particula.height, posRealX-anchoMovil/2, posRealY-altoMovil/2, anchoMovil, altoMovil);
	ctx.drawImage(particula, 0, 0, particula.width, particula.height, x._data[0]-anchoMovil/2, x._data[1]-altoMovil/2, anchoMovil, altoMovil);
	
	//Lineas a esquinas
	/*ctx.beginPath();
	ctx.moveTo(0,0);
	ctx.lineTo(posRealX,posRealY);
	ctx.stroke();
	ctx.beginPath();
	ctx.moveTo(800,0);
	ctx.lineTo(posRealX,posRealY);
	ctx.stroke();
	ctx.beginPath();
	ctx.moveTo(0,640);
	ctx.lineTo(posRealX,posRealY);
	ctx.stroke();
	ctx.beginPath();
	ctx.moveTo(800,640);
	ctx.lineTo(posRealX,posRealY);
	ctx.stroke();*/
	
	//Velocidades
	ctx.beginPath();
	ctx.moveTo(x._data[0],x._data[1]);
	ctx.lineTo(x._data[0]+x._data[2]*2*h,x._data[1]+x._data[3]*2*h);
	ctx.strokeStyle="#F00";
	ctx.stroke();
	
	ctx.beginPath();
	ctx.moveTo(posRealX,posRealY);
	ctx.lineTo(posRealX+velRealX*2*h,posRealY+velRealY*2*h);
	ctx.strokeStyle="#F00";	
	ctx.stroke();
	
	//Incerteza (componentes de P)
	ctx.beginPath();
	ctx.ellipse(x._data[0], x._data[1], Math.sqrt(p._data[0][0]), Math.sqrt(p._data[1][1]), 0 * Math.PI/180, 0, 2 * Math.PI);
	ctx.strokeStyle="#DDD";
	ctx.stroke();
	
	frames++;
}

function calcularFps(){
	fpsElemento.innerHTML = (frames/2) + ' FPS<br/>Posición (real): ' + Math.round(posRealX) + ' ' + Math.round(posRealY) + '<br/>Posición (estm): ' + Math.round(x._data[0]) + ' ' + Math.round(x._data[1]);
	frames = 0;
}

window.onload = function(){
	fpsElemento = document.getElementById('fps');
	cvs = document.getElementById('canvas');
	ctx = cvs.getContext('2d');
		
	particula = new Image();
	particula.src = 'particle.png';
	
	reiniciarValores();
	
	setInterval("logicaJuego()",16);
	setInterval("calcularFps()",2000);
	
}

function actualizarDesvioAceleracion(val) {
	document.querySelector('#desvioAceleracion').value = parseFloat(val).toFixed(2);
	desvioAceleracion = val;
}
function actualizarDesvioDistancia(val) {
	document.querySelector('#desvioDistancia').value = parseFloat(val).toFixed(2);
	sigmaDist = val;
}
function reiniciarValores(){
	posRealX=anchoPantalla/2,posRealY=altoPantalla/2;
	velRealX=0,velRealY=0;
	accRealX=0,accRealY=0;

	//Kalman
	x = math.matrix([anchoPantalla/2, altoPantalla/2, 0,0]);
	p = math.diag([100, 100, 100, 100]);
}