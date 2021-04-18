---
title: "Matrices de LEDs, formas de manejo"
tags: ["articles", "electronics"]
summary: "Cómo controlar una matriz de LEDs desde un microcontrolador."
thumbnail: "/thumbs/ledmatrix.png"
aliases: ["/ledmatrix/"]
---
<p>Una matriz suele estar compuesta con diodos dispuestos de esta forma:
<p><img src="/images/matrizinterna.png" style="width:100%;max-width:263px;" alt="Esquema de una matriz de diodos LED"/>
<p>Como se observa, es similar a la matriz de diodos usada para hacer una memoria ROM sencilla, salvo que usa diodos LEDs en lugar de diodos convencionales.

<p><strong>¿Cómo manejarla?</strong>
<p>Básicamente es necesario repetir un proceso sencillo:

<li>Poner en Columna[1..8] los valores deseados para la primera fila</li>
<li>Prender la primer fila</li>
<li>Esperar un tiempo (del orden de milisegundos)</li>
<li>Apagar la primera fila</li>

<p>Luego el proceso se repite con la segunda fila, tercera, y así hasta llegar a la última.
<p>Este proceso hay que hacerlo todo el tiempo, por lo que es preferible usar un microcontrolador. Es posible manejar la matriz con integrados digitales estándares pero se complica demasiado.
<p>El tiempo que hay que esperar depende de los leds y de la tasa de refresco deseada. Gracias a este tiempo y nuestra "persistencia de la visión" (efecto del ojo), vemos como si todos los leds estuvieran prendidos simultáneamente, mientras que enrealidad está prendida una sola fila a la vez. Este efecto se puede apreciar en cualquier marquesina (colectivo, subte, cine, etc), basta con mover muy rapido la cabeza o los ojos para ver que las filas o columnas (depende de como esté programado) se desfasan, se aprecia que no están prendidas todas en simultáneo. También se puede observar con una cámara de fotos o video si la velocidad de obturación es más rápida que el refresco de la matriz.

<p>Si usamos una tiempo de refresco muy bajo, el display parpadeará demasiado y será molesto visualmente. Un valor típico para esperar sería 10ms por fila (refresco de 100Hz).
<p>Hay que usar resistencias (una por columna si el barrido se hace de a filas), para evitar que se quemen prematuramente los leds.
<p>El mejor método es usar un timer del microcontrolador, para así evitar gastar ciclos de cpu esperando que pasen los 10 milisegundos. 

<!--<p><object type="application/x-shockwave-flash" style="width:450px; height:366px;" data="http://www.youtube.com/v/o1G2OqXkAHY"><param name="movie" value="http://www.youtube.com/v/o1G2OqXkAHY" /></object>	
<p>En este video se puede apreciar un pic16f628a manejando una matriz de 8x8, usando un shift register 74hct164 para manejar las columnas, y un transistor pnp por cada fila para prenderlas. -->
