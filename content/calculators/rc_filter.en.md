---
title: "RC filter calculator"
summary: "Given the values of the resistor and capacitor, calculates the cutoff frequency of an RC series passive filter."
thumbnail: "/thumbs/rc_filter.png"
aliases: ["/rcfilter_en/"]
---

Given the value of the resistor and capacitor, this page calculates the cutoff frequency of a series RC passive filter

{{< rawhtml >}}
<form action="">
<p>R: <input id="r" value="1" class="w3-input w3-border" type="number"/><select id="rScale" class="w3-select w3-border">
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>C: <input id="c" value="31.833" class="w3-input w3-border" type="number"/><select id="cScale" class="w3-select w3-border">
  <option>Pico</option>
  <option>Nano</option>
  <option selected="selected">Micro</option>
  <option>Mili</option>
</select> Farads</p>
<p>F: <input id="f" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<script src="/inc/calculators/rc_filter.js"></script>
{{< /rawhtml >}}

![Low pass RC filter Schematic](/images/filtropasabajos.png)
![High pass RC filter Schematic](/images/filtropasaaltos.png)

The curve rate is 20 decibels per decade. At the cutoff frequency, the output voltage is 3 decibels (`0.707 times`) below the input voltage.

If the required capacitance is too big, and the resistance value can't be increased, it might be easier to implement the filter actively, using an opamp. [This site provides a calculator for that purpose](http://sim.okawa-denshi.jp/en/OPseikiLowkeisan.htm).

If the load impedance is around the filter impedances, the cutoff filter will be different from the one wanted. In that case, a simple analog buffer may be added, for instance by using an opamp as a voltage follower, in such a way that the load doesn't affect the filter itself.
