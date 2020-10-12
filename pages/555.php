<?php
	$descripcionPagina = 'Calcula cuanto es el tiempo que la señal de salida estará activa, en un circuito integrado 555 configurado como monoestable o astable.';
	$tituloPagina = 'Calculadora de tiempos con 555.';
	
	echo addBoxBeg('Calculadora de tiempos con 555');
?>

<?php echo addBoxBeg('555 como Monoestable');?>

			<p>Dados el valor de la resistencia y el capacitor, esta página calcula cuanto es el tiempo que la señal de salida estará activa, en un 555 configurado como monoestable.</p>
<form action="" id="monoestable">
<p>R: <input id="r_m" value="4.7" type="number" class="w3-input w3-border"/><select id="rScale_m" class="w3-select w3-border">
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>C: <input id="c_m" value="1" type="number" class="w3-input w3-border"/><select id="cScale_m" class="w3-select w3-border">
  <option>Pico</option>
  <option>Nano</option>
  <option selected="selected">Micro</option>
  <option>Mili</option>
</select> Faradios</p>
<p>T: <input id="t_m" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<p><img src="/images/555mono.png" alt="Esquematico Monoestable con 555" style="width:100%;max-width:580px;"/></p>
<p><img src="/images/555tiempos.png" alt="Diagrama temporal 555" style="width:100%;max-width:500px;"/></p>
		
		</div>
		</div>
		
		<?php echo addBoxBeg('555 como Astable');?>


			<p>Dados el valor de las resistencias y el capacitor, esta página calcula cuanto es el período, frecuencia y duty cycle, en un 555 configurado como astable.</p>
<form action="" id="astable">
<p>R1: <input id="r1_a" value="1" type="number" class="w3-input w3-border"/><select id="r1Scale_a" class="w3-select w3-border">
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>R2: <input id="r2_a" value="10" type="number" class="w3-input w3-border"/><select id="r2Scale_a" class="w3-select w3-border">
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>C:  <input id="c_a" value="1" type="number" class="w3-input w3-border"/><select id="cScale_a" class="w3-select w3-border">
  <option>Pico</option>
  <option>Nano</option>
  <option selected="selected">Micro</option>
  <option>Mili</option>
</select> Faradios</p>
<p>T: <input id="t_a" disabled="disabled" class="w3-input w3-border"/></p>
<p>F: <input id="f_a" disabled="disabled" class="w3-input w3-border"/></p>
<p>Ton: <input id="ton_a" disabled="disabled" class="w3-input w3-border"/></p>
<p>Toff: <input id="toff_a" disabled="disabled" class="w3-input w3-border"/></p>
<p>Duty: <input id="duty_a" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<p><img src="/images/555astable.png" alt="Esquematico Astable con 555" style="width:100%;max-width:582px;"/></p>
<p><img src="/images/555atiempos.png" alt="Diagrama temporal 555" style="width:100%;max-width:421px;"/></p>
		
		</div>
		</div>

	
	<p>Por lo general, el 555 se alimenta entre 3 y 15 volts. Para el voltaje de la entrada, en el caso de la configuración monoestable, no debería pasarse mucho de vcc y se detecta como "1" al pasar 0.67*vcc y como "0" al ser menos que 0.33*vcc.</p>
<p>Para utilizar tiempos relativamente grandes, es necesario emplear una variación del timer 555, el 7555, que es CMOS y por lo tanto tiene menores corrientes de entrada, lo que permite utilizar resistencias y capacitores más grandes para lograr una salida precisa.</p>
<p>El capacitor que va en el pin 5, ayuda a estabilizar al circuito y evitar que entre ruido externo al integrado, para prototipos rápidos podría no ser necesario.</p>

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
// 
</script>

<?php echo addBoxEnd();?>