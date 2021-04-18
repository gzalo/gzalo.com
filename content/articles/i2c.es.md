---
title: "Introducción al protocolo I2C, lectura y escritura en memorias 24LC"
tags: ["articles", "electronics"]
summary: "Muy útiles, por ejemplo para guardar datos de configuración o mantener un registro de sensores."
thumbnail: "/thumbs/i2c.png"
aliases: ["/i2c/"]
---

<p>I2C (pronunciado I cuadrado C) es un estándar que facilita la comunicación entre distintos dispositivos (microcontroladores, memorias, monitores de computadoras, y muchos otros dispositivos que tengan "inteligencia").</p>
<p>Solamente requiere dos líneas de señal: Una de datos y una de clock (además de la masa común). Fue diseñado por Philips y la velocidad a la que se lo suele usar es 100 Kbits por segundo, pero hay algunos dispositivos que pueden transmitir más rapido.</p>
<p>El bus I2C es serie (todos los datos van por una misma señal "uno atrás del otro") y síncronico (una de las señales se usa para sincronizar y marcar el tiempo).</p>
<p>La señal de datos se llama SDA, la de clock se llama SCL o SCK. Como son señales de colector abierto, es necesario agregar resistencias de pullup de entre 2K y 50K (tipicamente se usa 10K).</p>
<p>El protocolo se basa en distintas señales, que por lo general son enviadas por el dispositivo maestro. En estado de reposo ambas lineas permanecen en un estado lógico "1".</p>
<p>La señal de start y la señal de stop, que se hacen para indicar el comienzo/finalización de un pedido a un dispositivo esclavo, son los únicos tipos de señal en la que se permite que SDA cambie cuando SCK está en alto:</p>
<img src="/images/secuenciasi2c.png" alt="Secuencias START y STOP I2C" style="width:100%;max-width:486px;"/>
<p>Los datos se transfieren en secuencias de 8 bits, de forma serie. Los bits, empezando por el más alto, son puestos en la línea SDA y se hace un pulso en la línea SCK (pulso de subida y luego de bajada). Cada 8 bits transmitidos, el receptor agrega un bit de "acuso de recibo", que en caso de ser 0, indica que el receptor está listo para recibir más datos. Si el receptor envía un bit 1, es porque no puede aceptar más datos, por lo que el maestro debería terminar la transferencia con una señal de stop.</p>
<img src="/images/secuenciaenvioi2c.png" alt="Secuencia envío I2C" style="width:100%;max-width:390px;"/>
<p>Por lo general, los dispositivos i2c tienen una dirección de 7 bits, por lo que antes de realizar una transferencia, es necesario enviar un paquete con la dirección del dispositivo con el que queremos hablar. Se envían los 7 bits de la dirección y se le agrega un bit extra, que indica si queremos leer (1) o escribir (0) del mismo.</p>
<p>Un ejemplo de aplicación son las memorias EEPROM 24LCXXX. Estas memorias son muy útiles, suelen ser usadas para guardar datos de configuración o mantener un registro de sensores. Al ser I2C solamente necesitan dos líneas, muy útil se se están usando microcontroladores pequeños con pocos recursos.</p>
<p>Estas memorias son EEPROM no-volátiles (es decir, al sacarle alimentación no pierden lo que tenían), y vienen desde 128 bytes hasta 1 Megabyte. Para dar un ejemplo, una 24LC256 (de 256 kilo bits / 32 Kilo Bytes) puede costar tres dólares.</p>
<p>No están diseñadas para uso continuo (al millón de escrituras dejan de andar), por lo que su uso se limita a datos fijos o con poco cambio (configuraciones, registros, entre otras). Al tener una demora grande al escribir (5 milisegundos) no pueden ser usadas para reemplazar a RAMs.</p>
<p>Escribir o leer en una de estas memorias es relativamente fácil, es necesario tener I2C por hardware o simularlo. Cada memoria tiene 3 terminales a través de las cuales se puede elegir su "dirección virtual", lo que permite poner varias en cascada.</p>
<h3>Escritura de un byte</h3>
<p>El proceso es el siguiente:
	<ol>
		<li>Hacer una secuencia de inicio</li>
		<li>Enviar 1010XXX0, donde XXX es la dirección de ese circuito integrado, esperar ACK</li>
		<li>Enviar el byte alto de la dirección en la que se desea escribir, esperar ACK</li>
		<li>Enviar el byte bajo de la dirección en la que se desea escribir, esperar ACK</li>
		<li>Enviar el dato que se desea escribir, esperar ACK</li>
		<li>Hacer una secuencia de parada</li>
	</ol>
</p>
<h3>Escritura de una página</h3>
<p>La memoria también soporta escritura por páginas (es decir, escribir más de un byte a la vez), lo que puede reducir los tiempos de escritura drásticamente. Generalmente las páginas son de 64 bytes, por lo que solo se podrá empezar a escribir en direcciones múltiplos de 64.</p>
<p>El proceso entonces es el siguiente:
	<ol>
		<li>Hacer una secuencia de inicio</li>
		<li>Enviar 1010XXX0, donde XXX es la dirección de ese circuito integrado, esperar ACK</li>
		<li>Enviar el byte alto de la dirección en la que se desea escribir, esperar ACK</li>
		<li>Enviar el byte bajo de la dirección en la que se desea escribir, esperar ACK</li>
		<li>Enviar el dato 0 que se desea escribir, esperar ACK</li>
		<li>Enviar el dato 1 que se desea escribir, esperar ACK</li>
		<li>Enviar el dato 2 que se desea escribir, esperar ACK</li>
		<li>Enviar el dato 3 que se desea escribir, esperar ACK</li>
		<li>...</li>
		<li>Para no enviar más, hacer una secuencia de parada</li>
	</ol>
	Es posible enviar cualquier cantidad de datos, hasta 64, siempre terminando con una secuencia de parada.
</p>
<h3>Esperar a fin de escritura</h3>
<p>Luego de hacer una petición de escritura, la memoria no responderá por 5 milisegundos, hasta que termine de escribir los datos. Es posible controlar si sigue ocupado mandando el principio de una petición de escritura. Si la memoria responde con un ACK, es que terminó de escribir. Caso contrario, sigue ocupada.</p>
<h3>Lectura aleatoria</h3>
<p>Leer de cualquier posición de la memoria se puede hacer de la siguiente manera:
	<ol>
		<li>Hacer una secuencia de inicio</li>
		<li>Enviar 1010XXX0, donde XXX es la dirección de ese circuito integrado, esperar ACK</li>
		<li>Enviar el byte alto de la dirección en la que se desea leer, esperar ACK</li>
		<li>Enviar el byte bajo de la dirección en la que se desea leer, esperar ACK</li>
		<li>Hacer una secuencia de inicio</li>
		<li>Enviar 1010XXX1, donde XXX es la dirección de ese circuito integrado, esperar ACK</li>
		<li>Leer datos, no dar ACK a la memoria</li>
		<li>Hacer una secuencia de parada</li>
	</ol>
</p>
<h3>Lectura secuencial</h3>
<p>Al igual que la escritura, es posible leer varios bytes seguidos:
	<ol>
		<li>Hacer una secuencia de inicio</li>
		<li>Enviar 1010XXX0, donde XXX es la dirección de ese circuito integrado, esperar ACK</li>
		<li>Enviar el byte alto de la dirección en la que se desea leer, esperar ACK</li>
		<li>Enviar el byte bajo de la dirección en la que se desea leer, esperar ACK</li>
		<li>Hacer una secuencia de inicio</li>
		<li>Enviar 1010XXX1, donde XXX es la dirección de ese circuito integrado, esperar ACK</li>
		<li>Leer dato 0, dar ACK a la memoria</li>
		<li>Leer dato 1, dar ACK a la memoria</li>
		<li>Leer dato 2, dar ACK a la memoria</li>
		<li>Leer dato 3, dar ACK a la memoria</li>
		<li>...</li>
		<li>Para no recibir más, no dar ACK y hacer una secuencia de parada.</li>
	</ol>
</p>
<p>Algunos otros ejemplos de dispositivos I2C son los populares RTC (relojes de tiempo real) DS1307, que permiten mantener el tiempo y hacer relojes o alarmas. Además suelen poseer memoria RAM o EEPROM interna. También existen memorias RAMs no volátiles, que son como las memorias EEPROM pero permiten infinitos ciclos de escritura, es decir, no se "gastan" con el tiempo.</p>