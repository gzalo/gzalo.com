---
title: "Calculadora de resistencias para LEDs"
summary: "Dados el tipo de LED y la tensión de la fuente, calcula la resistencia necesaria para conectarlo."
thumbnail: "/thumbs/led_resistor.png"
aliases: ["/resistencias_led/"]
---

Dados el tipo de LED (su tensión y corriente nominal) y la tensión de la fuente, esta página muestra cuanto es la resistencia comercial más cercana para alimentar al LED de forma segura, así como la potencia que deberá disipar.

{{< rawhtml >}}
<form action="" class="w3-container">
<p><label class="w3-label">Tensión de la fuente [Volts]</label><input id="vfuente" value="5" class="w3-input w3-border" type="number"/></p>
<p><label class="w3-label">Caida de tensión del LED [Volts]</label><input id="vled" value="2" class="w3-input w3-border" type="number"/></p>
<p><label class="w3-label">Corriente del LED [Miliamperes]</label><input id="iled" value="15" class="w3-input w3-border" type="number"/></p>
<p>Resistencia <input id="r" disabled="disabled" class="w3-input w3-border"/></p>
<p>Resistencia comercial <input id="rCom" disabled="disabled" class="w3-input w3-border"/></p>
<p>Potencia <input id="p" disabled="disabled" class="w3-input w3-border"/><br/>Conviene dejar un margen de seguridad en el caso que esté muy cerca a 1/8W (125mW) o 1/4W (250mW)</p>
</form>
<script src="/inc/calculators/led_resistor.js"></script>
{{< /rawhtml >}}

Tensión del LED (valores típicos):
* **Rojo**: 1,8 V a 2,2 V
* **Naranja**: 2,1 V a 2,2 V
* **Amarillo**: 2,1 V a 2,4 V
* **Verde**: 2 V a 3,5 V
* **Azul**: 3,5 V a 3,8 V
* **Blanco**: 3,6 V

Corriente del LED (valores típicos):
* **Común**: 20mA
* **Azules alto brillo**: 30mA
* **Leds indicadores**: 15mA

	