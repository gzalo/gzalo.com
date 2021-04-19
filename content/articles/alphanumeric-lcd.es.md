---
title: "LCDs alfanuméricos basados en HD44780"
tags: ["articles", "electronics"]
summary: "Cómo controlar un LCD alfanumérico inteligente desde un microcontrolador. Incluye Comandos y esquemáticos."
thumbnail: "/thumbs/lcdalfanumerico.png"
aliases: ["/lcdalfanumerico/"]
---

Estos LCDS alfanuméricos (también llamados "inteligentes", por poseer controlador en la misma placa y casi no necesitar tiempo de CPU para usarlos) son un estándar industrial diseñados especialmente para interfaces con sistemas embebidos (microcontroladores o microprocesadores). Vienen en una gran cantidad de configuraciones distintas, 8x1 (1 fila, 8 carácteres), 16x2, 20x4, entre otros. La más común es la de 20x4.

En estos LCDs se puede mostrar unicamente texto (y hasta 8 caracteres definidos), por lo que se suelen usar en máquinas sencillas como impresoras, faxes, copiadoras, cajas registradoras, entre otras. Pueden venir con o sin backlight (luz de fondo), que puede ser fluorescente o LED (más común).

Suelen venir en una interfaz de 16 pines, cuyo pinout suele ser el siguiente:

* Masa
* VCC (3.3 o 5V)
* Ajuste de contraste (VO)
* RS (selección de registro: RS=0 significa comando, RS=1 significa datos)
* RW (selección de operación: RW=0 significa escribir, RW=1 significa leer)
* Enable (se activa con flanco descendente)
* Bit[0..7] (bus de datos del LCD)
* Opcional: Ánodo del backlight (+)
* Opcional:Cátodo del backlight (-)

Estos LCDs pueden operar en modo de 4 y 8 bits. En el modo de 4 bits, se envian bytes dividiéndolos en nibbles (4 bits) y enviándolos por la parte alta (Bit[4..7]). En el modo de 4 bits, todos los comandos son exactamente iguales, lo único que cambia es la inicialización (en la que hay que establecer que se desea usar el modo de 4 bits).

La ROM interna suele tener caracteres ASCII y quizás algunos Griegos o Japoneses, depende de donde se haya fabricado. Es posible usar hasta 8 caracteres personalizados (cuya posición en ascii sería 0...7), que se graban en RAM, por lo que se pierden al apagarse.

Si se desea usar uno de estos LCDs con una computadora, es posible utilizar el programa [LCD Smartie](http://lcdsmartie.sourceforge.net/), que permite conectar una PC a un LCD alfanumérico mediante el puerto paralelo.

La conexión básica de un LCD alfanumérico a un microcontrolador sería la siguiente:

![Conexión LCD alfanumérico HD44780](/images/lcdalfa.png)

Como se puede ver, el control del contraste se hace con un potenciómetro de 10K (puesto como divisor resistivo). La terminal de RW se puso a masa porque no necesitaremos leeremos del LCD. Las lineas de datos deben ser conectadas a un puerto del microcontrolador (preferiblemente mantieniendo el orden) y las de control también.

Como enviar un comando o dato al LCD:
	
* Poner RS en el estado correcto: 0 si se desea escribir un comando, 1 si se desea escribir datos
* Poner en el bus de datos el comando o dato que se desea escribir
* Hacer un pulso descendente en la terminal E
* Esperar el tiempo correspondiente a esa instrucción
	
Como se puede ver es relativamente sencillo. Cabe aclarar que al prenderse, el HD44780 hace unas pruebas internas, limpia la memoria y otras tareas, que puede tardar hasta 20 milisegundos. Por eso hay que asegurarse de que los comandos que enviemos los enviemos luego que el LCD se haya inicializado.

Algunos comandos importantes:

### Borrar pantalla
RS = 0, Datos = 0000 0001, Tiempo: 2 milisegundos

Acción: Borra el LCD y pone el cursor en la posición 0

### Prender/apagar display
RS = 0, Datos = 0000 1DCB, Tiempo: 40 microsegundos

Acciones: 
	
* Prende (D=1) o apaga (D=0) LCD
* Activa (C=1) o desactiva (C=0) la visión del cursor
* Activa (B=1) o desactiva (B=0) el parpadeo del cursor
	

### Selección de función
RS = 0, Datos = 001 BNF--, Tiempo: 40 microsegundos

Acciones:

* Elige interfaz 8 bits (B=1), 4 bits (B=0)
* Elige 2 líneas (N=1), 1 línea (N=0)
* Elige caracteres de 5x8 (F=0) o 5x10 (F=1)
	

### Elegir dirección DD
RS = 0, Datos = 1DIRECCI, Tiempo: 40 microsegundos

Acción: Elige la dirección de la memoria interna a donde se quiere escribir

En la memoria DD se guardan todos los caracteres mostrados en la pantalla. En una pantalla de 20x4, las lineas están en las siguientes posiciones de memoria:
	
* Línea 0: Posición 0
* Línea 1: Posición 64
* Línea 2: Posición 20
* Línea 3: Posición 84
	

### Escribir datos
RS = 1, Datos = CARASCII, Tiempo: 40 microsegundos

Acción: Escribe el dato especificado a la dirección especificada anteriormente, e incrementa el puntero.

### Secuencia de inicialización (8 bits)
La secuencia de inicialización del LCD por lo tanto es la siguiente:
	
* Esperar 20 milisegundos
* Enviar comando 0000 1110 (prender LCD, activar cursor, desactivar parpadeo)
* Esperar 40 uS
* Enviar comando 0000 0110 (activar mover cursor a la derecha)
* Esperar 40 uS
* Enviar comando 0011 1000 (bus de 8 bits, 4 líneas, fuente de 5x8)		
* Esperar 40 uS
	

Una vez que se inicializamos el LCD, escribir un caracter en una posición (x;y) es tan sencillo como hacer lo siguiente:
	
* Calcular la posición en memoria: PosMem = dirComienzoLinea[y] + x
* Enviar comando 1PosMem (para elegir la posición a escribir)
* Esperar 40 uS
* Enviar el código ASCII del caracter a imprimir, como dato
	
Luego de hacer eso, el caracter deseado aparecerá en el lcd, en la posición deseada. Es posible expandir el sistema guardando coordenadas x e y, para hacer que al escribir un texto largo aparezca en dos líneas.

Los caracteres soportados son los siguientes:

![Caracteres LCD alfanumérico HD44780](/images/lcd-font.png)
