---
title: "Introducción al protocolo I2C, lectura y escritura en memorias 24LC"
tags: ["articles", "electronics"]
summary: "Muy útiles, por ejemplo para guardar datos de configuración o mantener un registro de sensores."
thumbnail: "/thumbs/i2c.jpg"
aliases: ["/i2c/"]
date: "2010-01-01"
---

I2C (pronunciado I cuadrado C) es un estándar que facilita la comunicación entre distintos dispositivos (microcontroladores, memorias, monitores de computadoras, y muchos otros dispositivos que tengan *inteligencia*).

Solamente requiere dos líneas de señal: Una de datos y una de clock (además de la masa común). Fue diseñado por Philips y la velocidad a la que se lo suele usar es 100 Kbits por segundo, pero hay algunos dispositivos que pueden transmitir más rapido.

El bus I2C es serie (todos los datos van por una misma señal *uno atrás del otro*) y síncronico (una de las señales se usa para sincronizar y marcar el tiempo).

La señal de datos se llama SDA, la de clock se llama SCL o SCK. Como son señales de colector abierto, es necesario agregar resistencias de pullup de entre 2K y 50K (tipicamente se usa 10K).

El protocolo se basa en distintas señales, que por lo general son enviadas por el dispositivo maestro. En estado de reposo ambas lineas permanecen en un estado lógico *1*.

La señal de start y la señal de stop, que se hacen para indicar el comienzo/finalización de un pedido a un dispositivo esclavo, son los únicos tipos de señal en la que se permite que SDA cambie cuando SCK está en alto:

![Secuencias START y STOP I2C](/images/secuenciasi2c.png)

Los datos se transfieren en secuencias de 8 bits, de forma serie. Los bits, empezando por el más alto, son puestos en la línea SDA y se hace un pulso en la línea SCK (pulso de subida y luego de bajada). Cada 8 bits transmitidos, el receptor agrega un bit de *acuso de recibo*, que en caso de ser 0, indica que el receptor está listo para recibir más datos. Si el receptor envía un bit 1, es porque no puede aceptar más datos, por lo que el maestro debería terminar la transferencia con una señal de stop.

![Secuencia envío I2C](/images/secuenciaenvioi2c.png)

Por lo general, los dispositivos I2C tienen una dirección de 7 bits, por lo que antes de realizar una transferencia, es necesario enviar un paquete con la dirección del dispositivo con el que queremos hablar. Se envían los 7 bits de la dirección y se le agrega un bit extra, que indica si queremos leer (1) o escribir (0) del mismo.

Un ejemplo de aplicación son las memorias EEPROM 24LCXXX. Estas memorias son muy útiles, suelen ser usadas para guardar datos de configuración o mantener un registro de sensores. Al ser I2C solamente necesitan dos líneas, muy útil se se están usando microcontroladores pequeños con pocos recursos.

Estas memorias son EEPROM no-volátiles (es decir, al sacarle alimentación no pierden lo que tenían), y vienen desde 128 bytes hasta 1 Megabyte. Para dar un ejemplo, una 24LC256 (de 256 kilo bits / 32 Kilo Bytes) puede costar tres dólares.

No están diseñadas para uso continuo (al millón de escrituras dejan de andar), por lo que su uso se limita a datos fijos o con poco cambio (configuraciones, registros, entre otras). Al tener una demora grande al escribir (5 milisegundos) no pueden ser usadas para reemplazar a RAMs.

Escribir o leer en una de estas memorias es relativamente fácil, es necesario tener I2C por hardware o simularlo. Cada memoria tiene 3 pines a través de las cuales se puede elegir su *dirección virtual*, lo que permite poner varias en el mismo bus I2C.

### Escritura de un byte
El proceso es el siguiente:
	
* Hacer una secuencia de inicio
* Enviar 1010XXX0, donde XXX es la dirección de ese circuito integrado, esperar ACK
* Enviar el byte alto de la dirección en la que se desea escribir, esperar ACK
* Enviar el byte bajo de la dirección en la que se desea escribir, esperar ACK
* Enviar el dato que se desea escribir, esperar ACK
* Hacer una secuencia de parada
	

### Escritura de una página
La memoria también soporta escritura por páginas (es decir, escribir más de un byte a la vez), lo que puede reducir los tiempos de escritura drásticamente. Generalmente las páginas son de 64 bytes, por lo que solo se podrá empezar a escribir en direcciones múltiplos de 64.

El proceso entonces es el siguiente:
	
* Hacer una secuencia de inicio
* Enviar 1010XXX0, donde XXX es la dirección de ese circuito integrado, esperar ACK
* Enviar el byte alto de la dirección en la que se desea escribir, esperar ACK
* Enviar el byte bajo de la dirección en la que se desea escribir, esperar ACK
* Enviar el dato 0 que se desea escribir, esperar ACK
* Enviar el dato 1 que se desea escribir, esperar ACK
* Enviar el dato 2 que se desea escribir, esperar ACK
* Enviar el dato 3 que se desea escribir, esperar ACK
* ...
* Para no enviar más, hacer una secuencia de parada
	
Es posible enviar cualquier cantidad de datos, hasta 64, siempre terminando con una secuencia de parada.

### Esperar a fin de escritura
Luego de hacer una petición de escritura, la memoria no responderá por 5 milisegundos, hasta que termine de escribir los datos. Es posible controlar si sigue ocupado mandando el principio de una petición de escritura. Si la memoria responde con un ACK, es que terminó de escribir. Caso contrario, sigue ocupada.

### Lectura aleatoria
Leer de cualquier posición de la memoria se puede hacer de la siguiente manera:
	
* Hacer una secuencia de inicio
* Enviar 1010XXX0, donde XXX es la dirección de ese circuito integrado, esperar ACK
* Enviar el byte alto de la dirección en la que se desea leer, esperar ACK
* Enviar el byte bajo de la dirección en la que se desea leer, esperar ACK
* Hacer una secuencia de inicio
* Enviar 1010XXX1, donde XXX es la dirección de ese circuito integrado, esperar ACK
* Leer datos, no dar ACK a la memoria
* Hacer una secuencia de parada

### Lectura secuencial
Al igual que la escritura, es posible leer varios bytes seguidos:
	
* Hacer una secuencia de inicio
* Enviar 1010XXX0, donde XXX es la dirección de ese circuito integrado, esperar ACK
* Enviar el byte alto de la dirección en la que se desea leer, esperar ACK
* Enviar el byte bajo de la dirección en la que se desea leer, esperar ACK
* Hacer una secuencia de inicio
* Enviar 1010XXX1, donde XXX es la dirección de ese circuito integrado, esperar ACK
* Leer dato 0, dar ACK a la memoria
* Leer dato 1, dar ACK a la memoria
* Leer dato 2, dar ACK a la memoria
* Leer dato 3, dar ACK a la memoria
* ...
* Para no recibir más, no dar ACK y hacer una secuencia de parada.

Algunos otros ejemplos de dispositivos I2C son los populares RTC (relojes de tiempo real) DS1307, que permiten mantener el tiempo y hacer relojes o alarmas. Además suelen poseer memoria RAM o EEPROM interna. También existen memorias RAMs no volátiles, que son como las memorias EEPROM pero permiten infinitos ciclos de escritura, es decir, no se *gastan* con el tiempo.