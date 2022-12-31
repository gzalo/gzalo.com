---
summary: "Calculates the times when using a 555 IC as a monostable or astable."
title: "Timers using 555"
thumbnail: "/thumbs/555.jpg"
aliases: ["/555_en/"]
date: "2011-01-01"
---

## 555 as Monostable

Given the value of the resistor and capacitor, this page calculates the high time of the output signal, in a 555 IC used as monostable.

{{< rawhtml >}}
<form action="" id="monoestable">
<p>R: <input id="r_m" value="4.7" type="number" /><select id="rScale_m" >
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>C: <input id="c_m" value="1" type="number" /><select id="cScale_m" >
  <option>Pico</option>
  <option>Nano</option>
  <option selected="selected">Micro</option>
  <option>Mili</option>
</select> Farads</p>
<p>T: <input id="t_m" disabled="disabled" /></p>
</form>
{{< /rawhtml >}}

![555 as monostable schematic](/images/555mono.png)
![555 temporal diagram](/images/555tiempos.png)

## 555 as Astable
Given the value of the resistors and the capacitor, this page calculates the period, frequency, and duty cycle of the 555 IC used in an astable configuration.

{{< rawhtml >}}
<form action="" id="astable">
<p>R1: <input id="r1_a" value="1" type="number" /><select id="r1Scale_a" >
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>R2: <input id="r2_a" value="10" type="number" /><select id="r2Scale_a" >
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>C:  <input id="c_a" value="1" type="number" /><select id="cScale_a" >
  <option>Pico</option>
  <option>Nano</option>
  <option selected="selected">Micro</option>
  <option>Mili</option>
</select> Farads</p>
<p>T: <input id="t_a" disabled="disabled" /></p>
<p>F: <input id="f_a" disabled="disabled" /></p>
<p>Ton: <input id="ton_a" disabled="disabled" /></p>
<p>Toff: <input id="toff_a" disabled="disabled" /></p>
<p>Duty: <input id="duty_a" disabled="disabled" /></p>
</form>
{{< /rawhtml >}}

![555 as astable schematic](/images/555astable.png)
![555 temporal diagram](/images/555atiempos.png)

Generally, the power supply needed for the 555 should be between 3 and 15 volts. Regarding the input voltage (in the monostable configuration), it shouldn't exceed `VCC`, and the detection threshold is `0.67 VCC` (for the high side) and `0.33 VCC` (for the low side).

To use relatively big times (in the order of tens or hundreds of seconds), the usage of a variation of the IC is needed. The 7555 IC is built using CMOS technology and has smaller input and parasitic currents. Thus it allows the usage of resistors and capacitors of greater values, allowing to get more accurate timings and better efficiency.

The capacitor in pin 5 helps to stabilize the circuit and attenuates the effect of external noise. For small prototypes, it can be removed without causing any issues, but it should be included when possible.

{{< rawhtml >}}
<script src="/inc/calculators/555.js"></script>
{{< /rawhtml >}}
