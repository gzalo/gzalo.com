<?php
	$descripcionPagina = 'Articles about embedded systems and microcontrollers.';
	$tituloPagina = 'Embedded System Articles';
	$lang = 'en';
	$comentariosActivados = false;
	
	echo addBoxBeg('Embedded System Articles');
	
	addProjectBox('Graphical LCDs based on KS0108', 'How to control a Graphic LCD with a resolution of 128x64 (or 192x64) based in KS0108, using a microcontroller and two 8 bit I/O ports.','/thumbs/lcdgrafico.png','/graphicallcd_en/');
	addProjectBox('Alphanumeric LCDs based on HD44780', 'How to control an Alphanumeric LCD using a microcontroller. Includes commands and schematics.','/thumbs/lcdalfanumerico.png','/alphanumericlcd_en/');
	addProjectBox('Input/output port expansion', 'How to add more digital inputs or outputs to a microcontroller, using shift registers.','/thumbs/expandir.png','/expansion_en/');
	addProjectBox('LED Matrix, methods to control', 'How to control a LED matrix with a microcontroller.','/thumbs/ledmatrix.png','/ledmatrix_en/');
	addProjectBox('List of software commonly used in electronics', 'Analysis of some electronic programs I used or use daily.','/thumbs/software.png','/software_en/');
	addProjectBox('Using a cellphone or GSM/GPRS modem with a microcontroller', 'How to use a cellphone or modem to send and receive SMS and calls, using a microcontroller.','/thumbs/gsm.png','/gsm_en/');
	addProjectBox('Using GPS modules with microcontrollers', 'How to get the position from a GPS module, by parsing the NMEA strings.','/thumbs/gps.png','/gps_en/');
	addProjectBox('Usage of MAX232 for RS232-TTL level shifting', 'A simple circuit used in almost every circuit that needs a connection with a PC.','/thumbs/rs232ttl.png','/rs232ttl_en/');
	addProjectBox('External RAM memories in MCS51 architecture (8051/8052)', 'How to connect and use an external memory, using data and address multiplexing.','/thumbs/ram8052.png','/ram8052_en/');
	addProjectBox('Introduction to I2C protocol, reading and writing in 24LC memories', 'Very useful memories, typically used to store configuration data or to keep logs with sensor data.','/thumbs/i2c.png','/i2c_en/');
		
	echo getProjectBoxes();
?>
<?php echo addBoxEnd();?>

