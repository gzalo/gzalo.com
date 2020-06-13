<?php
	$descripcionPagina = 'Artículos sobre electrónica analógica y digital.';
	$tituloPagina = 'Artículos de Electrónica';
	$lang = 'es';
	$comentariosActivados = false;
	
	echo addBoxBeg('Artículos de Electrónica');
	
	addProjectBox('Conversión analógica-digital sin ADC', 'Como medir facilmente el valor de una resistencia, usando un microcontrolador sin conversores analógico-digitales.','/thumbs/adc.png','/adc/');
	addProjectBox('Control de motores de continua con puente H', 'Distintas formas de controlar motores de CC.','/thumbs/puenteh.png','/puenteh/');
	addProjectBox('Introducción a microcontroladores PIC', 'Pequeño resumen introductorio sobre microcontroladores de 8 bit, en particular de la familia Microchip PIC16','/thumbs/pic.png','/intropic/');
	addProjectBox('Teclados de matriz, interfaz con microcontroladores', 'Formas fáciles para routear tact switches en formas de matriz.','/thumbs/teclado4x4.png','/teclado4x4/');
	addProjectBox('Casas de electrónica de CABA', 'Lista de varias casas de electrónica de Buenos Aires, junto a una pequeña descripción de cada una.','/thumbs/casas.png','/casas/');
	addProjectBox('Introducción a PLD (dispositivos lógicos programables)', 'Resumen de aplicaciones y programación de PLA, PAL, GAL y PLD.','/thumbs/pld.png','/pld/');
	addProjectBox('Introducción a MEMS (sistemas microelectromecánicos)', 'Presentación con ejemplos de aplicación y materiales utilizados para la construcción de los mismos.','/thumbs/mems.png','/downloads/mems.pdf');
	addProjectBox('Control remoto de 4 canales por RF, mediante HT12D/E', 'Cómo controlar cargas a distancias a través de un enlace de radiofrecuencia, usando módulos y ciruitos integrados de bajo costo.','/thumbs/rfht12.png','/rfht12/');
		
	echo getProjectBoxes();
?>
<?php echo addBoxEnd();?>

