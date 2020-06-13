<?php
	$descripcionPagina = 'Some personal and academic projects I\'ve created or colaborated on';
	$tituloPagina = 'Projects';
	$lang = 'en';
	$comentariosActivados = false;
	
	echo addBoxBeg('Projects');
	
	addProjectBox('Random shape generator (2005)', 'Really simple random shape generator I built back when I was using Flash.','/thumbs/random.png','/downloads/random.swf');
	addProjectBox('CS_electronicaORT (2008)', 'Counter-Strike 1.6 map of a section of the high school I attended.','/thumbs/cs_electronicaort.png','/cs_electronicaort_en/');
	addProjectBox('Mini game console with LED matrix (2009)', 'Simple 8x8 game console based in an 8052 microcontroller, developed in C.','/thumbs/miniconsola_.png','/miniconsole_en/');
	addProjectBox('Card game - Electrónica (2010)','SDL based multiplayer game done as a final project for an assignature.','/thumbs/electronica-tcg.png','/electronica_tcg_en/');
	addProjectBox('AlephTrack - Tracker using GPS and GSM/GPRS (2010)','Allows tracking and realtime monitoring via Internet of the location of a device, which can be installed in a car.','/thumbs/alephtrack.png','http://alephtrack.blogspot.com');
	addProjectBox('Small physics engine (2010)','Based on the "Advanced Character Physics" paper by Jakobsen. HTML5 and Javascript based, supports only circles.','/thumbs/fisica.png','/physics_engine_en/');
	//addProjectBox('Muscular electrostimulator (2011)','Microcontroller based muscular stimulator, which generates different types of high voltage signals which can be applied to muscles to increase muscular force.','/thumbs/electroestimulador.png','/electrostimulator_en/');
	addProjectBox('Digital combination lock (2012)','Digital logic based that implements a combination lock similar to those used in hotel rooms.','/thumbs/cerradura.png','/lock_en/');
	addProjectBox('Mini game console with TV out (2012)','Sample application that generates NTSC signals (black and white) which can be viewed in any standard definition TV. Based in a 8052 microcontroller.','/thumbs/consolatetris.png','/console_tv_en/');
	addProjectBox('LED matrix with inclination sensors (2013)','This project is based in a 8x8 bicolor LED matrix, controlled by a PC via the parallel port. We also included two homemade orientation sensors, allowing the detection of the matrix angle.','/thumbs/ledmatrixintro.png','/tpg_intro_en/');
	addProjectBox('Domotic control via IR and PC (2014)','A domotic panel to control the lights of multiple bedrooms, allowing the user to change the intensity of them via 3 interfaces. This group project was done with Juan Ignacio Troisi and Martin Menendez, for the university subject "Laboratorio de microcontroladores".','/thumbs/controldomotico.png','/tp_labodemicros_en/');
	addProjectBox('Half-Life map viewer (2014)','This project is a renderer designed specifically to explore the world of Half-Life. It allows for realtime rendering of the Black Mesa Research Facility.','/thumbs/halfmapper.png','https://github.com/gzalo/HalfMapper');
	addProjectBox('Buenos Aires mapper (2014)','3D Map of Buenos Aires using data provided by the government. Uses OpenGL for 3D acceleration, SDL for window and event management.','/thumbs/mapabsas.png','https://github.com/gzalo/MapaBSAS');
	addProjectBox('Utilities for Digital Systems classes (2015)','Software I made to assist with the development of FPGA systems that include a VGA output.','/thumbs/cordic.png','https://github.com/gzalo/sistemas-digitales');
	addProjectBox('Speech recognition using HTK (2016)','Distributed finite-grammar speech recognition based on the HTK toolkit. Developed as a final project for an university class. Uses JSRecorder and Web Audio API to capture microphone audio from the computer.','/thumbs/habla.png','https://casa.gzalo.com/habla');
	
	echo getProjectBoxes();
?>
<?php echo addBoxEnd();?>