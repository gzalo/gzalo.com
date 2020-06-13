<?php
	$descripcionPagina = 'Cómo leer datos analógicos desde un microcontrolador que solamente tiene entradas/salidas digitales.';
	$tituloPagina = 'Convertir una tensión en un valor digital, sin usar ADC';
	
	echo addBox('Conversión analógica-digital sin ADC','<p>Hay sistemas en los que se necesita leer desde sensores, potenciómetros u otros dispositivos analógicos, desde un microcontrolador de bajo costo, sin conversores analógicos digitales integrados.</p>
<p>Acoplar un ADC externo hace que necesitemos más terminales en el microcontrolador (lo usual es que el valor muestreado se lee desde un bus de datos de 8 bits, como en el típico ADC0808), más espacio en el circuito impreso, o más complejidad en el software (por ejemplo, habría que programar rutinas para comunicarse via I2C con el ADC)</p>
<p>Si no nos interesa la resolución, precisión, linealidad, tiempo de sampleo, una solución es usar un circuito RC, usando un estilo de conversión similar al de doble rampa, pero sin integrar, unicamente contando el tiempo que tarda en descargarse el RC</p>
<img src="/images/rc.png" alt="Circuito RC" style="width:100%;max-width:500px;"/>
<p>La resistencia puede ser cambiada por un termistor (PTC o NTC) si se quiere medir temperatura, o un LDR si se quiere medir luminosidad. También es posible usar un sensor capacitivo, usando una resistencia de valor conocido.</p>
<p>Es necesario tener un terminal bidireccional (de entrada/salida) en el microcontrolador, que además permita establecer un estado de alta impedancia</p>
<p>El principio de funcionamiento es el siguiente: </p>
<ul>
	<li>Ponemos el terminal en positivo durante 1 ms, para cargar el capacitor</li>
	<li>Ponemos el terminal en modo entrada (alta impedancia) y medimos cuanto tarda en descargarse el capacitor</li>
	<li>Repetimos este ciclo cada 50ms</li>
</ul>
<img src="/images/descarga.png" alt="Ciclo carga descarga capacitor" style="width:100%;max-width:382px;"/>
<p>Un pequeño ejemplo de como programarlo sería el siguiente:</p>
<div class="w3-code">
	uint16_t tiempo = 0;<br/>
	DIR_CARGA = SALIDA;<br/>
	PIN_CARGA = 1; delay1ms(); PIN_CARGA = 0; //Cargar el capacitor	<br/>
	DIR_CARGA = ENTRADA;<br/>
	while(PIN_CARGA == 0) tiempo++; //Esperar descarga<br/>
	</div>
<p>Al valor resultante (16 bits) habría que restarle una constante, y escalarlo para obtener un valor entre 0 y 0xFF. Si se desea que el microcontrolador pueda hacer otras cosas mientras se está "muestreando", se podría usar algún módulo de captura del microcontrolador, que cuente cuanto tiempo estuvo en alto la señal.</p>
');
?>
