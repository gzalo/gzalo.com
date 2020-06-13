<?php
	$descripcionPagina = 'Pequeño juego que hice con Lucas Tavolaro como proyecto final para "Electrónica Digital III".';
	$tituloPagina = 'Juego de cartas de electrónica';
	
	echo addBoxBeg('Juego de cartas de electrónica');
?>
<p>Es un juego que hice de proyecto final de una materia para el colegio (Electrónica Digital III). Es un juego de cartas multijugador (funciona via LAN e internet). La idea era hacer algo similar al juego de las cartas pokémon, pero con cartas graciosas (con bromas internas de la división). 
</p>
<p>El juego usa la librería SDL y SDL_Image para abrir ventanas, manejar eventos y cargar las imágenes del juego. También usa OpenGL para el renderizado gráfico, y los "sockets de Unix" para multiplayer. Para compilarlo es necesario tener instalado mingw o cygwin, ir a la carpeta del cliente y ejecutar make. Debería funcionar en Linux, aunque nunca lo probamos.</p>
<p><img src="/images/tcgort.jpg" style="width:100%;max-width:720px;"/></p>
<p><a href="http://code.google.com/p/electronica-tgc/">Bajar código y ejecutable</a> 
(Licencia: GPL2) </p>
<?php echo addBoxEnd();?>