---
title: "Teclados de matriz, interfaz con microcontroladores"
tags: ["articles", "electronics"]
summary: "Formas fáciles para routear tact switches en formas de matriz."
thumbnail: "/thumbs/teclado4x4.png"
aliases: ["/teclado4x4/"]
---
Hacer un teclado con botones de 4 terminales (también denominados tact switches) es relativamente sencillo, aprovechando el hecho que los botones de 4 terminales tienen dos contactos unidos internamente, por lo que podemos evitar puentes en el circuito impreso.

![Esquemático teclado 3x4 con tact switches](/images/keypad_lyt.png)

[Descargar circuito impreso editable en Proteus](/downloads/keypad.zip)

La forma de leer de un teclado de 3x4 o 4x4 es facil: Conviene conectarlo de la siguiente manera: Todos las conexiones al mismo puerto, y las columnas en bits bajos, las filas en los altos:

![Conexión teclado 3x4 a microcontrolador](/images/keypad_conn.png)

El código usado para leer es el siguiente:

* Cada cierto tiempo (10 o 20 milisegundos)
	* Activar solamente la primer columna
	* Si hay alguna fila activada, se presiono la tecla indiceFila*3
	* Activar solamente la segunda columna
	* Si hay alguna fila activada, se presiono la tecla indiceFila*3+1
	* Activar solamente la tercera columna
	* Si hay alguna fila activada, se presiono la tecla indiceFila*3+2

Para aplicaciones más complejas, es posible agregar una compuerta que detecte la presión de cualquiera de las teclas, y de esa forma poder poner al microcontrolador en un estado de bajo consumo. De esa manera se lograría una interrupción cuando se presiona cualquier tecla. 

En el caso de necesitar detectar varias presiones en simultáneo, es posible agregar un diodo en serie a cada botón. Si no se agrega, al presionar dos o más teclas (particularmente aquellas que estén en diagonal en el teclado) es probable que se detecten "teclas fantasmas". Los teclados de computadora por lo general no poseen estos diodos, pero están cableados de tal forma que la probabilidad de detectar una pulsación incorrecta sea baja. Por ejemplo, los botones que se suponen que se presionan juntos (flechas, WASD, letras contiguas) pueden estar cada conjunto en una misma fila.