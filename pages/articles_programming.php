<?php
	$descripcionPagina = 'Different articles I wrote about programming, specially using SDL, OpenGL, HTML5 with Canvas and others.';
	$tituloPagina = 'Programming Articles';
	$lang = 'en';
	$comentariosActivados = false;
	
	echo addBoxBeg('Programming Articles');
	
	addProjectBox('Worms clone using SDL y OpenGL', 'A simple clone of the game called Worms, using that libraries. Can be played by multiple players, using the same keyboard.','/thumbs/worms.png','/worms_en/');
	addProjectBox('Introduction to GLSL Shaders', 'A small article that can help people that want to get into the world of graphic shaders development.','/thumbs/shaders.png','/shaders_en/');
	addProjectBox('Compiling programs with GNU compilers', 'How to use the free GNU compilers to build projects.','/thumbs/compiladores_gnu.png','/gnu_compilers_en/');
	addProjectBox('Simple tile engine using HTML5 and Canvas', 'Very simple tile engine done in HTML5, originally made for an online block-based game.','/thumbs/motor_tiles.png','/tile_engine_en/');
	addProjectBox('Introduction to SDL, making a pixel font editor', 'Small tutorial to learn the basics of SDL, using C++.','/thumbs/sdl.png','/sdl_en/');
		
	echo getProjectBoxes();
?>
<?php echo addBoxEnd();?>

