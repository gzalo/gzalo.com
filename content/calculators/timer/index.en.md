---
title: "Timer overflow calculator"
summary: "Given a timer configuration, it calculates how often it will overflow."
thumbnail: "/thumbs/timer.png"
aliases: ["/timer_en/"]
date: "2011-01-01"
---

Given the timer configuration, this page calculates its overflow rate.

{{< rawhtml >}}
<form action="">
<p>Crystal: <input id="cristal" value="12"  type="number"/><select id="cristalScale" >
  <option>Kilo</option>
  <option selected="selected">Mega</option>
</select> Hertz</p>
<p>Machine cycle every: <input id="ciclo" disabled="disabled" /></p>
<p>Total prescaler: <input id="prescaler" value="12"  type="number"/></p>
<p>Timer tick: <input id="tickTimer" disabled="disabled" /></p>
<p>Recharge value: <input id="reload" value="64535"  type="number"/></p>
<p>Overflow frequency: <input id="freqover" disabled="disabled" /></p>
<p>Overflow period: <input id="timeover" disabled="disabled" /></p>
<p>Recharge value: 	<input id="rH" disabled="disabled" /></p>
</form>
<script src="/inc/calculators/timer.js"></script>
{{< /rawhtml >}}