---
title: "Resistive divider calculator"
summary: "Given the value of two series resistors and an input voltage, it calculates the output voltage of a resistive divider."
thumbnail: "/thumbs/voltage_divider.jpg"
aliases: ["/resistive_divider_en/"]
date: "2011-01-01"
---

Given the two values of the resistors and an input voltage, this page calculates the output voltage of the resistor divider.

{{< rawhtml >}}
<form action="">
<p>R1: <input name="r1" value="2.7" id="r1"  type="number"/><select name="r1Scale" id="r1Scale" >
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select>Ohms</p>
<p>R2: <input name="r2" value="5.6" id="r2"  type="number"/><select name="r2Scale" id="r2Scale" >
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select>Ohms</p>
<p>Vin [Volts]<input name="vin" value="5" id="vin"  type="number"/></p>
<p>Vout <input name="vout" disabled="disabled" id="vout" /></p>
</form>
<script src="/inc/calculators/voltage_divider.js"></script>
{{< /rawhtml >}}

![Resistive divider](/images/divisorresistivo.png)

A resistive divider (also called voltage divider) is a linear circuit that outputs a `Vout` voltage which is a fraction of `Vin` (input voltage).

The circuit itself is based on two resistors in series, taking the middle node as the output. It's typically used to create a reference or to attenuate a signal.

Whenever a load is connected to the output node, a loading effect can be seen (the output voltage drops). To avoid this, the current of the resistors should be higher than the load current. The disadvantage of doing this is that efficiency is low, as most of the total current dissipates as heat outside of the load.

The output resistance is the equivalent of the parallel of both resistors, `Rout = (R1*R2)/(R1+R2)`.
