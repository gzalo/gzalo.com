<?php
	$descripcionPagina = '';
	$tituloPagina = 'Resistive divider calculator';
	$lang = 'en';	
	echo addBoxBeg('Resistive divider calculator');
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
<p>Given the two values of the resistors and an input voltage, this page calculates the output voltage of the resistor divider.</p>
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
<img src="/images/divisorresistivo.png" alt="Resistive divider" style="width:100%;max-width:178px;"/>
<p>A resistive divider (also called voltage divider) is a linear circuit that outputs a voltage (Vout) which is a fraction of the input voltage (Vin).</p>
<p>The circuit itself is based on two resistors in series, taking the middle node as the output. It's usually done to create a reference, or to attenuate a signal</p>
<p>Whenever a load is connected to the output node, a loading effect is produced. This means that the output voltage drops. To avoid this, the current flowing by the resistors should be higher than the one flowing to the load. The disadvantage of doing this is that efficiency is low, as most of that current disipates as heat.</p>
<p>The output resistance is the equivalent of the paralell of both resistor, Rout = (R1*R2)/(R1+R2).</p>

<?php echo addBoxEnd();?>