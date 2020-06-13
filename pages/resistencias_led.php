<?php
	$descripcionPagina = 'Dados el tipo de LED y la tensión de la fuente, calcula la resistencia necesaria para conectarlo.';
	$tituloPagina = 'Calculadora de resistencias para LEDs';
	
	echo addBoxBeg('Calculadora de resistencias para LEDs');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
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
	if($("#iled").val() == 0) return;
	
	var rfinal = ($("#vfuente").val() - $("#vled").val() ) / ($("#iled").val()/1000);
	var cerca = NextHigherStandardResistor(rfinal);
	var pfinal = ($("#vfuente").val() - $("#vled").val() ) * ($("#iled").val()/1000);
	
	if(rfinal < 1000)
		$("#r").val(Round3Dec(rfinal)+" Ohms");
	else if(rfinal < 1000000)
		$("#r").val(Round3Dec(rfinal/1000)+" Kilohms");
	else
		$("#r").val(Round3Dec(rfinal/1000000)+" Megaohms");
	
	$("#rCom").val(cerca);
	
	if(pfinal > 1)
		$("#p").val(Round3Dec(pfinal)+" Watts");
	else if(pfinal > 0.001)
		$("#p").val(Round3Dec(pfinal*1000)+" Miliwatts");
	else
		$("#p").val(Round3Dec(pfinal*1000000)+" Microwatts");
	
}
document.onreadystatechange = function () {
	if (document.readyState == "complete") {
	$("input").keyup(compute);
	$("select").change(compute);
	compute();	
	}
};
// 
</script>
<p>Dados el tipo de LED (su tensión y corriente nominal) y la tensión de la fuente, esta página muestra cuanto es la resistencia comercial más cercana para alimentar al LED de forma segura, así como la potencia que deberá disipar.</p>
<form action="" class="w3-container">
<p><label class="w3-label">Tensión de la fuente [Volts]</label><input id="vfuente" value="5" class="w3-input w3-border" type="number"/></p>
<p><label class="w3-label">Caida de tensión del LED [Volts]</label><input id="vled" value="2" class="w3-input w3-border" type="number"/></p>
<p><label class="w3-label">Corriente del LED [Miliamperes]</label><input id="iled" value="15" class="w3-input w3-border" type="number"/></p>
<p>Resistencia <input id="r" disabled="disabled" class="w3-input w3-border"/></p>
<p>Resistencia comercial <input id="rCom" disabled="disabled" class="w3-input w3-border"/></p>
<p>Potencia <input id="p" disabled="disabled" class="w3-input w3-border"/><br/>Conviene dejar un margen de seguridad en el caso que esté muy cerca a 1/8W (125mW) o 1/4W (250mW)</p>
</form>
<p>
Tensión/Voltaje del LED (valores típicos):
	<ul class="w3-ul">
		<li><strong>Rojo</strong>: 1,8 V a 2,2 V</li>
		<li><strong>Naranja</strong>: 2,1 V a 2,2 V</li>
		<li><strong>Amarillo</strong>: 2,1 V a 2,4 V</li>
		<li><strong>Verde</strong>: 2 V a 3,5 V</li>
		<li><strong>Azul</strong>: 3,5 V a 3,8 V</li>
		<li><strong>Blanco</strong>: 3,6 V</li>
	</ul>
</p>	
<p>Corriente del LED (valores típicos):
	<ul class="w3-ul">
		<li><strong>Com&uacute;n</strong>: 20mA</li>
		<li><strong>Azules alto brillo</strong>: 30mA</li>
		<li><strong>Leds indicadores</strong>: 15mA</li>
	</ul>
</p>
	
	<?php echo addBoxEnd();?>