<?php
	$descripcionPagina = 'How to drive Graphical LCDs of 128x64 (or 192x64) resolution with KS0108 controller, by using a microcontroller and two I/O ports';
	$tituloPagina = 'Graphical LCDs based on KS0108';
	$lang = 'en';	
	
	echo addBoxBeg('Graphical LCDs based on KS0108');
?>
<p>Most monochromatic graphical LCDs use a controller compatible with KS0108. Each one has an internal 512 byte memory, so it allows resolutions up to 64x64 pixels. Bigger displays tend to use multiple controllers, one per fraction of the screen. For instance, a 128x64 lcd has 2 controllers, a 196x64 has 3, and a 128x128 has 4 of them.</p>
<p>Each controller is independent, they don't transmit information between them. In order to choose which controller has to be activated, two control lines are used: CS1 and CS2 (chip select), acting like a 2 bit address which can select up to four different ICs. They don't have an internal font generator, so in order to write text the driver has to store the pixels of each wanted glyph, in a microcontroller or an external memory.</p>
<p>The LCDs have this terminals.
	<ul>
		<li>VSS: 0V, ground reference</li>
		<li>VDD: 5V, supply voltage for LCD</li>
		<li>V0: Contrast adjustment</li>
		<li>D/I: selects between Data (1) or Instruction (0)</li>
		<li>R/W: selects between reading (1) or writing (0) to the controller</li>
		<li>E: When a pulse is applied, the data transfer happens</li>
		<li>DB0..7: Data bus (8-bit bus)</li>
		<li>CS1..2: Lines to select the controller</li>
		<li>RES: Reset signal, if 0 all controllers get reseted</li>
		<li>Vee: Negative voltage OUTPUT</li>
		<li>K y A: Backlight, typically LEDs</li>
	</ul>
</p>
<p>Most LCDs feature an internal negative voltage generator, which is needed by the controller to turn on the segments. To control the contrast, a 20 kiloohm preset can be used, connected between Vee and Vss (extremes) and the middle terminal (wiper) can be connected to V0. A and K terminals are typically connected to LEDs in the side of the display, and should be connected to 5V and 0V, with a series resistance of 100-200 ohm to make sure that they don't have a high current.</p>
<p>How to send a command or data to the LCD::
	<ol>
		<li>Select the wanted controller (CS1 and CS2)</li>
		<li>Set D/I line in the wanted stete: 1 if a command needs to be sent, 0 if data will be sent</li>
		<li>Place the data or the command in the data bus</li>
		<li>Make a pulse in the E line</li>
		<li>Wait a small time (~500nS). Alternatively, the LCD status can be read to avoid hardcoding delays in the code.</li>
	</ol>
</p>
<p>The display itself is divided in 8 horizontal pages (each with 8 pixels of height) and 64 vertical lines.</p>
<h3>Important commands</h3>
<h4>Turn on/off display</h4>
<p>D/I = 0, DB = 0x3F (on) or 0x3E (off)</p>
<h4>Move pointer - X axis</h4>
<p>D/I = 0, DB = 0x40 + line (0 to 63)</p>
<h4>Move pointer - Y axis</h4>
<p>D/I = 0, DB = 0x9C + page (0 to 7)</p>
<h4>Write data to screen</h4>
<p>D/I = 1, DB = DataToWrite<br/>The data is written into the place stored by the pointer. After writing a value, the X position is incremented, in order to avoid fast copies.</p>

<?php echo addBoxEnd();?>