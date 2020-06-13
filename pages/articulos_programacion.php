<?php
	$descripcionPagina = 'Artículos sobre programación.';
	$tituloPagina = 'Artículos de Programación';
	$lang = 'es';
	$comentariosActivados = false;
	
	echo addBoxBeg('Artículos de Programación');
	
	addProjectBox('Clon de Worms con SDL y OpenGL', 'Un clon sencillo del juego Worms, usando las bibliotecas mencionadas. Soporta varios jugadores en el mismo teclado.','/thumbs/worms.png','/worms/');
	addProjectBox('Introducción a Shaders GLSL', 'Una pequeño artículo para personas que deseen entrar en el mundo de la programación de shaders gráficos.','/thumbs/shaders.png','/shaders/');
	addProjectBox('Compilación de programas con compiladores GNU', 'Cómo aprovechar los compiladores libres de GNU para armar programas.','/thumbs/compiladores_gnu.png','/compiladores_gnu/');
	addProjectBox('Motor simple de tiles usando HTML5 y Canvas', 'Motor muy simple hecho en HTML5, originalmente pensado para un juego online basado en bloques.','/thumbs/motor_tiles.png','/motor_tiles/');
	addProjectBox('Introducción a SDL, haciendo un editor de fuentes pixel', 'Pequeño tutorial para aprender a usar SDL, en C++.','/thumbs/sdl.png','/sdl/');
	
	/*<p><a href="/sdl_en/">Introduction to SDL, making a pixel font editor</a><br/>
<a href="/gnu_compilers_en/">Compiling programs with GNU compilers</a><br/>
<a href="/shaders_en/">Introduction to GLSL Shaders</a><br/>
<a href="/tile_engine_en/">Simple tile engine using HTML5 and Canvas</a><br/>
<a href="/worms_en/">Worms clone using SDL y OpenGL</a></p>*/
	
		
	echo getProjectBoxes();
?>
<?php echo addBoxEnd();?>

