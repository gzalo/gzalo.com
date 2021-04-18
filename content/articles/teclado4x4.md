---
title: ""
tags: ["articles", "electronics"]
summary: ""
thumbnail: "/thumbs/.png"
aliases: ["/teclado4x4/"]
---
addProjectBox('Teclados de matriz, interfaz con microcontroladores', 'Formas fáciles para routear tact switches en formas de matriz.','/thumbs/teclado4x4.png','/teclado4x4/');

$descripcionPagina = 'Cómo hacer un teclado de 4x4 con interruptores, cómo conectarlo a un microcontrolador y cómo detectar la presión de teclas.';
	$tituloPagina = 'Teclados de matriz, interfaz con microcontroladores';
<p>Hacer un teclado con botones de 4 terminales (también denominados tact switches) es relativamente sencillo, aprovechando el hecho que los botones de 4 terminales tienen dos contactos unidos internamente, por lo que podemos evitar puentes en el circuito impreso.</p>
<img src="/images/keypad_lyt.png" alt="Esquemático teclado 3x4 con tact switches" style="width:100%;max-width:373px;"/>
<p><a href="/downloads/keypad.zip" >Descargar circuito impreso editable en Proteus</a></p>
<p>La forma de leer de un teclado de 3x4 o 4x4 es facil: Conviene conectarlo de la siguiente manera: Todos las conexiones al mismo puerto, y las columnas en bits bajos, las filas en los altos:</p>
<img src="/images/keypad_conn.png" alt="Conexión teclado 3x4 a microcontrolador" style="width:100%;max-width:500px;"/>
<p>El código usado para leer es el siguiente:</p>
<ol>
	<li>Cada cierto tiempo (10 o 20 milisegundos)
		<ol>
			<li>Activar solamente la primer columna</li>
			<li>Si hay alguna fila activada, se presiono la tecla indiceFila*3</li>
			<li>Activar solamente la segunda columna</li>
			<li>Si hay alguna fila activada, se presiono la tecla indiceFila*3+1</li>
			<li>Activar solamente la tercera columna</li>
			<li>Si hay alguna fila activada, se presiono la tecla indiceFila*3+2</li>
		</ol>
	</li>
</ol>
<p>Para aplicaciones más complejas, es posible agregar una compuerta que detecte la presión de cualquiera de las teclas, y de esa forma poder poner al microcontrolador en un estado de bajo consumo. De esa manera se lograría una interrupción cuando se presiona cualquier tecla. </p>
<p>En el caso de necesitar detectar varias presiones en simultáneo, es posible agregar un diodo en serie a cada botón. Si no se agrega, al presionar dos o más teclas (particularmente aquellas que estén en diagonal en el teclado) es probable que se detecten "teclas fantasmas". Los teclados de computadora por lo general no poseen estos diodos, pero están cableados de tal forma que la probabilidad de detectar una pulsación incorrecta sea baja. Por ejemplo, los botones que se suponen que se presionan juntos (flechas, WASD, letras contiguas) pueden estar cada conjunto en una misma fila.</p>