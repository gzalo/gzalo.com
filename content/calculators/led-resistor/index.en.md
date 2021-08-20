---
title: "LED resistor calculator"
summary: "Given the type of LED and the voltage of a power supply, calculates the required resistor to connect it."
thumbnail: "/thumbs/led_resistor.png"
aliases: ["/led_resistor_en/"]
date: "2011-01-01"
---

Given the type of LED (nominal voltage and current) and the supply voltage, this page calculates the required resistor to connect the LED safely, as well as the required power that it will dissipate.

{{< rawhtml >}}
<form action="">
<p><label>Supply voltage [Volts]</label><input id="vfuente" value="5" type="number" /></p>
<p><label>LED voltage drop [Volts]</label><input id="vled" value="2" type="number"  /></p>
<p><label>LED current [Milliamps]</label><input id="iled" value="15"  type="number" /></p>
<p>Resistor <input id="r" disabled="disabled" /></p>
<p>Commercial value <input id="rCom" disabled="disabled" /></p>
<p>Power <input id="p" disabled="disabled" /><br/>A safety margin is advised, specially if the power is close to 1/8W (125mW) or 1/4W (250mW)</p>
</form>
<script src="/inc/calculators/led_resistor.js"></script>
{{< /rawhtml >}}

LED voltages (typical values):
* **Red**: 1.8 V to 2.2 V
* **Orange**: 2.1 V to 2.2 V
* **Yellow**: 2.1 V to 2.4 V
* **Green**: 2 V to 3.5 V
* **Blue**: 3.5 V to 3.8 V
* **White**: 3.6 V

LED currents (typical values):
* **Standard**: 20mA
* **High intensity Blue**: 30mA
* **Indicator LEDs**: 15mA