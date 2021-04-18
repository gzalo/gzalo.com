---
title: "Calculadora de overflow de timer"
summary: "Dada la configuración de un timer, calcula cada cuanto tiempo hace overflow."
thumbnail: "/thumbs/timer.png"
aliases: ["/timer/"]
---
Dada la configuración del timer, calcula el tiempo de overflow del mismo.

{{< rawhtml >}}
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
<script src="/inc/calculators/timer.js"></script>
{{< /rawhtml >}}