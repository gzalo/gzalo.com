---
title: "Resistive divider calculator"
summary: "Given the value of two series resistors and an input voltage, it calculates the output voltage of a resistive divider."
thumbnail: "/thumbs/voltage_divider.png"
aliases: ["/resistive_divider_en/"]
---
Given the two values of the resistors and an input voltage, this page calculates the output voltage of the resistor divider.

{{< rawhtml >}}
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
<script src="/inc/calculators/voltage_divider.js"></script>
{{< /rawhtml >}}

![Resistive divider](/images/divisorresistivo.png)

A resistive divider (also called voltage divider) is a linear circuit that outputs a voltage (Vout) which is a fraction of the input voltage (Vin).

The circuit itself is based on two resistors in series, taking the middle node as the output. It's usually done to create a reference, or to attenuate a signal.

Whenever a load is connected to the output node, a loading effect is produced. This means that the output voltage drops. To avoid this, the current flowing by the resistors should be higher than the one flowing to the load. The disadvantage of doing this is that efficiency is low, as most of that current disipates as heat.

The output resistance is the equivalent of the paralell of both resistor, Rout = (R1*R2)/(R1+R2).
