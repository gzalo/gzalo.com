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

function compute_v(){
	var r1 = parse(document.querySelector("#r1_v").value, document.querySelector("#r1Scale_v").value);
	var r2 = parse(document.querySelector("#r2_v").value, document.querySelector("#r2Scale_v").value);

	var vreg=0;
	if(document.querySelector("#regulador_v").value == "LM317"){
		vreg = 1.25;
	}else if(document.querySelector("#regulador_v").value == "7805"){
		vreg = 5;
	}else if(document.querySelector("#regulador_v").value == "7808"){
		vreg = 8;
	}else if(document.querySelector("#regulador_v").value == "7812"){
		vreg = 12;
	}else if(document.querySelector("#regulador_v").value == "7824"){
		vreg = 24;
	}
	
	var vout = vreg*(1+r2/r1);

	document.querySelector("#vout_v").value = roundNumber(vout,3) + " volts";
	
	if(vout<1){
		document.querySelector("#vout_v").value = roundNumber(vout*1000,3) + " millivolts";
	}
}

function compute_i(){
	var r = parse(document.querySelector("#r_i").value, document.querySelector("#rScale_i").value);

	var vreg=0;
	if(document.querySelector("#regulador_i").value == "LM317"){
		vreg = 1.25;
	}else if(document.querySelector("#regulador_i").value == "7805"){
		vreg = 5;
	}else if(document.querySelector("#regulador_i").value == "7808"){
		vreg = 8;
	}else if(document.querySelector("#regulador_i").value == "7812"){
		vreg = 12;
	}else if(document.querySelector("#regulador_i").value == "7824"){
		vreg = 24;
	}
	
	var iout = vreg/r;

	document.querySelector("#iout_i").value = roundNumber(iout,3) + " amps";
	
	if(iout<1){
		document.querySelector("#iout_i").value = roundNumber(iout*1000,3) + " milliamps";
	}
	
	var pout = vreg*iout;

	document.querySelector("#pout_i").value = roundNumber(pout,3) + " watts";
	
	if(pout<1){
		document.querySelector("#pout_i").value = roundNumber(pout*1000,3) + " milliwatts";
	}	
	
}
document.onreadystatechange = function () {
	if (document.readyState == "complete") {
		let inputs_v = document.querySelectorAll("#reguladorf_v input");
		for (let i = 0; i < inputs_v.length; i++) {
			inputs_v[i].addEventListener("input", compute_v);
		}

		let selects_v = document.querySelectorAll("#reguladorf_v select");
		for (let i = 0; i < selects_v.length; i++) {
			selects_v[i].addEventListener("change", compute_v);
		}
		compute_v();	

		let inputs_i = document.querySelectorAll("#reguladorf_i input");
		for (let i = 0; i < inputs_i.length; i++) {
			inputs_i[i].addEventListener("input", compute_i);
		}

		let selects_i = document.querySelectorAll("#reguladorf_i select");
		for (let i = 0; i < selects_i.length; i++) {
			selects_i[i].addEventListener("change", compute_i);
		}
		compute_i();	
	}
}