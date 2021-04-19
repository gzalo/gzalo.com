function roundNumber(num, dec) {
	var result = Math.round( Math.round( num * Math.pow( 10, dec + 1 ) ) / Math.pow( 10, 1 ) ) / Math.pow(10,dec);
	return result;
}

function parse(val, scale){
	var l = parseFloat(val);

	if(scale == "Pico") 	l /= 1000000000000;
	if(scale == "Nano")		l /= 1000000000;
	if(scale == "Micro")	l /= 1000000;
	if(scale == "Mili")		l /= 1000;
	
	if(scale == "Kilo")		l *= 1000;
	if(scale == "Mega")		l *= 1000000;
	if(scale == "Giga")		l *= 1000000000;	
	
	return l;
}

function calc(t){
	var val = "";
	if(t>=0.000000001){
		val = (roundNumber(t*1000000000,3) + " nano");
	}
	if(t>=0.000001){
		val = (roundNumber(t*1000000,3) + " micro");
	}
	if(t>=0.001){
		val = (roundNumber(t*1000,3) + " mili");
	}
	if(t>=1){
		val = (roundNumber(t,3));
	}
	if(t>=1000){
		val = (roundNumber(t/1000,3) + " kilo");
	}
	if(t>=1000000){
		val = (roundNumber(t/1000000,3) + " mega");
	}
	return val;
}

function compute(){
	var c = parse(document.querySelector("#cristal").value, document.querySelector("#cristalScale").value);
	
	document.querySelector("#ciclo").value = calc(1/c) + "second";
	
	var prescaler = document.querySelector("#prescaler").value;
	
	document.querySelector("#tickTimer").value = calc(prescaler/c) + "second";
	
	var reload = document.querySelector("#reload").value;
	
	document.querySelector("#rH").value = parseInt(reload / 256) + " " + reload % 256;
	
	document.querySelector("#timeover").value = calc((65535-reload)*prescaler/c) + "second";
	
	document.querySelector("#freqover").value = calc(1/((65535-reload)*prescaler/c)) + " Hertz";
}

document.onreadystatechange = function () {
	if (document.readyState == "complete") {
		let inputs = document.querySelectorAll("input");
		for (let i = 0; i < inputs.length; i++) {
			inputs[i].addEventListener("input", compute);
		}

		let selects = document.querySelectorAll("select");
		for (let i = 0; i < selects.length; i++) {
			selects[i].addEventListener("change", compute);
		}
		compute();	
	}
}