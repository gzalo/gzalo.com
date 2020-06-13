<?php
	$descripcionPagina = '';
	$tituloPagina = 'RC filter calculator';
	$lang = 'en';	
	echo addBoxBeg('RC filter calculator');
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
<p>Given the value of the resistor and capacitor, this page calculates the cutoff frequency of a series RC passive filter</p>
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
</select> Farads</p>
<p>F: <input id="f" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<p><img src="/images/filtropasabajos.png" alt="Low pass RC filter Schematic" style="width:100%;max-width:700px;"/></p>
<p><img src="/images/filtropasaaltos.png" alt="High pass RC filter Schematic" style="width:100%;max-width:700px;"/></p>
<p>The curve rate is 20 decibels per decade. At the cutoff frequency, the output voltage is 3 dB (0.707 times) bellow the input voltage.</p>
<p>If the needed capacitor is too big, and the resistance value can't be bigger, it might be easier to implement the filter actively, using an opamp. <a href="http://circuit-diagram.hqew.net/First-Order-Low$2dPass-Active-Filter$3a-The-Circuit-Schematic-Diagram-and-The-Design-Formula_2694.html">This site provides a calculator for that purpose.</a>
<p>If the load impedance is around the filter impedances, the cutoff filter will be differente to the one wanted. In that case, a simple analog buffer may be added, for instance using an opamp as a voltage follower, in such way that the load doesn't affect the filter itself.</p>

<?php echo addBoxEnd();?>