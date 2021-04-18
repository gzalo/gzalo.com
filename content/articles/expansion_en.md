---
title: ""
tags: ["articles", "electronics"]
summary: ""
thumbnail: "/thumbs/.png"
aliases: ["/expansion_en/"]
---

addProjectBox('Input/output port expansion', 'How to add more digital inputs or outputs to a microcontroller, using shift registers.','/thumbs/expandir.png','/expansion_en/');

$tituloPagina = 'Input/output port expansion';
<p>In some projects, more inputs or outputs than the microcontroller can handle are needed. These are some solutions:</p>
<ul>
	<li>Use a PPI IC like the old 8255 (slow and big), parallel interface, uses 10 extra terminals and provides 3 extra 8-bit I/O ports.</li>
	<li>Use an I2C expansor, like PCF8575 (hard to find, possibly expensive)</li>
	<li>Use 74xxx logic (cheap, easy to program and high availability)</li>
</ul>
<br/>
<p>This article will focus on the third option, and mainly for single directional pins</p>
<h3>Expanding outputs</h3>
<p>The two main ICs are 74x164 (no latch) and 74x595 (with latch). Multiple ICs can be put in a cascade, in such a way that each one of them adds 8 extra outputs.</p>
<p>They are made of shift registers, type D flip-flops chained, so the data can be "pushed" from one side and the 8 bits can be accessed.</p>
<img src="/images/74164.png" alt="Shift register diagram" style="width:100%;max-width:700px;"/>
<p>They have 3 control terminals:</p>
<ul>
	<li>Clock: Given a pulse, the data shifts through the flip flips, and a new bit enters from the leftmost FF.</li>
	<li>Data: They receive the new value to add to the first flip flop.</li>
	<li>Reset: When a pulse is applied, all the bits go to a 0 state</li>
</ul><br/>
<p>Some ICs, like 74x595 have an extra terminal, that when pulsed makes the data transfer to the output. That means that the changes are done to internal flip flops, and when activating the latch pin, the bits appear in the device terminals.</p>
<img src="/images/74595.png" alt="Shift register with latch diagram" style="width:100%;max-width:280px;"/>
<p>If the outputs shouldn't show glitches while data is changing (for instance, lights, relays or motors), a shift register with latch should be used.</p>
<p>Writing a value is quite easy:</p>
<ol>
	<li>For each bit: (starting by the rightmost one)
		<ol>
			<li>Place the bit in the data terminal</li>
			<li>Make a pulse in the clock terminal</li>
		</ol>
	</li>
	<li>Make a pulse in the "Latch" terminal (if applicable), to change the state of the outputs to the one desired.</li>
</ol><br/>
<p>This image shows how to put multiple shift registers in a chain:</p>
<img src="/images/74164_cascada.png" alt="Shift registers en cascada" style="width:100%;max-width:388px;"/>
<p>A typical application of this circuit is to drive big LED matrices, using only a few terminals of a microcontroller:</p>
<img src="/images/megamatrix_dsn.png" alt="LED matrix schematic" style="width:100%;max-width:700px;"/>
<h3>Expanding inputs</h3>
<p>In order to expand inputs, ICs such as 4014 can be used. They work in a similar fashion, with the difference that the shift registers are paralell input and serial output. The sequence to read the bits is the following:</p>
<ol>
	<li>Make a pulse in the Latch terminal</li>
	<li>For each bit[i]: (starting from the right)
		<ol>	
			<li>Read "Data" terminal, store in bit[i]</li>
			<li>Make a pulse in the clock terminal</li>
			<li>Increment i</li>
		</ol>
	</li>
</ol><br/>
<p>This image shows how to expand inputs using multiple shift registers chained.<br/>
<img src="/images/4014.png" alt="Multiple shift registers for input expansion" style="width:100%;max-width:275px;"/></p>
