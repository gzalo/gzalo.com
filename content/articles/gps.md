---
title: ""
tags: ["articles", "electronics"]
summary: ""
thumbnail: "/thumbs/.png"
aliases: ["//"]
---
addProjectBox('Utilización de módulos GPS con microcontroladores', 'Cómo usar un módulo GPS para obtener la posición, parseando las cadenas NMEA que envía.','/thumbs/gps.png','/gps/');

$descripcionPagina = 'Cómo usar un módulo GPS para obtener la posición, parseando las cadenas NMEA que envía.';
	$tituloPagina = 'Utilización de módulos GPS con microcontroladores';
<p>Esta información sirve para cualquier módulo GPS (fue probado con el <a href="http://www.globalsat.co.uk/product_pages/product_et332.htm">ET-332</a>) que transmita datos via un puerto serie, usando el protocolo NMEA.</p>
<p>Básicamente aproximadamente 10 veces por segundo, el GPS envía muchas cadenas NMEA, separadas por retornos de carro y fines de línea, de las cuales la que más interesa es la que comienza con GPGGA. Un ejemplo de cadena es: <pre>$GPGGA,182402.02,3436.5829,S,05825.7855,W,1,04,1.5,57,M,-34.0,M,,,*70 </pre></p>
<p>Significado de cada campo:
	<ol>
		<li><tt>$GPGGA</tt>: Identificador de la cadena</li>
		<li><tt>182402.02</tt>: Hora (en GMT)</li>
		<li><tt>3436.5829,S</tt>: Latitud (34º 36.5829' Sur)</li>
		<li><tt>05825.7855,W</tt>: Longitud (58º 25.7855' Oeste)</li>
		<li><tt>1</tt>: Fix válido (si fuera 0 es porque los datos pueden ser extrapolados)</li>
		<li><tt>04</tt>: Cantidad de satélites que fueron usados para obtener posición</li>
		<li><tt>1.5</tt>: Exactitud relativa de la posición horizontal (ver <a href="http://en.wikipedia.org/wiki/Dilution_of_precision_(GPS)">HDOP</a>)</li>
		<li><tt>57,M</tt>: Altitud (medida en metros sobre nivel del mar)</li>
		<li><tt>-34.0,M</tt>: Altura respecto al sistema de referencia <a href="http://en.wikipedia.org/wiki/World_Geodetic_System">WGS84</a></li>
		<li><tt>*70</tt>: Checksum, se calcula como un XOR de todos los bytes entre $ y *</li>
	</ol>
</p>
<p>Una forma sencilla de interpretar los datos desde un microcontrolador es guardar almacenar todas las cadenas (desde $ hasta un \r\n) en un buffer, y analizarlas posteriormente. Esto se complica en dispositivos con poca memoria, ya que las cadenas suelen tener alrededor de 80 caracteres.<br/>Por eso, es posible analizar la cadena a medida que vaya llegando. Esto usa poca memoria pero usa toda la CPU, ya que tiene que quedarse esperando a que lleguen bytes (<a href="http://en.wikipedia.org/wiki/Busy_waiting">busy waiting</a>).</p>
<p>Es posible implementar lo mismo en una ISR (rutina de manejo de interrupción) que se ejecute cada vez que llega un byte, mediante una máquina de estados que se acuerde de por qué parte va.</p>