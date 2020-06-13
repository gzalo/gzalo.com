<?php
	$descripcionPagina = '';
	$tituloPagina = 'Analog to digital converter without ADC';
	$lang = 'en';		
	
	echo addBox('Analog to digital converter without ADC','<p>There are some low cost systems in which the reading of some sensors, potentiometers or other analog devices is required, by using a cheap microcontroller without integrated analog to digital converter.</p>
<p>Adding an external ADC might require more microcontroller pins, more space in the PCB or more software complexity (for instance, I2C routines may be needed if that\'s the used bus).</p>
<p>If there aren\'t many requirements regarding resolution, accuracy, lineality, sample time, the solution is to use an RC circuit, and measure the time it takes to charge (similar to a double ramp ADC)</p>
<img src="/images/rc.png" alt="RC circuit" style="width:100%;max-width:500px;"/>
<p>The resistor may be changed to a thermistor (PTC or NTC) if the temperature is the variable to be measured, or a LDR to measure luminosity. It\'s also possible to use a capacitive sensor, by using a fixed resistor.</p>
<p>It\'s needed to have a bidirectional pin in the microcontroller, which also should allow to set a high impedance (High-Z) state</p>
<p>The principle is the following:: </p>
<ul>
	<li>Set the terminal to high for around 1ms, to charge the capacitor</li>
	<li>Set the terminal in high z state and measure how long the capacitor holds the charge.</li>
	<li>Repeat the cycle according to the desired sample rate.</li>
</ul>
<img src="/images/descarga.png" alt="Charge discharge RC cycle" style="width:100%;max-width:382px;"/>
<p>A small way to program it would be the following:</p>
<div class="w3-code">
	uint16_t time=0;<br/>
	DIR_LOAD = OUTPUT;<br/>
	PIN_LOAD = 1; delay1ms(); PIN_LOAD = 0; //Charge the capacitor<br/>
	DIR_LOAD = INPUT;<br/>
	while(PIN_LOAD == 0) time++; //Wait for the discharge<br/>
	</div>
<p>The 16 bit output should then be scaled to get a correct value according to the resistor. To avoid wasting CPU time in the while loop, an internal capture module may be used to easily count the interval during which the pin was in a high state. This method works best with pins that feature Schmitt Trigger capability, since it helps to remove the dependance of the supply voltage in the measured times. </p>');


