<?php
	$descripcionPagina = 'Preguntas frecuentes de Pal/Pla/Pal. Son dispositivos programables que pueden comportarse como diversos tipos de compuertas lógicas.';
	$tituloPagina = 'Introducción a PLD';
	
		echo addBoxBeg('Introducción a PLD (dispositivos lógicos programables)');
?>

<h2>&iquest;Qué es y para qu&eacute; sirve una Pal/Gal/Pla?</h2>
<p>Es un componente electrónico programable que permite construir circuitos digitales. La familia completa es llamada PLD (Dispositivo lógico programable).</p>
<p>El uso principal es minimizar la cantidad de circuitos integrados (y así bajar el costo y tamaño del equipo).</p>
<h2>&iquest;Qu&eacute; circuitos pueden sintetizarse en un PLD?</h2>
<p>Por lo general, es posible sintetizar cualquier circuito del tipo suma de productos (minitérminos) y en algunos dispositivos también circuitos secuenciales (aunque por lo general muy sencillos).</p>

<h2>&iquest;Qu&eacute; ventajas y desventajas obtengo comparado con los integrados TTL/CMOS?</h2>
<p>Por lo general hay un ahorro de costo y espacio significativo. Además, en algunos PLDs es posible reprogramar la lógica, cosa que sería imposible de estar cableada manualmente. Como desventajas está la necesidad de tener un programador, un entorno para escribir las ecuaciones lógicas y más dificultad para simularla.</p>

<h2>&iquest;Qu&eacute; diferencias hay entre PLA, PAL, GAL, CPLD?</h2>
<p>Las PLA son más flexibles, ya que permiten programar no solo la matriz de AND sino también la matriz de OR. Las PAL, en cambio, solamente permiten programar la matriz de AND, por lo que cuestan menos pero están limitadas en cuanto a la máxima cantidad de minitérminos por salida. Las GAL tienen las mismas propiedades de que las PALs, pero con la adición que pueden ser borradas y reprogramadas. Los CPLD son dispositivos lógicos programables que juntan varias celdas programables, de tal forma de que se puedan sintetizar circuitos más complejos, por lo general secuenciales, que necesiten máquinas de estado complejas o que no puedan ser implementadas en microcontroladores por necesitar altas velocidades.</p>

<h2>&iquest;En qué lenguaje se programa?</h2>
<p>Por lo general se usa algún lenguaje de "alto nivel" (como CUPL o ABEL) que describe la ecuaciones lógicas deseadas, y posteriormente se lo compila (mediante pasos de optimización y minimización) a un archivo JEDEC, que posee la información sobre qué fusibles internos quemar. Un entorno de desarrollo y simulación gratuito es <a href="http://www.atmel.com/tools/WINCUPL.aspx">WinCUPL</a> de Atmel.</p>

<h2>&iquest;C&oacute;mo se programa?</h2>
<p>Es necesario comprar (o construir) un programador. Al contrario que con los mayoría de los microcontroladores, no parece haber ninguno sencillo, ya que por lo general todos los PLD necesitan un voltaje de programación VPP de aproximadamente 15V.</p>

<h2>&iquest;D&oacute;nde se puede comprar? ¿Cuánto cuesta?</h2>
<p>El modelo GAL16v8 es posible comprarlo en varias casas de componentes, generalmente a un precio de aproximadamente 90 centavos de dolar por unidad.</p>

<h2>¿Cómo se puede configurar un determinado pin como entrada?</h2>
<p>Dependiendo del software en el que se esté programando, al acceder a la variable correspondiente a ese PIN ya debería establecerse como entrada. Además, si en ninguna parte se le asigna un valor, el PIN debería quedarse como entrada (estado de alta impedancia). A más bajo nivel, en la hoja de datos debería mostrar como se pueden hacer entradas dedicadas, por ejemplo en los dispositivos 16V8, configurar los fuses como SYN=1,AC0=0,AC1=1 hace que ese pin se comporte como entrada.
</p>

<h2>Ejemplos de aplicaciones con PLD</h2>
<p><ul>
<li>Conversores de código (por ejemplo de binario a gray o viceversa)</li>
<li>Conversores de binario a 7 segmentos (que también muestren las letras A-F)</li>
<li>Verificadores de paridad y chequeo de errores</li>
<li>Distintos tipos de contadores y registros</li>
<li>Controladores de memoria y E/S para microprocesadores</li>
<li>Tablas predefinidas (<a href="http://es.wikipedia.org/wiki/Lookup_table">LUT</a>)</li>
</ul></p>
<h2>&iquest;Como hacer una tabla en CUPL? </h2>
<p>Con este m&eacute;todo se evita tener que hacer la tabla, hacer el mapa de Karnaugh y hallar la ecuaci&oacute;n (suma de minitérminos) de cada salida, es posible dejar que el compilador lo haga automáticamente, por ejemplo de la siguiente manera:</p>
<p><pre><code>Device  g16v8 ;

PIN [13..19]=[S0..6];
PIN [2..5]=[E0..3];

FIELD entradas = [E0..3] ;
FIELD salidas = [S0..6] ;

TABLE entradas => salidas {
	0=>7E;    1=>30;    2=>6D;    3=>79;
	4=>33;    5=>5B;    6=>5F;    7=>70;
	8=>7F;    9=>73;    A=>77;    B=>1F;
	C=>4E;    D=>3D;    E=>4F;    F=>47;
}</code></pre></p>

<p>En este video se puede ver la simulación de ese código en un circuito simple, con un contador binario y una señal de clock:</p>
<p>
<iframe width="560" height="315" src="https://www.youtube.com/embed/NwBH5X1C8pI" frameborder="0" allowfullscreen></iframe>
</p>
<h2>¿Hay alguna alternativa con más capacidad?</h2>
<p>Si se necesita implementar una aplicación más compleja, es posible usar un CPLD o un FPGA. En el caso del primero, está compuesto por varios bloques, cada uno de los cuales forma una especie de PLD sencilla. Por lo general se suelen programar en los mismos lenguajes que los PLD. En el caso de los FPGAs, la arquitectura es distinta, suelen poseer una gran cantidad de celdas lógicas sencillas, que se pueden interconectar de una gran cantidad de maneras distintas. Por ejemplo, es posible implementar un microprocesador dentro de una FPGA. Por lo general se programan en otros lenguajes, como son el Verilog y el VHDL.</p>
<!--<p>Palabras clave: Programar PAL, Programar GAL, significado PAL, significado GAL, Lógica programable, cómo programar una GAL, usos comunes GAL/PAL, FPGA, CPLD, Lógica</p>
<p>Si estás acá porque querés programar (quemar) una PLD / GAL / PAL de Atmel (como la ATF16v8, ATF16v8B, ATF16LV8C, ATF16V8BQ, ATF16V8BQL, ATF16V8C, ATF16V8CZ, ATF22LV10C, ATF22LV10CQZ, ATF22LV10CZ, ATF22V10B, ATF22V10C, ATF22V10CQ, ATF22V10CQZ o ATF22V10CZ) te doy <strong>muy malas noticias</strong>: Atmel no libera las hojas de datos de cómo programar a no ser que pagues o firmes un contrato de confidencialidad, por lo que <strong>NO hay ningún</strong> hardware programador de código abierto, la única forma de programarlos es usando ciertos "programadores universales", que por lo general son extremadamente caros, no pensados para hobbistas y cerrados.</p>
<p>If you are here because you want to program (burn) an Atmel PLD / GAL / PAL (such as ATF16v8, ATF16v8B, ATF16LV8C, ATF16V8BQ, ATF16V8BQL, ATF16V8C, ATF16V8CZ, ATF22LV10C, ATF22LV10CQZ, ATF22LV10CZ, ATF22V10B, ATF22V10C, ATF22V10CQ, ATF22V10CQZ o ATF22V10CZ) I give you <strong>really bad news</strong>: Atmel doesn't release programming information unless you pay or sign an NDA, so there is <strong>NO</strong> open source PLD programmer for Atmel, the only way to program these chips is using some "universal programmers", which are extremely expensive, not really made for hobbyists and closed.</p>
-->

<?php echo addBoxEnd();?>