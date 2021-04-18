---
title: ""
tags: ["articles", "electronics"]
summary: ""
thumbnail: "/thumbs/.png"
aliases: ["//"]
---

addProjectBox('Alphanumeric LCDs based on HD44780', 'How to control an Alphanumeric LCD using a microcontroller. Includes commands and schematics.','/thumbs/lcdalfanumerico.png','/alphanumericlcd_en/');

$descripcionPagina = 'How to control alphanumeric LCDs based on the HD44780 controller. Includes commands and schematics.';
	$tituloPagina = 'Alphanumeric LCDs based on HD44780';
<p>Most alphanumeric LCDs (sometimes called smart LCDs, since they include a controller in the same board and don't need a powerful CPU to use them) are an industrial standard designed for interfacing with embedded system (mostly microcontrollers or microprocessors). They come in a lot of different configurations, 8x1 (1 row, 8 characters per row), 16x2, 20x4, and even bigger ones are available.</p>
<p>This LCDs are designed to show text (and up to 8 custom defined characters) so they are used in simple machines that don't need to display complex information, such as printers, faxes, copiers, etc. They can include backlight, which can be flourescent or more commonly LEDs</p>
<p>They often come with a 16 pin interface, with the following typical pinout:</p>
<ul>
	<li>Ground</li>
	<li>VCC (3.3 o 5V)</li>
	<li>Contrast adjustment (VO)</li>
	<li>RS (Register selection: RS=0 means command, RS=1 means data)</li>
	<li>RW (Operation selection: RW=0 writes, RW=1 reads)</li>
	<li>Enable (activated in the falling edge)</li>
	<li>Bit[0..7] (Data bus)</li>
	<li>Optional: Backlight anode (+)</li>
	<li>Optional: Backlight cathode (-)</li>
</ul><br/>
<p>The LCDs can operate in both a 4 bit and an 8 bit mode. In the first one, bytes are sent divided into 4 bit nibbles, sending them first in the higher nibble of the data bus (Bit[4..7]). The commands in the 4 bit mode are the same, the only thing that changes is the initialization process.</p>
<p>The internal ROM usually has every ASCII and sometimes greek or japanese characters. It's possible to use up to 8 custom defined characters (corresponding to ASCII positions 0 to 7) which are stored in volatile RAM.</p>
<p>A computer can easily control one of this LCDs, using the <a href="http://lcdsmartie.sourceforge.net/">LCD Smartie</a> program and a simple paralell port adapter.</p>
<p>To connect it to a microcontroller, this connection is advised:</p>
<img src="/images/lcdalfa.png" alt="HD44780 Alphanumeric LCD connection" style="width:100%;max-width:447px;"/>
<p>As it can be seen in the image, the contrast adjustment is done with a 10K potentiometer, in a resistive divider configuration. RW terminal was grounded since most applications don't need to read from the LCD. Data lines must be connected to a port of the microcontroller (mantaining the order). Control lines should be connected as well.</p>
<p>Sending a command or data to the LCD:
	<ol>
		<li>Set RS terminal to 0 (data) or 1 (command)oner RS en el estado correcto: 0 si se desea escribir un comando, 1 si se desea escribir datos</li>
		<li>Set the data bus to the desired 8 bit value</li>
		<li>Do a pulse in E pin</li>
		<li>Wait for a small time (depending on instruction executed)</li>
	</ol>
</p>
<p>As it can be seen, its a pretty simple process. After turning on, the controller does some internal tests, cleans its memory, which can take up to 20 milliseconds. That's why a delay might be needed, to ensure a proper initialization of the controller of the LCD.</p>
<p>Important commands:</p>
<h3>Erase screen</h3>
<p>RS = 0, Data = 0000 0001, Time: 2 ms<br/>Action: Erases the LCD, places the cursor in position 0</p>
<h3>Turning ON/OFF the display</h3>
<p>RS = 0, Data = 0000 1DCB, Time: 40 us<br/>Actions: 
	<ul>
		<li>Turns on (D=1) or off (D=0) the LCD</li>
		<li>Turns on (C=1) or off (C=0) the cursor</li>
		<li>Turns on (B=1) or off (B=0) the blinking of the cursor</li>
	</ul>
</p>
<h3>Function selection</h3>
<p>RS = 0, Data = 001 BNF--, Time: 40 us<br/>Actions:
	<ul>
		<li>Chooses 8-bit (B=1) or 4-bits (B=0) interface</li>
		<li>Chooses 2 line (N=1) or 1 line (N=0) - bigger displays need to use 2 line mode</li>
		<li>Chooses 5x8 (F=0) or 5x10 (F=1) characters (doesn't do anything in most LCDs)</li>
	</ul>
</p>
<h3>DD direction selection</h3>
<p>RS = 0, Data = 1ADDRESS, Time: 40 us<br/>Actions: Selects the address of the internal memory that will be affected in read and writes.</p>
<p>The DD memory stores every character shown in screen. For instance, in a 20x4 LCD, the lines are in the following memory positions:
	<ul>
		<li>Line 0: Position 0</li>
		<li>Line 1: Position 64</li>
		<li>Line 2: Position 20</li>
		<li>Line 3: Position 84</li>
	</ul>
</p>
<h3>Write data</h3>
<p>RS = 1, Data = ASCIICHAR, Time: 40 us<br/>Action: Writes the specified data to the direction previously set, and increments the internal pointer.</p>
<h3>Init sequence (8 bits mode)</h3>
<p>The full initialization sequence is the following:
	<ol>
		<li>Wait 20 ms after power on</li>
		<li>Send command 0000 1110 (LCD on, cursor on, blinking off)</li>
		<li>Wait 40 us</li>
		<li>Send command 0000 0110 (text direction: right)</li>
		<li>Wait 40 us</li>
		<li>Send command 0011 1000 (8-bit bus, 4 lines, 5x8 font)</li>		
		<li>Wait 40 us</li>
	</ol>
</p>
<p>After doing the init sequence, writing a character in an (x;y) position is as easy as doing the following:
	<ol>
		<li>Calculating the correct memory position: MemPos = LineStartAddress[y] + x</li>
		<li>Send command 1MemPos to move the internal pointer to that position</li>
		<li>Wait 40 us</li>
		<li>Send the code of the ASCII character to be writen as a data</li>
	</ol>
</p>
<p>After doing that, the desired character will appear in the LCD, in the selected position. It's possible to expand the software by storing x and y coordinates, in such a way that a long text gets written on two different lines.</p>
<p>Characters that are built in are usually the following ones:
<br/><img src="/images/lcd-font.png" alt="HD44780 Alphanumeric LCD character table" style="width:100%;max-width:226px;"/></p>
