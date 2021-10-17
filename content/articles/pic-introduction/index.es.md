---
title: "Introducción a microcontroladores PIC"
tags: ["articles", "electronics"]
summary: "Pequeño resumen introductorio sobre microcontroladores de 8 bit, en particular de la familia Microchip PIC16."
thumbnail: "/thumbs/pic.png"
aliases: ["/intropic/"]
date: "2010-01-01"
---

Para poder definir a un microcontrolador PIC, primero necesitaríamos saber qué es un microcontrolador. A grandes rasgos es un circuito integrado que adentro posee las mismas cosas básicas que tiene una computadora: 
* **CPU**: es el que procesa y realiza todas las instrucciones de una computadora. Sus parámetros más importantes son la velocidad máxima que puede soportar y el ancho del bus de datos que poseen. Generalmente en los microcontroladores se utilizan CPUs relativamente lentas, y por lo general de 8 a 32 bits.
* **Memoria**: es la que almacena tanto las instrucciones del programa como los espacios que van a ser usados por el programa para almacenar datos temporales (RAM). Generalmente los microcontroladores tienen su memoria de programa en una del tipo flash.
* **Periféricos**:
    * **Entradas y salidas de propósito general** (*GPIO* en inglés): suelen estar agrupadas de a 8, permiten leer datos del exterior del microcontrolador o escribir al exterior. Suelen usarse para controlar dispositivos externos, como leds, relés, interruptores, o cualquier otra cosa que pueda ser controlada de forma digital.
    * **Entradas analógicas:** no son más que conversores analógico-digital puestos adentro del microcontrolador, que permiten trabajar con señales analógicas. Su parámetro a tener en cuenta es la velocidad de sampleado y la resolución del mismo, ya que nos permitirán trabajar con señales de mayor frecuencia y tener una mayor precisión.
    * **Temporizadores y contadores:** son circuitos sincrónicos que permiten contar tiempos internos (temporizadores) o externos (contadores). Pueden ser usados para general señales de clock, contar frecuencia, etc. Por lo general pueden ser usados como fuente de interrupciones (ver más abajo)
    * **Memorias no volátiles:** algunos microcontroladores también tienen una memoria EEPROM interna, usualmente destinada a guardar datos de configuración del programa que se conserven incluso después de sacada la energía. Algunos microcontroladores también permiten usar la memoria de programa como memoria de datos, como si fuese un periférico más. 
    * **Modulador de ancho de pulsos:** es un periférico que permite cambiar la frecuencia y el duty de un generador interno de PWM. Estos periféricos pueden ser usados para controlar velocidades de motores, convertir de digital a analógico, regular luz, hacer sonidos, etc. 
    * **Comparadores:** son periféricos analógicos que permiten comparar dos señales analógicas, generalmente una es generada por una tensión de referencia interna y la otra proviene del exterior. Esto nos permite saber cual es mayor y dar un resultado binario dependiendo de la salida del comparador. Algunos comparadores tienen soporte para interrupciones. 
    * **Puertos de comunicación:** La mayoría de los microcontroladores tiene internamente una UART/USART, que permite comunicar el microcontrolador con el exterior. Generalmente hay dos tres de comunicación: paralela, serie asincrónica y serie sincrónica. También algunos microcontroladores modernos poseen periféricos con soporte para USB, ethernet, etc. 


Las ventajas de usar un microcontrolador es que permite disminuir el costo y consumo de energía de un sistema. En cuanto a los PICs, generalmente son elegidos para proyectos debido a su sencillez, su bajo costo, su alta cantidad de código compatible disponible en la web y su facilidad para ser programado.

Los PIC a los que está orientado éste artículo son los de gama baja/media, también llamada serie 16F. Los microcontroladores de esta serie pueden manejar datos de 8 bits y están basados en la arquitectura Harvard, es decir que la memoria de programa está separada de la memoria de datos.

Para poder empezar a hacer pequeños proyectos con PICs necesitamos tres cosas:

* Un programa que transforme código en instrucciones que el microcontrolador entienda (compilador / ensamblador)
* Componentes para probar los circuitos / un simulador
* Paciencia

En este tutorial nos vamos a enfocar en el PIC16F628A, que tiene pocas prestaciones pero es perfecto para aplicaciones sencillas y para entrar al mundo de los microcontroladores. Tiene 2K de memoria de programa, 224 bytes de ram y 128 bytes de memoria eeprom. 

Los modelos de PICs se distinguen de la siguiente forma:

* Primer campo: Modelo
* Segundo campo: Rango de temperatura y tensión (I = industrial, E = extendido)
* Tercer campo (opcional): Velocidad máxima soportada (4/20/45) - en MHz
* Cuarto campo: Formato del encapsulado (ML = QFN, P = PDIP, SO = SOIC, SS = SSOP) 

![Descripción códigos microcontroladores PIC](/images/modelospic.png)

### ¿Cómo hacer un programa para un microcontrolador?
Hay tres formas básicas distintas de 'crear' un programa para un microcontrolador: en C, en Basic y en Assembler.

Para compilar en C el programa más conocido es el CCS, un compilador de c para micros bastante bueno y rápido, el problema es que es pago. El 'Hola mundo!' es un programa de prueba que se hace para verificar que el entorno, el compilador y toda las herramientas funcionen bien. En un microcontrolador, el programa más básico es hacer que un LDC parpadee.

En C el programa es fácil de entender:

```c
#include <16f628a.h> // Le decimos al compilador que micro tenemos
#use delay(clock=4000000) // Para usar el delay le decimos que corre a 4MHz

void main(){
	while(true){
		output_high(PIN_A0); // Encendemos el pin A0
		delay_ms(500); // Esperamos medio segundo
		output_low(PIN_A0); // Apagamos el pin A0
		delay_ms(500); // Esperamos medio segundo
	}
}
```

Este programa compilado ocupó 52 Words (de 14 bits c/u)

Para compilar en basic, hay un simulador que incluye un compilador de basic que se llama PIC SIMULATOR IDE. También es pago. El código del mismo programa en basic es el siguiente:

```basic
main:
	High PORTA.0
	WaitMs 500
	Low PORTA.0
	WaitMs 500
	Goto main
```

El programa compilado ocupó 66 Words (de 14 bits nuevamente)

### ¿Cómo pasar el compilado HEX al micro?

Necesitamos un programador (también llamado quemador) de PICs. Es posible construir uno o comprarlo (hay todo un rango de precios). Uno de los más baratos se llama JDM, se conecta a la PC por puerto serie. Es posible que no funcione con notebooks antiguas, ya que algunas suelen tener distintas tensiones. Hay que tener en cuenta que el ciertas configuraciones del microcontrolador (en particular, oscilador interno activado y reset automático) pueden hacer que deje de ser programable.

Hay varios programas para pasar el hex al microcontrolador, como el IC-Prog, Pony Prog, WinPic800, PicPGM. 

Las soluciones que usan ZIF (`Zero-insertion force`, un tipo de zócalo en el que no hay que hacer fuerza, sólo girar una palanca para sacar el circuito integrado) permiten evitar problemas de roturas de los pines luego de muchas inserciones.

Además, el microcontrolador permite programación In-Circuit, es decir, sin sacarlo del circuito de aplicación. Ésto se hace mediante cinco conexiones que se comunican al microcontrolador y al programador.

Son los pines llamados VPP (Tensión de programación), Vss, Vdd, Pgd (Programming Data) y Pgc (Programming Clock). Luego de cablear esto no es necesario sacar al integrado del zócalo para programarlo.

![PIC pinout](/images/picpinout.jpg)

Un esquemático sencillo es el siguiente:

![PIC circuit](/images/piccircuit.png)

Componentes:

* D1 es un diodo rectificador, evita que se queme el microcontrolador al conectar la tensión al revés.
* IC1 regula la tensión de entrada a 5v, necesarios para que el micro corra bien y no se queme (C1 y C2 hacen de filtro y sacan ruido eléctrico)
* El PIC está conectado a 5v y masa, y del pin 17 (Bit 0 del puerto A - RA0) salen un LED y una resistencia en serie. La resistencia está para limitar la corriente que circula por el LED, si no estuviese podría quemar tanto al LED como al PIC.
