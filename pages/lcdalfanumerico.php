<?php
	$descripcionPagina = 'Cómo controlar un LCD alfanumérico -Inteligente- desde un microcontrolador. Incluye comandos y esquemáticos.';
	$tituloPagina = 'Controlando un LCD alfanumérico de 20x4 con controlador HD44780';
	
	echo addBoxBeg('LCDs alfanuméricos basados en HD44780');
?>
<p>Estos LCDS alfanuméricos (también llamados "inteligentes", por poseer controlador en la misma placa y casi no necesitar tiempo de CPU para usarlos) son un estándar industrial diseñados especialmente para interfaces con sistemas embebidos (microcontroladores o microprocesadores). Vienen en una gran cantidad de configuraciones distintas, 8x1 (1 fila, 8 carácteres), 16x2, 20x4, entre otros. La más común es la de 20x4.</p>
<p>En estos LCDs se puede mostra unicamente texto (y hasta 8 caracteres definidos), por lo que se suelen usar en máquinas sencillas como impresoras, faxes, copiadoras, cajas registradoras, entre otras. Pueden venir con o sin backlight (luz de fondo), que puede ser fluorescente o LED (más común).</p>
<p>Suelen venir en una interfaz de 16 pines, cuyo pinout suele ser el siguiente:</p>
<ul>
	<li>Masa</li>
	<li>VCC (3.3 o 5V)</li>
	<li>Ajuste de contraste (VO)</li>
	<li>RS (selección de registro: RS=0 significa comando, RS=1 significa datos)</li>
	<li>RW (selección de operación: RW=0 significa escribir, RW=1 significa leer)</li>
	<li>Enable (se activa con flanco descendente)</li>
	<li>Bit[0..7] (bus de datos del LCD)</li>
	<li>Opcional: Ánodo del backlight (+)</li>
	<li>Opcional:Cátodo del backlight (-)</li>
</ul><br/>
<p>Estos LCDs pueden operar en modo de 4 y 8 bits. En el modo de 4 bits, se envian bytes dividiéndolos en nibbles (4 bits) y enviándolos por la parte alta (Bit[4..7]). En el modo de 4 bits, todos los comandos son exactamente iguales, lo único que cambia es la inicialización (en la que hay que establecer que se desea usar el modo de 4 bits).</p>
<p>La ROM interna suele tener caracteres ASCII y quizás algunos Griegos o Japoneses, depende de donde se haya fabricado. Es posible usar hasta 8 caracteres personalizados (cuya posición en ascii sería 0...7), que se graban en RAM, por lo que se pierden al apagarse.</p>
<p>Si se desea usar uno de estos LCDs con una computadora, es posible utilizar el programa <a href="http://lcdsmartie.sourceforge.net/">LCD Smartie</a>, que permite conectar una PC a un LCD alfanumérico mediante el puerto paralelo.</p>
<p>La conexión básica de un LCD alfanumérico a un microcontrolador sería la siguiente:</p>
<img src="/images/lcdalfa.png" alt="Conexión LCD alfanumérico HD44780" style="width:100%;max-width:447px;"/>
<p>Como se puede ver, el control del contraste se hace con un potenciómetro de 10K (puesto como divisor resistivo). La terminal de RW se puso a masa porque no necesitaremos leeremos del LCD. Las lineas de datos deben ser conectadas a un puerto del microcontrolador (preferiblemente mantieniendo el orden) y las de control también.</p>
<p>Como enviar un comando o dato al LCD:
	<ol>
		<li>Poner RS en el estado correcto: 0 si se desea escribir un comando, 1 si se desea escribir datos</li>
		<li>Poner en el bus de datos el comando o dato que se desea escribir</li>
		<li>Hacer un pulso descendente en la terminal E</li>
		<li>Esperar el tiempo correspondiente a esa instrucción</li>
	</ol>
</p>
<p>Como se puede ver es relativamente sencillo. Cabe aclarar que al prenderse, el HD44780 hace unas pruebas internas, limpia la memoria y otras tareas, que puede tardar hasta 20 milisegundos. Por eso hay que asegurarse de que los comandos que enviemos los enviemos luego que el LCD se haya inicializado.</p>
<p>Algunos comandos importantes:</p>
<h3>Borrar pantalla</h3>
<p>RS = 0, Datos = 0000 0001, Tiempo: 2 milisegundos<br/>Acción: Borra el LCD y pone el cursor en la posición 0</p>
<h3>Prender/apagar display</h3>
<p>RS = 0, Datos = 0000 1DCB, Tiempo: 40 microsegundos<br/>Acciones: 
	<ul>
		<li>Prende (D=1) o apaga (D=0) LCD</li>
		<li>Activa (C=1) o desactiva (C=0) la visión del cursor</li>
		<li>Activa (B=1) o desactiva (B=0) el parpadeo del cursor</li>
	</ul>
</p>
<h3>Selección de función</h3>
<p>RS = 0, Datos = 001 BNF--, Tiempo: 40 microsegundos<br/>Acciones:
	<ul>
		<li>Elige interfaz 8 bits (B=1), 4 bits (B=0)</li>
		<li>Elige 2 líneas (N=1), 1 línea (N=0)</li>
		<li>Elige caracteres de 5x8 (F=0) o 5x10 (F=1)</li>
	</ul>
</p>
<h3>Elegir dirección DD</h3>
<p>RS = 0, Datos = 1DIRECCI, Tiempo: 40 microsegundos<br/>Acción: Elige la dirección de la memoria interna a donde se quiere escribir</p>
<p>En la memoria DD se guardan todos los caracteres mostrados en la pantalla. En una pantalla de 20x4, las lineas están en las siguientes posiciones de memoria:
	<ul>
		<li>Línea 0: Posición 0</li>
		<li>Línea 1: Posición 64</li>
		<li>Línea 2: Posición 20</li>
		<li>Línea 3: Posición 84</li>
	</ul>
</p>
<h3>Escribir datos</h3>
<p>RS = 1, Datos = CARASCII, Tiempo: 40 microsegundos<br/>Acción: Escribe el dato especificado a la dirección especificada anteriormente, e incrementa el puntero.</p>
<h3>Secuencia de inicialización (8 bits)</h3>
<p>La secuencia de inicialización del LCD por lo tanto es la siguiente:
	<ol>
		<li>Esperar 20 milisegundos</li>
		<li>Enviar comando 0000 1110 (prender LCD, activar cursor, desactivar parpadeo)</li>
		<li>Esperar 40 uS</li>
		<li>Enviar comando 0000 0110 (activar mover cursor a la derecha)</li>
		<li>Esperar 40 uS</li>
		<li>Enviar comando 0011 1000 (bus de 8 bits, 4 líneas, fuente de 5x8)</li>		
		<li>Esperar 40 uS</li>
	</ol>
</p>
<p>Una vez que se inicializamos el LCD, escribir un caracter en una posición (x;y) es tan sencillo como hacer lo siguiente:
	<ol>
		<li>Calcular la posición en memoria: PosMem = dirComienzoLinea[y] + x</li>
		<li>Enviar comando 1PosMem (para elegir la posición a escribir)</li>
		<li>Esperar 40 uS</li>
		<li>Enviar el código ASCII del caracter a imprimir, como dato</li>
	</ol>
</p>
<p>Luego de hacer eso, el caracter deseado aparecerá en el lcd, en la posición deseada. Es posible expandir el sistema guardando coordenadas x e y, para hacer que al escribir un texto largo aparezca en dos líneas.</p>
<p>Los caracteres soportados son los siguientes:<br/>
<img src="/images/lcd-font.png" alt="Caracteres LCD alfanumérico HD44780" style="width:100%;max-width:226px;"/>
</p>

<?php echo addBoxEnd();?>