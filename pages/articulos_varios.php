<?php
	$descripcionPagina = 'Artículos sobre temas variados.';
	$tituloPagina = 'Artículos Varios';
	$lang = 'es';
	$comentariosActivados = false;
	
	echo addBoxBeg('Artículos Varios');
	
	addProjectBox('Modificación de cámara de video para ver luz infrarroja', 'Cómo modificar una cámara de video estándar para agrandar el espectro de luz que puede observar, permitiendo ver parte del infrarrojo cercano.','/thumbs/ircam.png','/ircam/');
	addProjectBox('Sensores de inclinación caseros', 'Cómo construir un pequeño sensor de dos estados para sensar la orientación en el espacio de una placa.','/thumbs/sensores_inclinacion.png','/sensores_inclinacion/');
	
	addProjectBox('Tamaños de rulemanes', 'Tabla con tamaños de diversos rulemanes que se consiguen localmente, muy útil a la hora de hacer un proyecto mecánico.','/thumbs/rulemanes.png','/rulemanes/');
		
	echo getProjectBoxes();
?>
<?php echo addBoxEnd();?>

