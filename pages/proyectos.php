<?php
	$descripcionPagina = 'Algunos proyectos personales y académicos en los que colaboré o desarrollé.';
	$tituloPagina = 'Proyectos';
	$lang = 'es';
	$comentariosActivados = false;
	
	echo addBoxBeg('Proyectos');
	
	addProjectBox('Generador de formas aleatorias (2005)', 'Generador de formas aleatorias muy sencillas construido en Flash.','/thumbs/random.png','/downloads/random.swf');
	addProjectBox('CS_electronicaORT (2008)', 'Mapa de Counter-Strike 1.6 de una sección de la escuela secundaria donde estudié..','/thumbs/cs_electronicaort.png','/cs_electronicaort/');
	addProjectBox('Mini consola de juegos con matriz de LEDs (2009)', 'Consola con resolución 8x8, basada en un microcontrolador 8052 microcontroller, desarrollo en C.','/thumbs/miniconsola_.png','/miniconsola/');
	addProjectBox('Juego de cartas de electrónica (2010)','Juego multijugador basado en la biblioteca SDL, hecho como proyecto final para una materia.','/thumbs/electronica-tcg.png','/electronica_tcg/');
	addProjectBox('AlephTrack - Rastreador usando GPS y GSM/GPRS (2010)','Permite el seguimiento y monitoreo a través de Internet un dispositivo, que puede ser instalado facilmente en un auto.','/thumbs/alephtrack.png','http://alephtrack.blogspot.com');
	addProjectBox('Pequeño motor físico (2010)','Basado en el paper "Advanced Character Physics" de Jakobsen. Desarrollado con HTML5 and Javascript based, solamente soporta círculos.','/thumbs/fisica.png','/motor_fisico/');
	addProjectBox('Cerradura de combinación digital (2012)','Digital logic based that implements a combination lock similar to those used in hotel rooms.','/thumbs/cerradura.png','/cerradura/');
	//addProjectBox('Electroestimulador muscular (2011)','Estimulador basado en microcontrolador, el cual genera distintos tipos de señales de alta tensión, que pueden ser aplicadas a músculos para aumentar la fuerza muscular.','/thumbs/electroestimulador.png','/electroestimulador/');
	addProjectBox('Mini consola de juegos con salida a TV (2012)','Aplicación de prueba para generar señales NTSC (blanco y negro) que pueden ser vistas en cualquier televisión con entrada de video compuesta. Basado en un microcontrolador 8052.','/thumbs/consolatetris.png','/consola_tv/');
	addProjectBox('Matriz de LEDs con sensores de inclinación (2013)','Proyecto basado en una matriz bicolor de 8x8, controlada por PC via el puerto paralelo. También incluimos dos sensores de orientación "caseros", que permiten detectar el ángulo de la matriz.','/thumbs/ledmatrixintro.png','/tpg_intro/');
	addProjectBox('Control domótico via infrarrojo y PC (2014)','Panel de control domótico para controlar luces de distintas habitaciones, permitiendo al usuario el cambio de intensidad a través de tres interfaces. Realizado para la materia "Laboratorio de microcontroladores".','/thumbs/controldomotico.png','/tp_labodemicros/');
	addProjectBox('Visor de mapas de Half-Life (2014)','Este proyecto es una forma de explorar el mundo del juego Half-Life. Permite el renderizado en tiempo real de todas las instalaciones de Black Mesa Research Facility.','/thumbs/halfmapper.png','https://github.com/gzalo/HalfMapper');
	addProjectBox('Mapa 3d de Buenos Aires (2014)','Mapa 3d de Buenos Aires usando datos provistos por el gobierno. Usa OpenGL para aceleración 3D y SDL para el manejo de ventanas y eventos.','/thumbs/mapabsas.png','https://github.com/gzalo/MapaBSAS');
	addProjectBox('Utilidades para Sistemas Digitales (2015)','Programas desarrollados para TPs de Sistemas Digitales, permiten debuggear a través de simulación sistemas basados en FPGAs que usan salidas de video VGA.','/thumbs/cordic.png','https://github.com/gzalo/sistemas-digitales');
	addProjectBox('Reconocimiento de habla usando HTK (2016)','Reconocimiento distribuido con gramática finita, basado en el toolkit HTK. Desarrollado como parte de un proyecto final para "Procesamiento del Habla". Usa JSRecorder y la API de Web Audio para capturar las señales de micrófono desde un navegador.','/thumbs/habla.png','https://casa.gzalo.com/habla');
	
	addProjectBox('Reconocimiento de habla para EDU-CIAA (2016)','Biblioteca liviana para realizar reconocimiento de palabras aisladas en microcontroladores ARM Cortex M4. Desarrollado como proyecto final para "Seminario de Sistemas Embebidos". Se basa en la extracción de coeficientes MFCC y el reconocimiento usando el algoritmo de Viterbi para hallar la palabra más probable dadas las observaciones. Los modelos estadísticos fueron basados en cadenas ocultas de Markov (HMM), de primer orden, con probabilidades del tipo mezcla de Gaussianas.','/thumbs/bla.png','https://github.com/gzalo/bla');
	
	echo getProjectBoxes();
?>
<?php echo addBoxEnd();?>

