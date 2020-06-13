//Constantes
const anchoMovil=16, altoMovil=16;
var anchoPantalla=800, altoPantalla=640;

//Mouse
var mouseX = 0, mouseY = 0, mouseStatus = 0;

//Canvas
var cvs,ctx,frames=0;
var fpsElemento;

var cvs_txt, ctx_txt;

//Lógica
var particulas = new Array();
var drag = -1;
var teclas_w = 0, teclas_s = 0;
var dibujarCirculos = true;
var dibujarLineas = false;

//Imágenes
var particulaImg;

//Parámetros a cambiar
var sigmaDist = 20;
var c = [];

document.onkeydown = function(e){
	key = (e==null)?event.keyCode:e.which;
	if(key==87) teclas_w = 1;
	if(key==83) teclas_s = 1;	
	if(key==65) dibujarCirculos = !dibujarCirculos;	
	if(key==81) dibujarLineas = !dibujarLineas;	
	if(key==82) reiniciarValores();	
};

document.onkeyup = function(e){
	key = (e==null)?event.keyCode:e.which;
	if(key==87) teclas_w = 0;
	if(key==83) teclas_s = 0;	
}


function logicaJuego(){
	//Render
	ctx.clearRect(0, 0, cvs.width, cvs.height);

	if(teclas_w){
		sigmaDist++;
	}
	if(teclas_s){
		if(sigmaDist > 2)
			sigmaDist--;
	}
	c[0] = new Array();
	c[1] = new Array();
	for(var i=0;i<particulas.length;i++){
		ctx.drawImage(particulaImg, 0,0,64,64, particulas[i].x-anchoMovil/2,particulas[i].y-altoMovil/2, anchoMovil, altoMovil);
		dst = Math.sqrt(Math.pow(mouseX-particulas[i].x,2)+Math.pow(mouseY-particulas[i].y,2));
		
		if(dibujarCirculos){
			ctx.beginPath();
			ctx.ellipse(particulas[i].x, particulas[i].y, dst, dst, 0, 0, 2 * Math.PI);
			ctx.strokeStyle="#AAF";
			ctx.stroke();
		
			ctx.beginPath();
			ctx.ellipse(particulas[i].x, particulas[i].y, dst+sigmaDist, dst+sigmaDist, 0, 0, 2 * Math.PI);
			ctx.strokeStyle="#DDF";
			ctx.stroke();
		
			if(dst > sigmaDist){
				ctx.beginPath();
				ctx.ellipse(particulas[i].x, particulas[i].y, dst-sigmaDist, dst-sigmaDist, 0, 0, 2 * Math.PI);
				ctx.strokeStyle="#DDF";
				ctx.stroke();
			}
		}
		if(dibujarLineas){
			ctx.beginPath();
			ctx.strokeStyle="#AAF";
			ctx.moveTo(particulas[i].x,particulas[i].y);
			ctx.lineTo(mouseX,mouseY);
			ctx.stroke();
			
			var dirX = mouseX - particulas[i].x;
			var dirY = mouseY - particulas[i].y;
			var largo = Math.sqrt(dirX*dirX+dirY*dirY);
			dirX /= largo;
			dirY /= largo;
			
			ctx.beginPath();
			ctx.strokeStyle="#F00";
			ctx.moveTo(mouseX,mouseY);
			ctx.lineTo(mouseX+dirX*sigmaDist,mouseY+dirY*sigmaDist);
			ctx.stroke();
			
			ctx.beginPath();
			ctx.strokeStyle="#F00";
			ctx.moveTo(mouseX,mouseY);
			ctx.lineTo(mouseX-dirX*sigmaDist,mouseY-dirY*sigmaDist);
			ctx.stroke();
		}
		if(particulas.length > 1){
			c[0][i] = (mouseX-particulas[i].x)/dst;
			c[1][i] = (mouseY-particulas[i].y)/dst;
		}
	}
	if(particulas.length <= 1){
		c = [[1e-10,0],[0,1e-10]];
	}
	
	matError = math.multiply(math.inv(math.multiply(c, math.transpose(c))), sigmaDist*sigmaDist);
	imprimirGaussiana(ctx,matError, mouseX, mouseY);
	
	ctx.drawImage(cvs_txt, 0, 0);

	frames++;
	requestAnimationFrame(logicaJuego);
}

function calcularFps(){
	ctx_txt.clearRect(0, 0, cvs_txt.width, cvs_txt.height);
	ctx_txt.font="20px Trebuchet MS";
	ctx_txt.fillText(frames + ' FPS - ' + particulas.length + ' puntos',5,20);
	ctx_txt.font="15px Trebuchet MS";
	ctx_txt.fillText('Botón izquierdo: mover puntos',5,40);
	ctx_txt.fillText('Botón derecho: agregar puntos',5,60);
	ctx_txt.fillText('A: mostrar/ocultar círculos',5,80);
	ctx_txt.fillText('Q: mostrar/ocultar radios',5,100);
	ctx_txt.fillText('W/S: agrandar/achicar varianza de distancia',5,120);
	ctx_txt.fillText('R: reiniciar',5,140);
	frames = 0;
}

window.onload = function(){
	fpsElemento = document.getElementById('fps');
	cvs = document.getElementById('canvas');
	ctx = cvs.getContext('2d');
		
	particulaImg = new Image();
	particulaImg.src = 'particle.png';
	
	reiniciarValores();
	
	canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    anchoPantalla = canvas.width;
    altoPantalla = canvas.height;
	crearParticula(anchoPantalla*0.1, altoPantalla*0.1);
	crearParticula(anchoPantalla*0.5, altoPantalla*0.1);
	crearParticula(anchoPantalla*0.1, altoPantalla*0.5);
	crearParticula(anchoPantalla*0.5, altoPantalla*0.5);

	cvs_txt = document.createElement('canvas');
	cvs_txt.width = 500;
	cvs_txt.height = 200;
	ctx_txt = cvs_txt.getContext('2d');
	calcularFps();
	
	canvas.addEventListener('mousemove', function(evt) {
		var rect = canvas.getBoundingClientRect();
        mouseX = evt.clientX - rect.left;
        mouseY = evt.clientY - rect.top;
		
		if(drag != -1){
			particulas[drag].x=mouseX;
			particulas[drag].y=mouseY;
		}
	}, false);
	
	canvas.addEventListener('mousedown', function(evt) {
		if(evt.which == 1){
			mouseStatus = 1;
			
			var dmin = 100000, dg = -1;
			
			for(var idx=0;idx<particulas.length;idx++){
				dx = mouseX-particulas[idx].x;
				dy = mouseY-particulas[idx].y;
				dl = dx*dx+dy*dy;
				if(dl < dmin){
					dg = idx;
					dmin = dl;
				}
			}
			drag = dg;
			
		}else if(evt.which == 3){
			mouseStatus = 2;
		}
		evt.preventDefault();
	}, false);
	
	canvas.addEventListener('contextmenu', function(evt) {		
		evt.preventDefault();
		return false;
	}, false);
	
	document.addEventListener('mouseup', function(evt) {
		if(evt.which == 3){
			crearParticula(mouseX, mouseY);
		}
		mouseStatus = 0;
		drag = -1;
		//evt.preventDefault();
	}, false);
	
	logicaJuego();
	setInterval("calcularFps()",1000);
	
}
function actualizarDesvioDistancia(val) {
	document.querySelector('#desvioDistancia').value = parseFloat(val).toFixed(2);
	sigmaDist = parseFloat(val);
}
function reiniciarValores(){
	posRealX=anchoPantalla/2,posRealY=altoPantalla/2;
	particulas = new Array();
	drag = -1;
	
}
function crearParticula(x,y){
	particulas.push({
	'x': x,'y':y,});
}
function imprimirGaussiana(ctx, sigma, centroX, centroY){
	
	eigv = numeric.eig(sigma); 
	
	radio1 =2*Math.sqrt(eigv.lambda.x[0]);
	radio2 =2*Math.sqrt(eigv.lambda.x[1]);
	
	angulo = Math.atan2(eigv.E.x[1][0],eigv.E.x[0][0])
	
	ctx.beginPath();
	ctx.ellipse(centroX, centroY, radio1, radio2, angulo, 0, 2 * Math.PI);
	ctx.strokeStyle="#888";
	ctx.stroke();

}