<?php
	$descripcionPagina = 'Small game I did with Lucas Tavolaro as a Final project for highschool.';
	$tituloPagina = 'Card game (Electrónica)';
	$lang = 'en';
	
	echo addBox('Card game (Electrónica)','<p>It\'s a small game I did as a final project for highschool. It\'s a multiplayer card game (working via LAN and Internet). The idea was to make some similar to Pokemon Trading Card Game, but with funny cards (with internal jokes) 
</p>
<p>The game uses the SDL and SDL_image library to open windows, handle events and load game images. It also uses OpenGL for graphics acceleration, and Unix sockets for multiplayer. To compile it, it\'s necesary to have installed Mingw or Cygwin (plus the libraries), go to the "cliente" folder and run make. Should work fine in Linux, though it was never tested.</p>
<p><img src="/images/tcgort.jpg" style="width:100%;max-width:720px;"/></p>
<p><a href="http://code.google.com/p/electronica-tgc/">Download code and executable</a> 
(License: GPL2) </p>');
