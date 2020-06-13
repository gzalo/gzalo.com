<?php
	$descripcionPagina = 'Artículos sobre Sistemas Embebidos, microcontroladores.';
	$tituloPagina = 'Artículos de Sistemas Embebidos';
	$lang = 'es';
	$comentariosActivados = false;
	
	echo addBoxBeg('Artículos de Sistemas Embebidos');
	
	addProjectBox('LCDs gráficos basados en KS0108', 'Cómo controlar un LCD gráfico de 128x64 (o 192x64) basado en KS0108, usando un microcontrolador y dos puertos de E/S.','/thumbs/lcdgrafico.png','/lcdgrafico/');
	addProjectBox('LCDs alfanuméricos basados en HD44780', 'Cómo controlar un LCD alfanumérico "Inteligente" desde un microcontrolador. Incluye Comandos y esquemáticos.','/thumbs/lcdalfanumerico.png','/lcdalfanumerico/');
	addProjectBox('Expansión de puertos de entrada y salida', 'Cómo agregar más entradas o salidas digitales a un controlador, usando registros de desplazamiento (shift registers).','/thumbs/expandir.png','/expandir/');
	addProjectBox('Matrices de LEDs, formas de manejo', 'Cómo controlar una matriz de LEDs desde un microcontrolador.','/thumbs/ledmatrix.png','/ledmatrix/');
	addProjectBox('Listado de software utilizados en electrónica', 'Análisis de algunos programas de electrónica que utilizé en algún momento.','/thumbs/software.png','/software/');
	addProjectBox('Utilización de un celular o modem GSM/GPRS con microcontroladores', 'Cómo usar un celular o módem para enviar y recibir mensajes de texto y llamadas desde un microcontrolador.','/thumbs/gsm.png','/gsm/');
	addProjectBox('Utilización de módulos GPS con microcontroladores', 'Cómo usar un módulo GPS para obtener la posición, parseando las cadenas NMEA que envía.','/thumbs/gps.png','/gps/');
	addProjectBox('Uso del MAX232 para conversiones RS232-TTL', 'Un circuito muy sencillo, usado en casi cualquier lugar que se necesite conexión entre un microcontrolador y una computadora.','/thumbs/rs232ttl.png','/rs232ttl/');
	addProjectBox('Memorias RAM externas en MCS51 (8051/8052)', 'Cómo conectar y usar una memoria externa (multiplexado de datos y dirección).','/thumbs/ram8052.png','/ram8052/');
	addProjectBox('Introducción al protocolo I2C, lectura y escritura en memorias 24LC', 'Muy útiles, por ejemplo para guardar datos de configuración o mantener un registro de sensores.','/thumbs/i2c.png','/i2c/');
		
	echo getProjectBoxes();
?>
<?php echo addBoxEnd();?>

