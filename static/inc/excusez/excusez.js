let cvs, ctx; 
let canvasWidth, canvasHeight;
let particles = new Array();
let mouseX = 0, mouseY = 0, mouseStatus = 0;
let letterIdx = 0;
let letters = "RIP";
let start = null;
let phrases = [ 
// Pythoneer
"I was going through very bad times and socialization was not a priority.",
"These are shit moments.",
// Data Base Stored Procedure
"It makes me feel bad.",
"We can play together tomorrow.",
// Oracle WA
"Yes, I also had a really good time.",
"Let's confirm that tomorrow.",
"In theory I'll be less busy next week.",
"This days I'll be running around stressed.",
"I'll talk to you tomorrow.",
"Tomorrow we can talk better.",
"Tomorrow I'll be less busy.",
"I'm quite tired.",
"I don't know why I commited.",
"We can do something.",
"Yes, we could coordinate to do something.",
"Then we meet for something else.",
"Yes, that.",
"Tomorrow I'm going to have a swab, a close acquaintance tested positive.",
"I need more time.",
"I am very exhausted.",
"I have to continue but I no longer have the will.",
"It's unhealthy.",
"I don't have time for anything.",
"I end the days exhausted and I want to sleep.",
"Sorry, I didn't hang around here much.",
"I'm begging it to end.",
"Sorry for the delay.",
"Next week I will be more connected.",
"Sorry about the time.",
"I think this was the worst week in a long time.",
"I had a very hard day and tomorrow will be another.",
"The project is all on fire.",
"I'm still working, this is a mess.",
"It sounds like a joke, but I'm having lots of problems.",
"This project is also taking me forever.",
"Days of heavy work and a thousand problems come out.",
"All these days are going to be stressful and running around.",
"This month is chaos.",
"I'm going to go through a lot of stress.",
"I'm having a very bad stage.",
"There is less and less time and a thousand things to do.",
"So, suffering.",
"We are now entering a critical phase.",
"If I'm a bit hung up, that's why.",
"This week was pretty heavy particularly.",
"Excuse me, I was going to answer you.",
"Sorry I'm late, sometimes days fly by.",
// Bumble Muffin
"I'll confirm when I can get the permit.",
"I'm sorry I hung up.",
"Sorry that yesterday I hung up.",
"I'm not here on weekends, that's why.",
"It is not that I have lost interest.",
"I'm not having a good time.",
"I'm trying to take care of more things than I can.",
// Various
"I really hung up."
];
let colors = ["#0d6efd", "#6610f2", "#6f42c1", "#d63384", "#dc3545", "#fd7e14", "#ffc107", "#198754", "#20c997", "#0dcaf0", "#adb5bd", "#000"];

function render(){	
	ctx.clearRect(0, 0, cvs.width, cvs.height);
	ctx.font="40px Arial";
	ctx.textAlign="center"; 
	ctx.textBaseline="middle"; 
	for(let i=0;i<particles.length;i++){
		ctx.fillStyle = particles[i].color;
		ctx.save();
		ctx.translate(particles[i].x,particles[i].y);
		ctx.rotate(particles[i].angle);
		ctx.fillText(particles[i].letter,0,0);
		ctx.restore();
	}
}

function physics(){
	for(let i=0;i<particles.length;i++){
		let tx = particles[i].x;
		let ty = particles[i].y;
		particles[i].x += particles[i].x - (particles[i].ox + particles[i].fx * 0.05);
		particles[i].y += particles[i].y - (particles[i].oy + particles[i].fy * 0.05);
		particles[i].ox = tx;
		particles[i].oy = ty;
		particles[i].angle += particles[i].vang;
		
		let overY = 0;
		if(particles[i].y > canvasHeight-16)
			overY = (canvasHeight-16) - particles[i].y;
		if(particles[i].y < 16)
			overY = (16) - particles[i].y;					
		
		if(particles[i].x < 16){
			particles[i].ox = particles[i].x;			
			particles[i].x = 16;
		}
		if(particles[i].x > canvasWidth-16){
			particles[i].ox = particles[i].x;			
			particles[i].x = canvasWidth-16;
		}
		if(overY != 0){
			particles[i].oy = particles[i].y;			
			particles[i].y += overY;
			let diffX = particles[i].x - particles[i].ox;
			particles[i].x -= (diffX * 0.1);
		}
	}
		
	for(let i=0;i<particles.length;i++){
		for(let j=i+1;j<particles.length;j++){
			let dx = particles[j].x-particles[i].x;
			let dy = particles[j].y-particles[i].y;
			let a = dx*dx+dy*dy;
			let l = 25;
			if(a <= l*l ){
				if(a==0) continue;
				dist = Math.sqrt(a);
				difference = (dist - l) / (dist*(particles[i].invmass+particles[j].invmass));	
				particles[i].x += dx * difference * particles[i].invmass;
				particles[i].y += dy * difference * particles[i].invmass;
				particles[j].x -= dx * difference * particles[j].invmass;
				particles[j].y -= dy * difference * particles[j].invmass;
			}
		}
	}
}

function events(){
	if(mouseStatus == 1){
		createParticle(mouseX, mouseY, letters[letterIdx]);
		letterIdx++;
		letterIdx%=letters.length;
	}
}

function gameLogic(timestamp){
	if (!start) start = timestamp;
	let acc = timestamp - start;

	if(acc > 2000){
		start = timestamp;
		addPhrase();
	}

	events();
	physics();
	render();
	window.requestAnimationFrame(gameLogic);
}

function addPhrase(){
	let phrase = phrases[Math.floor(Math.random() * phrases.length)];
	let color = colors[Math.floor(Math.random() * colors.length)];

	let y = 50;
	let x = 30;
	for(let i=0;i<phrase.length;i++){
		if(x > canvasWidth - 100){
			y += 35;
			x = 30;
		}
		x += 30;
		let px = phrase[i];
		let dx = Math.random()*5;
		let dy = Math.random()*5;
		particles.push({
		'x': x+dx,'y':y+dy,
		'ox':x+dx,'oy':y+dy,
		'fx':0,'fy':-1,
		'letter':px, 'vang': 0,
		'angle': 0, 'invmass':1,
		'color': color});
	}
}

function createParticle(x,y, l = null){
	let r = parseInt(Math.random() * 26)+65+32;
	let px = String.fromCharCode(r);
	let vang = (Math.random()-0.5)*0.1;
		
	particles.push({
	'x': x,'y':y,
	'ox':x,'oy':y,
	'fx':0,'fy':-1,
	'letter':l?l:px, 'vang': vang,
	'angle': 0, 'invmass':1,
	'color': '#000'});
}

function createFixedParticle(x,y, l){
	particles.push({
	'x': x,'y':y,
	'ox':x,'oy':y,
	'fx':0,'fy':0,
	'letter':l, 'vang': 0,
	'angle': 0, 'invmass':0, 'color': '#000'});
}

function fixDimensions(){
	canvasWidth = document.documentElement.clientWidth;
	canvasHeight = document.documentElement.clientHeight;
	canvas.width = canvasWidth;
	canvas.height = canvasHeight;
}

window.onload = function(){
	cvs = document.getElementById('canvas');
	ctx = cvs.getContext('2d');
	fixDimensions();
	window.onresize = fixDimensions;

	canvas.addEventListener('mousemove', function(evt) {
		let rect = canvas.getBoundingClientRect();
        mouseX = evt.clientX - rect.left;
        mouseY = evt.clientY - rect.top;
	}, false);
	
	canvas.addEventListener('mousedown', function(evt) {
		if(evt.which == 1){
			mouseStatus = 1;
		}else if(evt.which == 2){
			mouseStatus = 2;
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
		mouseStatus = 0;
		evt.preventDefault();
	}, false);
	
	for(let i=0;i<100;i++){
		x = Math.random()*(canvasWidth-64)+48;
		y = Math.random()*150+canvasHeight - 200;
		createParticle(x,y);
	}
	
	window.requestAnimationFrame(gameLogic);
}