---
title: "Calculadora de filtro RC"
summary: "Dados el valor de la resistencia y el capacitor, calcula cuanto es la frecuencia de corte en un filtro pasivo RC serie."
thumbnail: "/thumbs/rc_filter.png"
aliases: ["/filtrorc/"]
---

Dados el valor de la resistencia y el capacitor, esta página calcula cuanto es la frecuencia de corte en un filtro pasivo RC serie.

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
</select> Faradios</p>
<p>F: <input id="f" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<script src="/inc/calculators/rc_filter.js"></script>
{{< /rawhtml >}}

![Esquematico Filtro RC pasa bajos](/images/filtropasabajos.png)
![Esquematico Filtro RC pasa altos](/images/filtropasaaltos.png)

La pendiente es de 20 decibeles por década. A la frecuecia de corte, la tensión de salida está 3 dB (0.707 veces) por debajo de la entrada.

El capacitor debería ser no polarizado, para que el filtro sirva con cualquier señal alterna de entrada. Además, si se usa un capacitor electrolítico hay problemas ya que suelen tener porcentajes de tolerancia muy altos (es decir, mucha dispersión de valores de capacidad), lo que hace que la frecuencia de corte sea distinta a la deseada, y además cambie considerablemente con la temperatura.

Si el capacitor necesario es muy grande, y no se puede aumentar la resistencia, posiblemente convenga implementar el filtro de forma activa, con un amplificador operacional. [En este sitio hay una calculadora para eso](http://sim.okawa-denshi.jp/en/OPseikiLowkeisan.htm).

Si la resistencia carga es del orden de las impedancias del filtro, la frecuencia de corte será distinta a la deseada. En ese caso convendría agregar un buffer, amplificador operacional puesto como seguidor de voltaje, de forma tal que no influya la carga en el filtro propiamente dicho.

