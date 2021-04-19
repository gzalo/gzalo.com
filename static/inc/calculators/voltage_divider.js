
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
	var r1 = parse(document.querySelector("#r1").value, document.querySelector("#r1Scale").value);
	var r2 = parse(document.querySelector("#r2").value, document.querySelector("#r2Scale").value);
	
	if((r2+r1) == 0) return false;
	
	var t = (r2 / ( r2 + r1) ) * document.querySelector("#vin").value;
		
	document.querySelector("#vout").value = roundNumber(t,3) + " volts";
	
	if(t<1){
		document.querySelector("#vout").value = roundNumber(t*1000,3) + " milivolts";
	}
	
	return false;
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