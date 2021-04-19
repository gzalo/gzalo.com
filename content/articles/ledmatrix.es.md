---
title: "Matrices de LEDs, formas de manejo"
tags: ["articles", "electronics"]
summary: "Cómo controlar una matriz de LEDs desde un microcontrolador."
thumbnail: "/thumbs/ledmatrix.png"
aliases: ["/ledmatrix/"]
---
Una matriz suele estar compuesta con diodos dispuestos de esta forma:

![Esquema de una matriz de diodos LED](/images/matrizinterna.png)

Como se observa, es similar a la matriz de diodos usada para hacer una memoria ROM sencilla, salvo que usa diodos LEDs en lugar de diodos convencionales.

**¿Cómo manejarla?**

Básicamente es necesario repetir un proceso sencillo:

* Poner en Columna[1..8] los valores deseados para la primera fila
* Prender la primer fila
* Esperar un tiempo (del orden de milisegundos)
* Apagar la primera fila

Luego el proceso se repite con la segunda fila, tercera, y así hasta llegar a la última.

Este proceso hay que hacerlo todo el tiempo, por lo que es preferible usar un microcontrolador. Es posible manejar la matriz con integrados digitales estándares pero se complica demasiado.

El tiempo que hay que esperar depende de los leds y de la tasa de refresco deseada. Gracias a este tiempo y nuestra "persistencia de la visión" (efecto del ojo), vemos como si todos los leds estuvieran prendidos simultáneamente, mientras que enrealidad está prendida una sola fila a la vez. Este efecto se puede apreciar en cualquier marquesina (colectivo, subte, cine, etc), basta con mover muy rapido la cabeza o los ojos para ver que las filas o columnas (depende de como esté programado) se desfasan, se aprecia que no están prendidas todas en simultáneo. También se puede observar con una cámara de fotos o video si la velocidad de obturación es más rápida que el refresco de la matriz.

Si usamos una tiempo de refresco muy bajo, el display parpadeará demasiado y será molesto visualmente. Un valor típico para esperar sería 10ms por fila (refresco de 100Hz).

Hay que usar resistencias (una por columna si el barrido se hace de a filas), para evitar que se quemen prematuramente los leds.

El mejor método es usar un timer del microcontrolador, para así evitar gastar ciclos de cpu esperando que pasen los 10 milisegundos. 

