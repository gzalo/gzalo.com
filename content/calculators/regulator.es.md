---
title: "Calculador de regulador de tensión y corriente"
summary: "Dados el valor de las dos resistencias y el modelo de regulador, calcula cuanto es la tensión o corriente de salida de un regulador lineal, configurado como regulador de tensión o corriente."
thumbnail: "/thumbs/regulator.png"
aliases: ["/regulador/"]
---
## Regulador de tensión
Dados el valor de las dos resistencias y el modelo de regulador, esta página calcula cuanto es la tensión de salida de un regulador.

Dependiendo del modelo de regulador usado, la tensión de entrada deberá ser al menos 2 volts más que la deseada a la salida. Si se desea alimentar desde una tensión más baja, se puede utilizar un regulador del tipo "low-dropout" o LDO, que pueden operar sin necesitar tanta diferencia de tensión entre la entrada y salida.

{{< rawhtml >}}
<form action="" id="reguladorf_v">
<p>R1: <input id="r1_v" value="1.2" class="w3-input w3-border" type="number"/><select id="r1Scale_v" class="w3-select w3-border">
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>R2: <input id="r2_v" value="1.8" class="w3-input w3-border" type="number"/><select id="r2Scale_v" class="w3-select w3-border">
  <option></option>
  <option selected="selected">Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>Regulador: <select id="regulador_v"  class="w3-select w3-border">
  <option selected="selected">LM317</option>
  <option>7805</option>
  <option>7808</option>
  <option>7812</option>
  <option>7824</option>
</select></p>
<p>Vout: <input id="vout_v" disabled="disabled"  class="w3-input w3-border"/></p>
</form>
{{< /rawhtml >}}

![Esquematico regulador de tensión](/images/reguladortension.png)

## Regulador de corriente

Dados el valor de la resistencia y el modelo de regulador, esta página calcula cuanto es la corriente máxima de salida y la potencia maxima disipada por la resistencia.

{{< rawhtml >}}
<form action="" id="reguladorf_i">
<p>R: <input id="r_i" value="50" class="w3-input w3-border" type="number"/><select id="rScale_i" class="w3-select w3-border">
  <option selected="selected"></option>
  <option>Kilo</option>
  <option>Mega</option>
</select> Ohms</p>
<p>Regulador: <select id="regulador_i" class="w3-select w3-border">
  <option selected="selected">LM317</option>
  <option>7805</option>
  <option>7808</option>
  <option>7812</option>
  <option>7824</option>
</select></p>
<p>Iout: <input id="iout_i" disabled="disabled" class="w3-input w3-border"/></p>
<p>Pr: <input id="pout_i" disabled="disabled" class="w3-input w3-border"/></p>
</form>
<script src="/inc/calculators/regulator.js"></script>
{{< /rawhtml >}}

![Esquematico fuente de corriente](/images/reguladorcorriente.png)
