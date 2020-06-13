<?php
	$descripcionPagina = 'Dados el valor de la resistencia y el capacitor, calcula cuanto es la frecuencia de corte en un filtro pasivo RC serie.';
	$tituloPagina = 'Calculadora de filtro RC';
	echo addBoxBeg('Calculadora de filtro RC');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
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
	var c = parse($("#c").val(), $("#cScale").val());
	var r = parse($("#r").val(), $("#rScale").val());

	var t = 1/(2*Math.PI*r*c);

	$("#f").val(roundNumber(t,3) + " Hertz");
	
	if(t>=1000){
		$("#f").val(roundNumber(t/1000,3) + " Kilohertz");
	}
	if(t>=1000000){
		$("#f").val(roundNumber(t/1000000,3) + " Megahertz");
	}
	if(t>=1000000000){
		$("#f").val(roundNumber(t/1000000000,3) + " Gigahertz");
	}
	
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
<p>Dados el valor de la resistencia y el capacitor, esta página calcula cuanto es la frecuencia de corte en un filtro pasivo RC serie.</p>
<form action="">
<p>R: <input id="r" value="1" class="w3-input w3-border" type="number"/><select id="rScale" class="w3-select w3-border">
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>C: <input id="c" value="31.833" class="w3-input w3-border" type="number"/><select id="cScale" class="w3-select w3-border">
  <option>Pico</option>
  <option>Nano</option>
  <option selected="selected">Micro</option>
  <option>Mili</option>
</select> Faradios</p>
<p>F: <input id="f" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<p><img src="/images/filtropasabajos.png" alt="Esquematico Filtro RC pasa bajos" style="width:100%;max-width:700px;"/></p>
<p><img src="/images/filtropasaaltos.png" alt="Esquematico Filtro RC pasa altos"style="width:100%;max-width:700px;"/></p>
<p>La pendiente es de 20 decibeles por década. A la frecuecia de corte, la tensión de salida está 3 dB (0.707 veces) por debajo de la entrada.</p>
<p>El capacitor debería ser no polarizado, para que el filtro sirva con cualquier señal alterna de entrada. Además, si se usa un capacitor electrolítico hay problemas ya que suelen tener porcentajes de tolerancia muy altos (es decir, mucha dispersión de valores de capacidad), lo que hace que la frecuencia de corte sea distinta a la deseada, y además cambie considerablemente con la temperatura.</p>
<p>Si el capacitor necesario es muy grande, y no se puede aumentar la resistencia, posiblemente convenga implementar el filtro de forma activa, con un amplificador operacional. <a href="http://circuit-diagram.hqew.net/First-Order-Low$2dPass-Active-Filter$3a-The-Circuit-Schematic-Diagram-and-The-Design-Formula_2694.html">En este sitio hay una calculadora para eso.</a>
<p>Si la resistencia carga es del orden de las impedancias del filtro, la frecuencia de corte será distinta a la deseada. En ese caso convendría agregar un buffer, amplificador operacional puesto como seguidor de voltaje, de forma tal que no influya la carga en el filtro propiamente dicho.</p>


<?php echo addBoxEnd();?>