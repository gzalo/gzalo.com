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

function computemonoestable(){
	var c = parse(document.querySelector("#c_m").value, document.querySelector("#cScale_m").value);
	var r = parse(document.querySelector("#r_m").value, document.querySelector("#rScale_m").value);

	var t = ( Math.log(3) * r * c );

	document.querySelector("#t_m").value = roundNumber(t*1000000,3) + " microseconds";
	
	if(t>=0.001){
		document.querySelector("#t_m").value = roundNumber(t*1000,3) + " milliseconds";
	}
	if(t>=1){
		document.querySelector("#t_m").value = roundNumber(t,3) + " seconds";
	}
	if(t>=60){
		document.querySelector("#t_m").value = roundNumber(t/60,3) + " minutes";
	}
}

function computeastable(){
	var c = parse(document.querySelector("#c_a").value, document.querySelector("#cScale_a").value);
	var r1 = parse(document.querySelector("#r1_a").value, document.querySelector("#r1Scale_a").value);
	var r2 = parse(document.querySelector("#r2_a").value, document.querySelector("#r2Scale_a").value);

	if((r1+2*r2) == 0) return false;
	
	var t =  ( Math.log(2) * (r1+2*r2) * c );
	var f = 1.0/t;
	var duty = (r1+r2)/(r1+2*r2);
	var ton = Math.log(2) * (r1 + r2) * c;
	var toff = Math.log(2) * r2 * c;
	
	document.querySelector("#t_a").value = roundNumber(t*1000000,3) + " microseconds";
	if(t>=0.001) document.querySelector("#t_a").value = roundNumber(t*1000,3) + " milliseconds";
	if(t>=1) document.querySelector("#t_a").value = roundNumber(t,3) + " seconds";
	
	document.querySelector("#f_a").value = roundNumber(f,3) + " hertz";
	if(f>1000) document.querySelector("#f_a").value = roundNumber(f/1000,3) + " kilohertz";
	if(f>1000000) document.querySelector("#f_a").value = roundNumber(f/1000000,3) + " megahertz";
	
	document.querySelector("#duty_a").value = roundNumber(duty*100,3) + " %";
	
	document.querySelector("#ton_a").value = roundNumber(ton*1000000,3) + " microseconds";
	if(ton>=0.001) document.querySelector("#ton_a").value = roundNumber(ton*1000,3) + " milliseconds";
	if(ton>=1) document.querySelector("#ton_a").value = roundNumber(ton,3) + " seconds";
	
	document.querySelector("#toff_a").value = roundNumber(toff*1000000,3) + " microseconds";
	if(toff>=0.001) document.querySelector("#toff_a").value = roundNumber(toff*1000,3) + " milliseconds";
	if(toff>=1) document.querySelector("#toff_a").value = roundNumber(toff,3) + " seconds";
}

document.onreadystatechange = function () {
	if (document.readyState == "complete") {
		let monostableInputs = document.querySelectorAll("#monoestable input")
		for (let i = 0; i < monostableInputs.length; i++)
			monostableInputs[i].addEventListener("input", computemonoestable);
		
		let monostableSelects = document.querySelectorAll("#monoestable select");
		for (let i = 0; i < monostableSelects.length; i++) 
			monostableSelects[i].addEventListener("change", computemonoestable);

		computemonoestable();	

		let astableInputs = document.querySelectorAll("#astable input")
		for (let i = 0; i < astableInputs.length; i++) 
			astableInputs[i].addEventListener("input", computeastable);

		let astableSelects = document.querySelectorAll("#astable select");
		for (let i = 0; i < astableSelects.length; i++) 
			astableSelects[i].addEventListener("change", computeastable);

		computeastable();	
	}
};