---
title: "Voltage and current regulator calculator"
summary: "Given the values of both resistors and the type of regulator, calculates the output voltage or current of a linear regulator, both in voltage and current regulation mode."
thumbnail: "/thumbs/regulator.jpg"
aliases: ["/regulator_en/"]
date: "2011-01-01"
---
## Voltage regulator
Given the value of both resistors, and the regulator model, this page calculates the output voltage of the regulator.

Depending on the regulator model, the input voltage should be at least 2 volts higher than the desired output voltage. If a lower input voltage is required, a low dropout (LDO) regulator should be used instead, since they can operate without requiring a high voltage drop. For higher efficiency or a voltage booster, a switching regulator is suggested.

{{< rawhtml >}}
<form action="" id="reguladorf_v">
<p>R1: <input id="r1_v" value="1.2"  type="number"/><select id="r1Scale_v" >
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>R2: <input id="r2_v" value="1.8"  type="number"/><select id="r2Scale_v" >
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>Regulator: <select id="regulador_v"  >
  <option selected="selected">LM317</option>
  <option>7805</option>
  <option>7808</option>
  <option>7812</option>
  <option>7824</option>
</select></p>
<p>Vout: <input id="vout_v" disabled="disabled"  /></p>
</form>
{{< /rawhtml >}}

![Voltage regulator schematic](/images/reguladortension.png)

## Current regulator
Given the value of the resistor and the regulator model, this page calculates the maximum output current, as well as the power dissipated by the resistor in the worst case.

{{< rawhtml >}}
<form action="" id="reguladorf_i">
<p>R: <input id="r_i" value="50"  type="number"/><select id="rScale_i"  >
  <option selected="selected"></option>
  <option>Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>Regulator: <select id="regulador_i"  >
  <option selected="selected">LM317</option>
  <option>7805</option>
  <option>7808</option>
  <option>7812</option>
  <option>7824</option>
</select></p>
<p>Iout: <input id="iout_i" disabled="disabled" /></p>
<p>Pr: <input id="pout_i" disabled="disabled" /></p>
</form>
<script src="/inc/calculators/regulator.js"></script>
{{< /rawhtml >}}

![Current source schematic](/images/reguladorcorriente.png)
