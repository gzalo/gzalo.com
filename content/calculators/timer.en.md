---
title: "Timer overflow calculator"
summary: "Given a timer configuration, it calculates how often it will overflow."
thumbnail: "/thumbs/timer.png"
aliases: ["/timer_en/"]
---

Given the timer configuration, this page calculates its overflow rate.

{{< rawhtml >}}
<form action="">
<p>Crystal: <input id="cristal" value="12" class="w3-input w3-border" type="number"/><select id="cristalScale" class="w3-select w3-border">
  <option>Kilo</option>
  <option selected="selected">Mega</option>
</select> Hertz</p>
<p>Machine cycle every: <input id="ciclo" disabled="disabled" class="w3-input w3-border"/></p>
<p>Total prescaler: <input id="prescaler" value="12" class="w3-input w3-border" type="number"/></p>
<p>Timer tick: <input id="tickTimer" disabled="disabled" class="w3-input w3-border"/></p>
<p>Recharge value: <input id="reload" value="64535" class="w3-input w3-border" type="number"/></p>
<p>Overflow frequency: <input id="freqover" disabled="disabled" class="w3-input w3-border"/></p>
<p>Overflow period: <input id="timeover" disabled="disabled" class="w3-input w3-border"/></p>
<p>Recharge value: 	<input id="rH" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<script src="/inc/calculators/timer.js"></script>
{{< /rawhtml >}}