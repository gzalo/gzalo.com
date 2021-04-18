//Dimensiones del mapa
var ancho = 128;
var alto = 128;

//Dimensiones de la cámara
var anchoCamara = 25;
var altoCamara = 20;

//Id de tiles del mapa
var datos = new Array(); 
var cvs,ctx,tileset,frames=0;
var camX=0,camY=0;

var teclas_w = 0, teclas_a = 0, teclas_s = 0, teclas_d = 0, teclas_shift = 0;
var fpsElemento;

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

function logicaJuego(){
	//Render
	
	ctx.clearRect(0, 0, cvs.width, cvs.height);

	//Las dimensiones de los tiles están hardcodeadas acá
	offX = camX&0x1F;
	offY = camY&0x1F;
	setX = camX>>5;
	setY = camY>>5;
	
	for(y=0;y<=altoCamara;y++){
		for(x=0;x<=anchoCamara;x++){
		
			id = datos[x+setX+(y+setY)*ancho];
			if(x+setX < 0) id = 0;
			if(x+setX > ancho-1) id = 0;
			
			ctx.drawImage(tileset, (id&0x0F)<<5, (id&0xF0)<<1	, 32, 32, x*32-offX, y*32-offY, 32, 32);
		}
	}
	
	//Randomizar algunos tiles del mapa
	for(i=0;i<20;i++){
		datos[Math.floor(Math.random() * ancho*alto)] = Math.floor(Math.random() * 256);
	}
	
	frames++;
	
	//Lógica de juego
	
	if(teclas_shift)
		camVel = 10;
	else
		camVel = 5;
	
	if(teclas_w) camY-=camVel;
	if(teclas_s) camY+=camVel;
	if(teclas_a) camX-=camVel;
	if(teclas_d) camX+=camVel;
}

function calcularFps(){
	fpsElemento.innerHTML = (frames/2) + ' FPS<br/>x: ' + camX + '<br/>y: ' + camY;
	frames = 0;
}

window.onload = function(){
	fpsElemento = document.getElementById('fps');
	cvs = document.getElementById('canvas');
	ctx = cvs.getContext('2d');
	
	for(i=0;i<alto*ancho;i++){
		datos.push(Math.floor(Math.random() * 256));
	}
	
	tileset = new Image();
	tileset.src = 'terrain.png';

	setInterval("logicaJuego()",16);
	setInterval("calcularFps()",2000);
	
}