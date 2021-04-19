---
title: "Expandir puertos de entrada y salida de un microcontrolador"
tags: ["articles", "electronics"]
summary: "Cómo agregar más entradas o salidas digitales a un controlador, usando registros de desplazamiento (shift registers)."
thumbnail: "/thumbs/expandir.png"
aliases: ["/expandir/"]
---

Hay veces en las que para alguna aplicación necesitamos más pines de salida o entrada de los que tenemos en el microcontrolador. Hay varias soluciones:

* Usar algún chip PPI como el 8255 (caro, grande y lento), de interfaz paralela (nos usa 10 terminales)
* Usar algún integrado expansor de E/S via I2C, como el PCF8575 (caro y dificil de conseguir)
* Usar lógica 74xxx (relativamente barato, programación sencilla, facil de conseguir)

### Expandir Salidas
La mejor solución es la tercera, es posible emplear un 74x164 (sin latch) o 74x595 (con latch) para expandir la cantidad de salidas. La ventaja de estos integrados es que se pueden poner en cascada, y así agregar 8 puertos por cada integrado agregado.

Básicamente son shift registers, es decir, una cadena de flip-flops del tipo D encadenados, por lo que uno puede ir "empujando" datos por un lado y tener acceso a los 8 bits:

![Diagrama shift register](/images/74164.png)

Generalmente tienen 3 terminales de control:

* Clock: Al dar un pulso, los datos se van "desplazando" por los flip flops, y un dato nuevo entra al FF de la izquierda
* Datos: Marcan qué bit agregar a la izquierda al dar un pulso de clock
* Reset: Al dar un pulso, hace que todos los bits pasen a 0

Algunos (como el 74x595) tienen una terminal más, que hace que los datos pasen a la salida. Es decir, los cambios se hacen sobre flip flops internos (que no controlan las terminales físicas) y al activar esa terminal extra los bits aparecen en las terminales:

![Diagrama shift register con latch](/images/74595.png)

Conviene elegir el shift register con latch en el caso de que las salidas necesiten persistencia (es decir, si las salidas están conectadas a cargas reales, como relés o motores), para evitar que en una terminal haya un valor incorrecto (aunque sea por milisegundos).

Por lo tanto, si queremos escribir una tira de bits en estos shift registers, debemos hacer esta secuencia:

* Por cada bit: (empezando por el de más a la derecha)
  * Poner ese bit en la terminal de "Dato"
  * Hacer un pulso en la terminal de "Clock"
* Hacer un pulso en la terminal de "Latch" (si hay), para hacer que se activen las salidas correspondientes

Es posible poner varios shift register en cascada, de la siguiente manera:

![Shift registers en cascada](/images/74164_cascada.png)

Un ejemplo útil de ésto es poder manejar varias matrices de LEDs, unicamente con pocas terminales de un microcontrolador:

![Esquemático matrices de LEDs](/images/megamatrix_dsn.png)

### Expandir Entradas
Para las entradas, es posible usar integrados como los 4014. Básicamente es similar a las salidas, con la diferencia que los shift registers son de entrada paralela y salida serial. Este sería la secuencia para leer los bits:

* Hacer un pulso en la terminal de "Latch", para que el integrado guarde en los FF internos el valor de las terminales
* Por cada bit[i] que se quiera leer: (desde la derecha)	
	* Leer de la terminal de "Dato", ese es el bit[i]
	* Hacer un pulso en la terminal de "Clock"
	* Incrementar i
		
La forma de expandir los shift registers para obtener más puertos de entrada es la siguiente:
![Shift register para expandir entradas](/images/4014.png)
