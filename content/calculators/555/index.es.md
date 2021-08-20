---
summary: "Calcula cuanto es el tiempo que la señal de salida estará activa, en un circuito integrado 555 configurado como monoestable o astable."
title: "Calculadora de tiempos con 555"
thumbnail: "/thumbs/555.png"
aliases: ["/555/"]
date: "2011-01-01"
---

### 555 como Monoestable

Dados el valor de la resistencia y el capacitor, esta página calcula cuanto es el tiempo que la señal de salida estará activa, en un 555 configurado como monoestable.

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
</select> Faradios</p>
<p>T: <input id="t_m" disabled="disabled" /></p>
</form>
{{< /rawhtml >}}

![Esquematico Monoestable con 555](/images/555mono.png)
![Diagrama temporal 555](/images/555tiempos.png)

### 555 como Astable

Dados el valor de las resistencias y el capacitor, esta página calcula cuanto es el período, frecuencia y duty cycle, en un 555 configurado como astable.

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
</select> Faradios</p>
<p>T: <input id="t_a" disabled="disabled" /></p>
<p>F: <input id="f_a" disabled="disabled" /></p>
<p>Ton: <input id="ton_a" disabled="disabled" /></p>
<p>Toff: <input id="toff_a" disabled="disabled" /></p>
<p>Duty: <input id="duty_a" disabled="disabled" /></p>
</form>
{{< /rawhtml >}}

![Esquematico Astable con 555](/images/555astable.png)
![Diagrama temporal 555](/images/555atiempos.png)
		
Por lo general, el 555 se alimenta entre 3 y 15 volts. Para la tensión de la entrada, en el caso de la configuración monoestable, no debería pasarse mucho de `VCC` y se detecta el flanco positivo al superar `0.67 VCC` y como flanco negativo al reducirse por debajo de `0.33 VCC`.

Para utilizar tiempos relativamente grandes, es necesario emplear una variación del timer 555, el 7555, que es CMOS y por lo tanto tiene menores corrientes de entrada, lo que permite utilizar resistencias y capacitores más grandes para lograr una salida precisa.

El capacitor que va en el pin 5, ayuda a estabilizar al circuito y evitar que entre ruido externo al integrado, para prototipos rápidos podría no ser necesario.

{{< rawhtml >}}
<script src="/inc/calculators/555.js"></script>
{{< /rawhtml >}}
