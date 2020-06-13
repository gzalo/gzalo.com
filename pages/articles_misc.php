<?php
	$descripcionPagina = 'Articles about other themes.';
	$tituloPagina = 'Miscellaneous Articles';
	$lang = 'en';
	$comentariosActivados = false;
	
	echo addBoxBeg('Miscellaneous Articles');
	
	addProjectBox('Video camera modification to see IR light', 'How to modify an ordinary video camera to increase the spectrum of the light it can see, allowing the visualization of near-infrarred.','/thumbs/ircam.png','/ircam_en/');
	addProjectBox('Homemade inclination sensors', 'How to build small sensors with two states, that can sense the rotation of a board in two axes.','/thumbs/sensores_inclinacion.png','/inclination_sensor_en/');
		
	echo getProjectBoxes();
?>
<?php echo addBoxEnd();?>

