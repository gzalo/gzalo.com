---
title: "Calculador de divisor resistivo"
summary: "Dadas dos resistencias y una tensión de entrada, calcula cual será la tensión de salida del divisor resistivo."
thumbnail: "/thumbs/voltage_divider.png"
aliases: ["/divisor_resistivo/"]
---

Dadas dos resistencias y una tensión de entrada, esta página calcula cual será la tensión de salida del divisor resistivo.

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

![Divisor resistivo](/images/divisorresistivo.png)

Un divisor resistivo (también llamado divisor de tensión o de potencial) es un circuito lineal que produce una tensión de salida `Vout` que es una fracción de la tensión de entrada `Vin`

El divisor de tensión más sencillo cuenta con dos resistencias conectadas en serie, tomando el nodo del medio como la tensión de salida. Suele ser usado para crear una tensión de referencia, o para obtener una señal de baja tensión proporcional a una tensión medida (a modo de atenuador de señal).

La carga conectada a la salida produce un efecto carga. Es decir, al conectarla disminuye la tensión de salida. Por esto, conviene que la corriente de entrada sea mucho mayor a la corriente de salida. La desventaja de hacer esto es que la mayor parte de la corriente de entrada se pierde en forma de calor en las resistencias.

La impedancia de salida del divisor resistivo es igual a la resistencia cuando R1 y R2 están en paralelo, es decir `Rout = (R1*R2)/(R1+R2)`.

