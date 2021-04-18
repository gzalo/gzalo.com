---
title: ""
tags: ["articles", "electronics"]
summary: ""
thumbnail: "/thumbs/.png"
aliases: ["/lcdgrafico/"]
---
addProjectBox('LCDs gráficos basados en KS0108', 'Cómo controlar un LCD gráfico de 128x64 (o 192x64) basado en KS0108, usando un microcontrolador y dos puertos de E/S.','/thumbs/lcdgrafico.png','/lcdgrafico/');

$descripcionPagina = 'Cómo controlar un LCD gráfico de 128x64 (o 192x64) basado en KS0108, usando un microcontrolador y dos puertos de E/S.';
	$tituloPagina = 'Control de LCDs gráficos basados en KS0108 (128x64 píxeles)';
	
<p>La mayoría de los LCDs gráficos usan un controlador como el KS0108 (o compatible). Cada controlador tiene una memoria de 512 bytes interna y por lo tanto permite controlar un display de 64x64 píxeles. El truco que usan los diplays más grandes es usar un controlador por cada fracción de la pantalla, es decir, un display de 128x64 tiene 2 controladores, un display de 196x64 tiene 3 controladores, y uno de 128x128 tiene 4 controladores.</p>
<p>Cada controlador es independiente, es decir, no transmiten información entre ellos. Para elegir a qué controlador hablarle, se usan dos líneas de control, llamadas CS1 y CS2 (CS = Chip Select). Básicamente actúa como una "dirección" de 2 bits, que elige a cual de los 4 controladores posibles se desea hablar. El controlador no tiene generador interno de fuentes, por lo que si se desea escribir un texto, será necesario almacenar los píxeles de cada caracter en un microcontrolador o memoria externa.</p>
<p>En total están estas líneas:	
	<ul>
		<li>VSS: 0V, referencia de masa para el chip</li>
		<li>VDD: 5V, alimentación del lcd</li>
		<li>V0: Contraste</li>
		<li>D/I: Elige si se desea escribir/leer un dato (1) o instrucción (0)</li>
		<li>R/W: Elige si se desa leer (1) o escribir (0)</li>
		<li>E: Cuando se hace un pulso en esta terminal, se hace la transferencia</li>
		<li>DB0..7: Conforman el bus de datos, es de donde se lee y donde se escriben los datos a transferir</li>
		<li>CS1..2: Eligen el controlador al que se le quiere hablar</li>
		<li>RES: Al estar en 0 resetea los controladores</li>
		<li>Vee: Salida de tensión negativa</li>
		<li>K y A: Luz de fondo (Backlight) del LCD</li>
	</ul>
</p>
<p>La mayoría de los LCDs poseen internamente un generador de tensión negativa, necesario para manejar los segmentos propiamente dichos. Para controlar el contraste, es necesario usar un preset de 20 kiloohms, conectado entre Vee y Vdd (en los extremos) y la terminal del medio a V0. Las terminales A y K están conectadas a un LED interno, deberían ser conectadas a 5v y 0v correspondientemente, con una resistencia de 100-200 ohm en serie para asegurarse de que el/los LEDs estén protegidos.</p>
<p>Como enviar un comando o dato al LCD:
	<ol>
		<li>Elegir el controlador al que se desea hablar (terminales CS1 y CS2)</li>
		<li>Poner D/I en el estado correcto: 1 si se desea escribir un comando, 0 si se desea escribir datos</li>
		<li>Poner en el bus de datos el comando o dato que se desea escribir</li>
		<li>Hacer un pulso en la terminal E</li>
		<li>Esperar el tiempo correspondiente (500nS) por lo general</li>
	</ol>
</p>
<p>El display está dividido en 8 secciones horizontales llamadas páginas (de 8 pixeles de alto cada uno) y 64 líneas verticales.</p>
<h3>Lista de comandos importantes</h3>
<h4>Prender/Apagar display</h4>
<p>D/I = 0, DB = 0x3F (prendido) o 0x3E (apagado)</p>
<h4>Elegir posición (X)</h4>
<p>D/I = 0, DB = 0x40 + dirección (0 a 63)</p>
<h4>Elegir página (Y)</h4>
<p>D/I = 0, DB = 0x9C + página (0 a 7)</p>
<h4>Escribir datos</h4>
<p>D/I = 1, DB = dato a escribir<br/>Luego de escribir un dato, se incrementa la posición horizontal.</p>

