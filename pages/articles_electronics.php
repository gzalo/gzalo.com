<?php
	$descripcionPagina = 'Articles about digital and analog electronics.';
	$tituloPagina = 'Electronic Articles';
	$lang = 'en';
	$comentariosActivados = false;
	
	echo addBoxBeg('Electronic Articles');
	
	addProjectBox('Analog to digital converter without ADC', 'How to easily measure the value of a resistor, using a microcontroller without Analog to Digital converters.','/thumbs/adc.png','/adc_en/');
	addProjectBox('DC motor control with H bridge', 'Different ways to control DC motors.','/thumbs/puenteh.png','/hbridge_en/');
	addProjectBox('Introduction to PIC microcontrollers', 'Small introductory article about 8 bit microcontrollers, focusing on Microchip PIC16 family','/thumbs/pic.png','/intropic_en/');
	addProjectBox('Matrix keyboards, microcontroller interface', 'Easy tips to route multiple tact switches disposed in a matrix configuration.','/thumbs/teclado4x4.png','/keyboard4x4_en/');
	addProjectBox('Introduction to PLD (Programmable Logic Devices)', 'Small synopsis of applications of PLA, PAL, GAL and PLD based systems.','/thumbs/pld.png','/pld_en/');
	addProjectBox('Introducción to MEMS (micromechanical systems)', 'Spanish presentation: examples of application and materials used for construction of MEMS.','/thumbs/mems.png','/downloads/mems.pdf');
	addProjectBox('Four channel RF remote control, using HT12D/E', 'How to remote control loads via an RF link, using cheap modules and ICs.','/thumbs/rfht12.png','/rfht12_en/');
				
	echo getProjectBoxes();
?>
<?php echo addBoxEnd();?>

