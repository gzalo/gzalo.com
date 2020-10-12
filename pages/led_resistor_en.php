<?php
	$descripcionPagina = '';
	$tituloPagina = 'LED resistor calculator';
	$lang = 'en';	
	echo addBoxBeg('LED resistor calculator');
?>
<script type="text/javascript">
// 
function Round3Dec(InputVal)
{
  return Math.round(InputVal * 1000) / 1000;
}

function NextHigherStandardResistor(Resistor_Ohms)
{
  var	Power10;
  var	Units;
  Power10 = 1;
  while (Resistor_Ohms > 8.2)
  {
    Power10 *= 10;
    Resistor_Ohms /= 10;
  }
  if (Resistor_Ohms < 1.0)
    Resistor_Ohms = 1.0;
  else if (Resistor_Ohms < 1.2)
    Resistor_Ohms = 1.2;
  else if (Resistor_Ohms < 1.5)
    Resistor_Ohms = 1.5;
  else if (Resistor_Ohms < 1.8)
    Resistor_Ohms = 1.8;
  else if (Resistor_Ohms < 2.2)
    Resistor_Ohms = 2.2;
  else if (Resistor_Ohms < 2.7)
    Resistor_Ohms = 2.7;
  else if (Resistor_Ohms < 3.3)
    Resistor_Ohms = 3.3;
  else if (Resistor_Ohms < 3.9)
    Resistor_Ohms = 3.9;
  else if (Resistor_Ohms < 4.7)
    Resistor_Ohms = 4.7;
  else if (Resistor_Ohms < 5.6)
    Resistor_Ohms = 5.6;
  else if (Resistor_Ohms < 6.8)
    Resistor_Ohms = 6.8;
  else
    Resistor_Ohms = 8.2;

  if (Power10 >= 1000000)
  {
    Units = " Megaohms";
    Power10 /= 1000000;
  }
  else if (Power10 >= 1000)
  {
    Units = " Kilohms";
    Power10 /= 1000;
  }
  else
  {
    Units = " Ohms";
  }

  Resistor_Ohms *= Power10;
  return "" + Round3Dec(Resistor_Ohms) + Units;
}

function compute(){	
	if(document.querySelector("#iled").value == 0) return;
	
	var rfinal = (document.querySelector("#vfuente").value - document.querySelector("#vled").value ) / (document.querySelector("#iled").value/1000);
	var cerca = NextHigherStandardResistor(rfinal);
	var pfinal = (document.querySelector("#vfuente").value - document.querySelector("#vled").value ) * (document.querySelector("#iled").value/1000);
	
	if(rfinal < 1000)
		document.querySelector("#r").value = Round3Dec(rfinal)+" Ohms";
	else if(rfinal < 1000000)
		document.querySelector("#r").value = Round3Dec(rfinal/1000)+" Kilohms";
	else
		document.querySelector("#r").value = Round3Dec(rfinal/1000000)+" Megaohms";
	
	document.querySelector("#rCom").value = cerca;
	
	if(pfinal > 1)
		document.querySelector("#p").value = Round3Dec(pfinal)+" Watts";
	else if(pfinal > 0.001)
		document.querySelector("#p").value = Round3Dec(pfinal*1000)+" Miliwatts";
	else
		document.querySelector("#p").value = Round3Dec(pfinal*1000000)+" Microwatts";
	
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
};
// 
</script>
<p>Given the type of LED (nominal voltage and current) and the supply voltage, this page calculates the required resistor to connect the LED safely, as well as the required power that it will dissipate.</p>
<form action="" class="w3-container">
<p><label class="w3-label">Supply voltage [Volts]</label><input id="vfuente" value="5" type="number" class="w3-input w3-border"/></p>
<p><label class="w3-label">LED voltage drop [Volts]</label><input id="vled" value="2" type="number"  class="w3-input w3-border"/></p>
<p><label class="w3-label">LED current [Milliamps]</label><input id="iled" value="15"  type="number" class="w3-input w3-border"/></p>
<p>Resistor <input id="r" disabled="disabled" class="w3-input w3-border"/></p>
<p>Commercial value <input id="rCom" disabled="disabled" class="w3-input w3-border"/></p>
<p>Power <input id="p" disabled="disabled" class="w3-input w3-border"/><br/>A safety margin is advised, specially if the power is close to 1/8W (125mW) or 1/4W (250mW)</p>
</form>
<p>LED voltages (typical values):
	<ul class="w3-ul">
		<li><strong>Red</strong>: 1,8 V to 2,2 V</li>
		<li><strong>Orange</strong>: 2,1 V to 2,2 V</li>
		<li><strong>Yellow</strong>: 2,1 V to 2,4 V</li>
		<li><strong>Green</strong>: 2 V to 3,5 V</li>
		<li><strong>Blue</strong>: 3,5 V to 3,8 V</li>
		<li><strong>White</strong>: 3,6 V</li>
	</ul></p>
<p>LED currents (typical values):
	<ul class="w3-ul">
		<li><strong>Standard</strong>: 20mA</li>
		<li><strong>High intensity Blue</strong>: 30mA</li>
		<li><strong>Indicator LEDs</strong>: 15mA</li>
	</ul>
</p>
	<?php echo addBoxEnd();?>