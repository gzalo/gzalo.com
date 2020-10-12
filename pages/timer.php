<?php
	$descripcionPagina = 'Dada la configuración de un timer, calcula cada cuanto tiempo hace overflow.';
	$tituloPagina = 'Calculadora de overflow de timer';
	echo addBoxBeg('Calculadora de overflow de timer');
?>
<script type="text/javascript">
// 
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
	
	document.querySelector("#ciclo").value = calc(1/c) + "segundos";
	
	var prescaler = document.querySelector("#prescaler").value;
	
	document.querySelector("#tickTimer").value = calc(prescaler/c) + "segundos";
	
	var reload = document.querySelector("#reload").value;
	
	document.querySelector("#rH").value = parseInt(reload / 256) + " " + reload % 256;
	
	document.querySelector("#timeover").value = calc((65535-reload)*prescaler/c) + "segundos";
	
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
// 
</script>
<p>Dada la configuración del timer, calcula el tiempo de overflow del mismo.</p>
<form action="">
<p>Cristal: <input id="cristal" value="12" class="w3-input w3-border" type="number"/><select id="cristalScale" class="w3-select w3-border">
  <option>Kilo</option>
  <option selected="selected">Mega</option>
</select> Hertz</p>
<p>Ciclo de máquina cada: <input id="ciclo" disabled="disabled" class="w3-input w3-border"/></p>
<p>Prescaler: <input id="prescaler" value="12" class="w3-input w3-border" type="number"/></p>
<p>Tick de timer: <input id="tickTimer" disabled="disabled" class="w3-input w3-border"/></p>

<p>Valor de recarga: <input id="reload" value="64535" class="w3-input w3-border" type="number"/></p>

<p>Frecuencia de overflow: <input id="freqover" disabled="disabled" class="w3-input w3-border"/></p>
<p>Período de overflow: <input id="timeover" disabled="disabled" class="w3-input w3-border"/></p>
<p>Valor de recarga: 	<input id="rH" disabled="disabled" class="w3-input w3-border"/></p>
</form>

<?php echo addBoxEnd();?>