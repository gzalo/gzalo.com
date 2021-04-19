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

function compute(){
	var c = parse(document.querySelector("#c").value, document.querySelector("#cScale").value);
	var r = parse(document.querySelector("#r").value, document.querySelector("#rScale").value);

	var t = 1/(2*Math.PI*r*c);

	document.querySelector("#f").value = roundNumber(t,3) + " Hertz";
	
	if(t>=1000){
		document.querySelector("#f").value = roundNumber(t/1000,3) + " Kilohertz";
	}
	if(t>=1000000){
		document.querySelector("#f").value = roundNumber(t/1000000,3) + " Megahertz";
	}
	if(t>=1000000000){
		document.querySelector("#f").value = roundNumber(t/1000000000,3) + " Gigahertz";
	}
	
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