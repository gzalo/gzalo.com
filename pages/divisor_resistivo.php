<?php
	$descripcionPagina = 'Dadas dos resistencias y un voltaje de entrada, calcula cual será el voltaje de salida del divisor resistivo.';
	$tituloPagina = 'Calculador de divisor resistivo';
	
	echo addBoxBeg('Calculador de divisor resistivo');
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
function compute(){
	var r1 = parse($("#r1").val(), $("#r1Scale").val());
	var r2 = parse($("#r2").val(), $("#r2Scale").val());
	
	if((r2+r1) == 0) return false;
	
	var t = (r2 / ( r2 + r1) ) *  $("#vin").val();
		
	$("#vout").val(roundNumber(t,3) + " volts");
	
	if(t<1){
		$("#vout").val(roundNumber(t*1000,3) + " milivolts");
	}
	
	return false;
}
document.onreadystatechange = function () {
	if (document.readyState == "complete") {
		$("input").keyup(compute);
		$("select").change(compute);
		compute();	
	}
}
//
</script>
<p>Dadas dos resistencias y un voltaje de entrada, esta página calcula cual será el voltaje de salida del divisor resistivo.</p>
<form action="">
<p>R1: <input name="r1" value="2.7" id="r1" class="w3-input w3-border" type="number"/><select name="r1Scale" id="r1Scale" class="w3-select w3-border">
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select>Ohms</p>
<p>R2: <input name="r2" value="5.6" id="r2" class="w3-input w3-border" type="number"/><select name="r2Scale" id="r2Scale" class="w3-select w3-border">
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select>Ohms</p>
<p>Vin [Volts]<input name="vin" value="5" id="vin" class="w3-input w3-border" type="number"/></p>
<p>Vout <input name="vout" disabled="disabled" id="vout" class="w3-input w3-border"/></p>
</form>
<img src="/images/divisorresistivo.png" alt="Divisor resistivo" style="width:100%;max-width:178px;"/>
<p>Un divisor resistivo (también llamado divisor de tensión o de potencial) es un circuito lineal que produce un voltaje de salida (Vout) que es una fracción del voltaje de entrada (Vin)</p>
<p>El divisor de voltaje más sencillo cuenta con dos resistencias puestas en serie, tomando el nodo del medio como el voltaje de salida. Suele ser usado para crear un voltaje de referencia, o para obtener una señal de bajo voltaje proporcional a un voltaje medido (atenuador de señal).</p>
<p>La carga conectada a la salida produce un efecto carga. Es decir, al conectarla disminuye la tensión de salida. Por esto, conviene que la corriente de entrada sea mucho mayor a la corriente de salida. La desventaja de hacer esto es que la mayor parte de la corriente de entrada se pierde en forma de calor en las resistencias.</p>
<p>La impedancia de salida del divisor resistivo es igual a la resistencia cuando R1 y R2 están en paralelo, es decir Rout = (R1*R2)/(R1+R2).</p>


<?php echo addBoxEnd();?>