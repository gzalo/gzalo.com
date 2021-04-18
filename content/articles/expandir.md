---
title: ""
tags: ["articles", "electronics"]
summary: ""
thumbnail: "/thumbs/.png"
aliases: ["/expandir/"]
---

addProjectBox('Expansión de puertos de entrada y salida', 'Cómo agregar más entradas o salidas digitales a un controlador, usando registros de desplazamiento (shift registers).','/thumbs/expandir.png','/expandir/');

$descripcionPagina = 'Cómo agregar más entradas o salidas digitales a un controlador, usando registros de desplazamiento (shift registers).';
	$tituloPagina = 'Expandir puertos de entrada/salida de un microcontrolador';
<p>Hay veces en las que para alguna aplicación necesitamos más pines de salida o entrada de los que tenemos en el microcontrolador. Hay varias soluciones:</p>
<ul>
	<li>Usar algún chip PPI como el 8255 (caro, grande y lento), de interfaz paralela (nos usa 10 terminales)</li>
	<li>Usar algún integrado expansor de E/S via I2C, como el PCF8575 (caro y dificil de conseguir)</li>
	<li>Usar lógica 74xxx (relativamente barato, programación sencilla, facil de conseguir)</li>
</ul>
<br/>
<h3>Expandir Salidas</h3>
<p>La mejor solución es la tercera, es posible emplear un 74x164 (sin latch) o 74x595 (con latch) para expandir la cantidad de salidas. La ventaja de estos integrados es que se pueden poner en cascada, y así agregar 8 puertos por cada integrado agregado.</p>
<p>Básicamente son shift registers, es decir, una cadena de flip-flops del tipo D encadenados, por lo que uno puede ir "empujando" datos por un lado y tener acceso a los 8 bits:</p>
<img src="/images/74164.png" alt="Diagrama shift register" style="width:100%;max-width:700px;"/>
<p>Generalmente tienen 3 terminales de control:</p>
<ul>
	<li>Clock: Al dar un pulso, los datos se van "desplazando" por los flip flops, y un dato nuevo entra al FF de la izquierda</li>
	<li>Datos: Marcan qué bit agregar a la izquierda al dar un pulso de clock</li>
	<li>Reset: Al dar un pulso, hace que todos los bits pasen a 0</li>
</ul><br/>
<p>Algunos (como el 74x595) tienen una terminal más, que hace que los datos pasen a la salida. Es decir, los cambios se hacen sobre flip flops internos (que no controlan las terminales físicas) y al activar esa terminal extra los bits aparecen en las terminales:</p>
<img src="/images/74595.png" alt="Diagrama shift register con latch" style="width:100%;max-width:280px;"/>
<p>Conviene elegir el shift register con latch en el caso de que las salidas necesiten persistencia (es decir, si las salidas están conectadas a cargas reales, como relés o motores), para evitar que en una terminal haya un valor incorrecto (aunque sea por milisegundos).</p>
<p>Por lo tanto, si queremos escribir una tira de bits en estos shift registers, debemos hacer esta secuencia:</p>
<ol>
	<li>Por cada bit: (empezando por el de más a la derecha)
		<ol>
			<li>Poner ese bit en la terminal de "Dato"</li>
			<li>Hacer un pulso en la terminal de "Clock"</li>
		</ol>
	</li>
	<li>Hacer un pulso en la terminal de "Latch" (si hay), para hacer que se activen las salidas correspondientes</li>
</ol><br/>
<p>Es posible poner varios shift register en cascada, de la siguiente manera:</p>
<img src="/images/74164_cascada.png" alt="Shift registers en cascada" style="width:100%;max-width:388px;"/>
<p>Un ejemplo útil de ésto es poder manejar varias matrices de leds, unicamente con pocas terminales de un microcontrolador:</p>
<img src="/images/megamatrix_dsn.png" alt="Esquemático matrices de leds" style="width:100%;max-width:700px;"/>
<h3>Expandir Entradas</h3>
<p>Para las entradas, es posible usar integrados como los 4014. Básicamente es similar a las salidas, con la diferencia que los shift registers son de entrada paralela y salida serial. Este sería la secuencia para leer los bits:</p>
<ol>
	<li>Hacer un pulso en la terminal de "Latch", para que el integrado guarde en los FF internos el valor de las terminales</li>
	<li>Por cada bit[i] que se quiera leer: (desde la derecha)
		<ol>	
			<li>Leer de la terminal de "Dato", ese es el bit[i]</li>
			<li>Hacer un pulso en la terminal de "Clock"</li>
			<li>Incrementar i</li>
		</ol>
	</li>
</ol><br/>
<p>La forma de expandir los shift registers para obtener más puertos de entrada es la siguiente:<br/>
<img src="/images/4014.png" alt="Shift register para expandir entradas" style="width:100%;max-width:275px;"/></p>
