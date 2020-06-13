<?php
	$descripcionPagina = '';
	$tituloPagina = 'Voltage and current regulator calculator';
	$lang = 'en';	
	
	echo addBoxBeg('Voltage and current regulator calculator');
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

function compute_v(){
	var r1 = parse($("#r1_v").val(), $("#r1Scale_v").val());
	var r2 = parse($("#r2_v").val(), $("#r2Scale_v").val());

	var vreg=0;
	if($("#regulador_v").val() == "LM317"){
		vreg = 1.25;
	}else if($("#regulador_v").val() == "7805"){
		vreg = 5;
	}else if($("#regulador_v").val() == "7808"){
		vreg = 8;
	}else if($("#regulador_v").val() == "7812"){
		vreg = 12;
	}else if($("#regulador_v").val() == "7824"){
		vreg = 24;
	}
	
	var vout = vreg*(1+r2/r1);

	$("#vout_v").val(roundNumber(vout,3) + " volts");
	
	if(vout<1){
		$("#vout_v").val(roundNumber(vout*1000,3) + " millivolts");
	}
}

function compute_i(){
	var r = parse($("#r_i").val(), $("#rScale_i").val());

	var vreg=0;
	if($("#regulador_i").val() == "LM317"){
		vreg = 1.25;
	}else if($("#regulador_i").val() == "7805"){
		vreg = 5;
	}else if($("#regulador_i").val() == "7808"){
		vreg = 8;
	}else if($("#regulador_i").val() == "7812"){
		vreg = 12;
	}else if($("#regulador_i").val() == "7824"){
		vreg = 24;
	}
	
	var iout = vreg/r;

	$("#iout_i").val(roundNumber(iout,3) + " amps");
	
	if(iout<1){
		$("#iout_i").val(roundNumber(iout*1000,3) + " milliamps");
	}
	
	var pout = vreg*iout;

	$("#pout_i").val(roundNumber(pout,3) + " watts");
	
	if(pout<1){
		$("#pout_i").val(roundNumber(pout*1000,3) + " milliwatts");
	}	
	
}
document.onreadystatechange = function () {
	if (document.readyState == "complete") {
		$("#reguladorf_v input").keyup(compute_v);
		$("#reguladorf_v select").change(compute_v);
		compute_v();	
		$("#reguladorf_i input").keyup(compute_i);
		$("#reguladorf_i select").change(compute_i);
		compute_i();	
	}
}
//
</script>
<?php echo addBoxBeg('Voltage regulator');?>
<p>Given the value of both resistors, and the regulator model, this page calculates the output voltage of the regulator.</p>
<p>Depending on the regulator model, the input voltage should be at least 2 volts higher than the desired output voltage. If a lower input voltage is required, a low dropout (LDO) regulator should be used instead, since they can operate without needing a high voltage drop. For higher efficiency or a voltage booster, a switching regulator is suggested.</p>
<form action="" id="reguladorf_v">
<p>R1: <input id="r1_v" value="1.2" class="w3-input w3-border" type="number"/><select id="r1Scale_v" class="w3-select w3-border">
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>R2: <input id="r2_v" value="1.8" class="w3-input w3-border" type="number"/><select id="r2Scale_v" class="w3-select w3-border">
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>Regulator: <select id="regulador_v"  class="w3-select w3-border">
  <option selected="selected">LM317</option>
  <option>7805</option>
  <option>7808</option>
  <option>7812</option>
  <option>7824</option>
</select></p>
<p>Vout: <input id="vout_v" disabled="disabled"  class="w3-input w3-border"/></p>
</form>
<p><img src="/images/reguladortension.png" alt="Voltage regulator schematic" style="width:100%;max-width:671px;"/></p>
</div></div>
<?php echo addBoxBeg('Current regulator');?>

<p>Given the value of the resistor and the regulator model, this page calculates the maximum output current, as well as the power disipated by the resistor in the worst case.</p>
<form action="" id="reguladorf_i">
<p>R: <input id="r_i" value="50" class="w3-input w3-border" type="number"/><select id="rScale_i"  class="w3-select w3-border">
  <option selected="selected"></option>
  <option>Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>Regulator: <select id="regulador_i"  class="w3-select w3-border">
  <option selected="selected">LM317</option>
  <option>7805</option>
  <option>7808</option>
  <option>7812</option>
  <option>7824</option>
</select></p>
<p>Iout: <input id="iout_i" disabled="disabled" class="w3-input w3-border"/></p>
<p>Pr: <input id="pout_i" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<p><img src="/images/reguladorcorriente.png" alt="Current source schematic" style="width:100%;max-width:650px;"/></p>
</div></div>

<?php echo addBoxEnd();?>