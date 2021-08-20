---
title: "Calculadora de overflow de timer"
summary: "Dada la configuración de un timer, calcula cada cuanto tiempo hace overflow."
thumbnail: "/thumbs/timer.png"
aliases: ["/timer/"]
date: "2011-01-01"
---
Dada la configuración del timer, calcula el tiempo de overflow del mismo.

{{< rawhtml >}}
<form action="">
<p>Cristal: <input id="cristal" value="12"  type="number"/><select id="cristalScale" >
  <option>Kilo</option>
  <option selected="selected">Mega</option>
</select> Hertz</p>
<p>Ciclo de máquina cada: <input id="ciclo" disabled="disabled" /></p>
<p>Prescaler: <input id="prescaler" value="12"  type="number"/></p>
<p>Tick de timer: <input id="tickTimer" disabled="disabled" /></p>
<p>Valor de recarga: <input id="reload" value="64535"  type="number"/></p>
<p>Frecuencia de overflow: <input id="freqover" disabled="disabled" /></p>
<p>Período de overflow: <input id="timeover" disabled="disabled" /></p>
<p>Valor de recarga: 	<input id="rH" disabled="disabled" /></p>
</form>
<script src="/inc/calculators/timer.js"></script>
{{< /rawhtml >}}