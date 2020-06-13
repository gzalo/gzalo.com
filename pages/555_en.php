<?php
	$descripcionPagina = '';
	$tituloPagina = 'Timers using 555';
	$lang = 'en';	
	
	echo addBoxBeg('Timers using 555');
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

function computemonoestable(){
	var c = parse($("#c_m").val(), $("#cScale_m").val());
	var r = parse($("#r_m").val(), $("#rScale_m").val());

	var t = ( Math.log(3) * r * c );

	$("#t_m").val(roundNumber(t*1000000,3) + " microseconds");
	
	if(t>=0.001){
		$("#t_m").val(roundNumber(t*1000,3) + " milliseconds");
	}
	if(t>=1){
		$("#t_m").val(roundNumber(t,3) + " seconds");
	}
	if(t>=60){
		$("#t_m").val(roundNumber(t/60,3) + " minutes");
	}
}


function computeastable(){
	var c = parse($("#c_a").val(), $("#cScale_a").val());
	var r1 = parse($("#r1_a").val(), $("#r1Scale_a").val());
	var r2 = parse($("#r2_a").val(), $("#r2Scale_a").val());

	if((r1+2*r2) == 0) return false;
	
	var t =  ( Math.log(2) * (r1+2*r2) * c );
	var f = 1.0/t;
	var duty = (r1+r2)/(r1+2*r2);
	var ton = Math.log(2) * (r1 + r2) * c;
	var toff = Math.log(2) * r2 * c;
	
	$("#t_a").val(roundNumber(t*1000000,3) + " microseconds");
	if(t>=0.001) $("#t_a").val(roundNumber(t*1000,3) + " milliseconds");
	if(t>=1) $("#t_a").val(roundNumber(t,3) + " seconds");
	
	$("#f_a").val(roundNumber(f,3) + " hertz");
	if(f>1000) $("#f_a").val(roundNumber(f/1000,3) + " kilohertz");
	if(f>1000000) $("#f_a").val(roundNumber(f/1000000,3) + " megahertz");
	
	$("#duty_a").val(roundNumber(duty*100,3) + " %");
	
	$("#ton_a").val(roundNumber(ton*1000000,3) + " microseconds");
	if(ton>=0.001) $("#ton_a").val(roundNumber(ton*1000,3) + " milliseconds");
	if(ton>=1) $("#ton_a").val(roundNumber(ton,3) + " seconds");	
	
	$("#toff_a").val(roundNumber(toff*1000000,3) + " microseconds");
	if(toff>=0.001) $("#toff_a").val(roundNumber(toff*1000,3) + " milliseconds");
	if(toff>=1) $("#toff_a").val(roundNumber(toff,3) + " seconds");	
}
document.onreadystatechange = function () {
	if (document.readyState == "complete") {
		$("#555monoestable input").keyup(computemonoestable);
		$("#555monoestable select").change(computemonoestable);
		computemonoestable();	
		$("#555astable input").keyup(computeastable);
		$("#555astable select").change(computeastable);
		computeastable();	
	}
};
// 
</script>
<?php echo addBoxBeg('555 as Monostable');?>

<p>Given the value of the resistor and capacitor, this page calculates the high time of the output signal, in a 555 IC used as monostable.</p>
<form action="" id="555monoestable">
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
</select> Farads</p>
<p>T: <input id="t_m" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<p><img src="/images/555mono.png" alt="555 as monostable schematic" style="width:100%;max-width:580px;"/></p>
<p><img src="/images/555tiempos.png" alt="555 temporal diagram" style="width:100%;max-width:500px;"/></p>
</div></div>

<?php echo addBoxBeg('555 as Astable');?>
<p>Given the value of the resistors and the capacitor, this page calculates the period, frequency and duty cycle, of the 555 IC used in an astable configuration</p>
<form action="" id="555astable">
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
</select> Farads</p>
<p>T: <input id="t_a" disabled="disabled" class="w3-input w3-border"/></p>
<p>F: <input id="f_a" disabled="disabled" class="w3-input w3-border"/></p>
<p>Ton: <input id="ton_a" disabled="disabled" class="w3-input w3-border"/></p>
<p>Toff: <input id="toff_a" disabled="disabled" class="w3-input w3-border"/></p>
<p>Duty: <input id="duty_a" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<p><img src="/images/555astable.png" alt="555 as astable schematic"  style="width:100%;max-width:582px;"/></p>
<p><img src="/images/555atiempos.png" alt="555 temporal diagram" style="width:100%;max-width:421px;"/></p>
</div></div>

<p>Generally, the power supply needed for the 555 should be between 3 and 15 volts. Regarding the input voltage (in the monostable configuration), it shouldn't exceed VCC, and the detection threshold is 0.67*VCC (for the high side) and 0.33*VCC (for the low side)</p>
<p>To use relatively big times (in the order of tens or hundreds of seconds), the usage of a variation of the IC is needed. The 7555 IC is built using CMOS technology, and has less input and parasitic currents, so it allows the usage of bigger resistors and capacitors, allowing to get more accurate timings and better efficiency.</p>
<p>The capacitor in pin 5 helps to stabilize the circuit and attenuates the effect of external noise. For small prototypes it might be removed without harm, but it should be used when possible.</p>

<?php echo addBoxEnd();?>