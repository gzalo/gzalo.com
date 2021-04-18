---
title: ""
tags: ["articles", "electronics"]
summary: ""
thumbnail: "/thumbs/.png"
aliases: ["/ledmatrix/"]
---
addProjectBox('Matrices de LEDs, formas de manejo', 'Cómo controlar una matriz de LEDs desde un microcontrolador.','/thumbs/ledmatrix.png','/ledmatrix/');

$descripcionPagina = 'Cómo controlar una matriz de LEDs desde un microcontrolador.';
	$tituloPagina = 'Control de una una matriz de LEDs';
	
<p>Una matriz suele estar compuesta con diodos dispuestos de esta forma:</p>
<p><img src="/images/matrizinterna.png" style="width:100%;max-width:263px;" alt="Esquema de una matriz de diodos LED"/></p>
<p>Como se observa, es similar a la matriz de diodos usada para hacer una memoria ROM sencilla, salvo que usa diodos LEDs en lugar de diodos convencionales.</p>

<p><strong>&iquest;C&oacute;mo manejarla?</strong></p>
<p>B&aacute;sicamente es necesario repetir un proceso sencillo:</p>
<ul>
<li>Poner en Columna[1..8] los valores deseados para la primera fila</li>
<li>Prender la primer fila</li>
<li>Esperar un tiempo (del orden de milisegundos)</li>
<li>Apagar la primera fila</li>
</ul>
<p>Luego el proceso se repite con la segunda fila, tercera, y así hasta llegar a la última.</p>
<p>Este proceso hay que hacerlo todo el tiempo, por lo que es preferible usar un microcontrolador. Es posible manejar la matriz con integrados digitales estándares pero se complica demasiado.</p>
<p>El tiempo que hay que esperar depende de los leds y de la tasa de refresco deseada. Gracias a este tiempo y nuestra "persistencia de la visi&oacute;n" (efecto del ojo), vemos como si todos los leds estuvieran prendidos simult&aacute;neamente, mientras que enrealidad est&aacute; prendida una sola fila a la vez. Este efecto se puede apreciar en cualquier marquesina (colectivo, subte, cine, etc), basta con mover muy rapido la cabeza o los ojos para ver que las filas o columnas (depende de como esté programado) se desfasan, se aprecia que no están prendidas todas en simultáneo. Tambi&eacute;n se puede observar con una c&aacute;mara de fotos o video si la velocidad de obturación es más rápida que el refresco de la matriz.</p>

<p>Si usamos una tiempo de refresco muy bajo, el display parpadear&aacute; demasiado y ser&aacute; molesto visualmente. Un valor t&iacute;pico para esperar ser&iacute;a 10ms por fila (refresco de 100Hz).</p>
<p>Hay que usar resistencias (una por columna si el barrido se hace de a filas), para evitar que se quemen prematuramente los leds.</p>
<p>El mejor método es usar un timer del microcontrolador, para así evitar gastar ciclos de cpu esperando que pasen los 10 milisegundos. </p>

<!--<p><object type="application/x-shockwave-flash" style="width:450px; height:366px;" data="http://www.youtube.com/v/o1G2OqXkAHY"><param name="movie" value="http://www.youtube.com/v/o1G2OqXkAHY" /></object></p>	
<p>En este video se puede apreciar un pic16f628a manejando una matriz de 8x8, usando un shift register 74hct164 para manejar las columnas, y un transistor pnp por cada fila para prenderlas. </p>-->
