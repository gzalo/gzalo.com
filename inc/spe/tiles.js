var particle; 
var cvs,ctx,frames=0;
var fpsElemento;

var particulas = new Array();
var drag=-1;
var mouseX = 0, mouseY = 0, mouseStatus = 0;

document.onkeydown = function(e){
	key = (e==null)?event.keyCode:e.which;
	if(key==82) init();
};

function render(){	
	ctx.clearRect(0, 0, cvs.width, cvs.height);

	if(drag != -1){
		ctx.beginPath();
		ctx.moveTo(mouseX,mouseY);
		ctx.lineTo(particulas[drag].x,particulas[drag].y);
		ctx.lineWidth = 10;
		ctx.lineCap = 'round';
		ctx.stroke();
	}	
	
	for(var i=0;i<particulas.length;i++){
		ctx.drawImage(particle, 0,0,64,64, particulas[i].x-16,particulas[i].y-16, 32, 32);
	}

	frames++;
}

function fisica(){
	for(var i=0;i<particulas.length;i++){
		tx = particulas[i].x;
		ty = particulas[i].y;
		
		particulas[i].x += particulas[i].x - (particulas[i].ox + particulas[i].fx * 0.05);
		particulas[i].y += particulas[i].y - (particulas[i].oy + particulas[i].fy * 0.05);

		particulas[i].ox = tx;
		particulas[i].oy = ty;
		
		var overY = 0;
		if(particulas[i].y > 480-16)
			overY = (480-16) - particulas[i].y;
		if(particulas[i].y < 16)
			overY = (16) - particulas[i].y;					
		
		
		if(particulas[i].x < 16){
			particulas[i].ox = particulas[i].x;			
			particulas[i].x = 16;
		}
		if(particulas[i].x > 800-16){
			particulas[i].ox = particulas[i].x;			
			particulas[i].x = 800-16;
		}
		
		if(overY != 0){
			particulas[i].oy = particulas[i].y;			
			particulas[i].y += overY;
			var diffX = particulas[i].x - particulas[i].ox;
			particulas[i].x -= (diffX * 0.1);
		}
	}
	
	//Colisiones entre pelotas
	
	for(var i=0;i<particulas.length;i++){
		for(var j=i+1;j<particulas.length;j++){
			dx = particulas[j].x-particulas[i].x;
			dy = particulas[j].y-particulas[i].y;
			a = dx*dx+dy*dy;
			l = 32;
			if(a <= l*l ){
				if(a==0) continue;
				dist = Math.sqrt(a);
				difference = (dist - l) / (dist*2);	
				
				particulas[i].x += dx * difference * 0.5;
				particulas[i].y += dy * difference * 0.5;
				particulas[j].x -= dx * difference * 0.5;
				particulas[j].y -= dy * difference * 0.5;
			}
		}
	}
}

function eventos(){
	if(mouseStatus == 1){
		crearParticula(mouseX, mouseY);
	}
	if(drag != -1){
		particulas[drag].fx = -(mouseX - particulas[drag].x)*0.1;
		particulas[drag].fy = -(mouseY - particulas[drag].y)*0.1;
	}
}

function logicaJuego(){
	eventos();
	fisica();
	render();
}

function calcularFps(){
	fpsElemento.innerHTML = (frames/2) + ' FPS<br/>' + particulas.length + " &bullet;";
	frames = 0;
}

function crearParticula(x,y){
	particulas.push({
	'x': x,'y':y,
	'ox':x,'oy':y,
	'fx':0,'fy':-1});
}

window.onload = function(){
	fpsElemento = document.getElementById('fps');
	cvs = document.getElementById('canvas');
	ctx = cvs.getContext('2d');
	
	canvas.addEventListener('mousemove', function(evt) {
		var rect = canvas.getBoundingClientRect();
        mouseX = evt.clientX - rect.left;
        mouseY = evt.clientY - rect.top;
	}, false);
	
	canvas.addEventListener('mousedown', function(evt) {
		if(evt.which == 1){
			mouseStatus = 1;
		}else if(evt.which == 3){
			mouseStatus = 2;
		
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
			if(drag != -1){
				particulas[drag].fy=-1;
				particulas[drag].fx=0;
			}
			drag = dg;
		}
		evt.preventDefault();
	}, false);
	
	canvas.addEventListener('contextmenu', function(evt) {		
		evt.preventDefault();
		return false;
	}, false);
	
	document.addEventListener('mouseup', function(evt) {
		mouseStatus = 0;
		if(drag != -1){
			particulas[drag].fy=-1;
			particulas[drag].fx=0;
		}
		drag = -1;
		evt.preventDefault();
	}, false);
	
	particle = new Image();
	particle.src = 'particle.png';

	for(var i=0;i<10;i++){
		x = Math.random()*(800-64)+48;
		y = Math.random()*(480-64)+48;
		crearParticula(x,y);
	}
	
	setInterval("logicaJuego()",16);
	setInterval("calcularFps()",2000);
	
}