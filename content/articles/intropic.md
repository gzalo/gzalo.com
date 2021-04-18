---
title: ""
tags: ["articles", "electronics"]
summary: ""
thumbnail: "/thumbs/.png"
aliases: ["/intropic/"]
---
addProjectBox('Introducción a microcontroladores PIC', 'Pequeño resumen introductorio sobre microcontroladores de 8 bit, en particular de la familia Microchip PIC16','/thumbs/pic.png','/intropic/');

$descripcionPagina = 'Pequeña introducción a los microcontroladores PIC. Esquemáticos, códigos y más.';
	$tituloPagina = 'Introducción a los microcontroladores PIC';
<p>Para poder definir a un microcontrolador PIC, primero necesitaríamos saber qué es un microcontrolador. A grandes rasgos es un circuito integrado que adentro posee las mismas cosas básicas que tiene una computadora: <ul>
  <li><strong>CPU:</strong> es el que procesa y realiza todas las instrucciones de una computadora. Sus parámetros más importantes son la velocidad máxima que puede soportar y el ancho del bus de datos que poseen. Generalmente en los microcontroladores se utilizan CPUs relativamente lentas, y por lo general de 8 a 16 bits.</li><li><strong>Memoria:</strong> es la que almacena tanto las instrucciones del programa como los espacios que van a ser usados por el programa para almacenar datos temporales (RAM). Generalmente los microcontroladores tienen su memoria de programa en una del tipo flash eeprom.</li><li><strong>Periféricos:</strong>
    <ul>
      <li><strong>Entradas y salidas de propósito general </strong>(<em>GPIO</em> en inglés)<strong>:</strong> suelen estar agrupadas de a 8, permiten leer datos del exterior del microcontrolador o escribir al exterior. Suelen usarse para controlar dispositivos externos, como leds, relés, interruptores, o cualquier otra cosa que pueda ser controlada de forma digital.</li>
<li><strong>Entradas analógicas:</strong> no son más que conversores analógico-digital puestos adentro del microcontrolador, que permiten trabajar con señales analógicas. Su parámetro a tener en cuenta es la velocidad de sampleado y la resolución del mismo, ya que nos permitirán trabajar con señales de mayor frecuencia y tener una mayor precisión.</li>
<li><strong>Temporizadores y contadores:</strong> son circuitos sincrónicos que permiten contar tiempos internos (temporizadores) o externos (contadores). Pueden ser usados para general señales de clock, contar frecuencia, etc. Por lo general pueden ser usados como fuente de interrupciones (ver más abajo)</li>
<li><strong>
  Memorias no volátiles:</strong> algunos microcontroladores también tienen una memoria EEPROM interna, usualmente destinada a guardar datos de configuración del programa que se conserven incluso después de sacada la energía. Algunos microcontroladores también permiten usar la memoria de programa como memoria de datos, como si fuese un periférico más. </li>
<li><strong>
  Modulador de ancho de pulsos:</strong> es un periférico que permite cambiar la frecuencia y el duty de un generador interno de PWM. Estos periféricos pueden ser usados para controlar velocidades de motores, convertir de digital a analógico, regular luz, hacer sonidos, etc. </li>
<li><strong>
  Comparadores:</strong> son periféricos analógicos que permiten comparar dos señales analógicas, generalmente una es generada por un voltaje de referencia interno y la otra proviene del exterior. Esto nos permite saber cual es mayor y dar un resultado binario dependiendo de la salida del comparador. Algunos comparadores tienen soporte para interrupciones. </li>
<li><strong>
  Puertos de comunicación: </strong>La mayoría de los microcontroladores tiene internamente una UART/USART, que permite comunicar el microcontrolador con el exterior. Generalmente hay dos tres de comunicación: paralela, serie asincrónica y serie sincrónica. También algunos microcontroladores modernos poseen periféricos con soporte para USB, ethernet, etc. </li>
</ul></li></ul></p>
Las ventajas de usar un microcontrolador es que permite disminuir el costo y consumo de energía de un sistema. En cuanto a los PICs, generalmente son elegidos para proyectos debido a su sencillez, su bajo costo, su alta cantidad de código compatible disponible en la web y su facilidad para ser programado.
<p>
  Los PIC a los que está orientado éste artículo son los de gama baja/media, también llamada serie 16F. Los microcontroladores de esta serie pueden manejar datos de 8 bits y están basados en la arquitectura Harvard, es decir que la memoria de programa está separada de la memoria de datos.
</p>
<p>
Para poder empezar a hacer pequeños proyectos con PICs necesitamos tres cosas:
<ul>
<li>Un programa que transforme código en instrucciones que el microcontrolador entienda (compilador / ensamblador)</li>
<li>Componentes para probar los circuitos / un simulador</li>
<li>Mucha paciencia</li>
</ul>
</p>
En este tutorial nos vamos a enfocar en el PIC16F628A, que tiene pocas prestaciones pero es perfecto para aplicaciones sencillas y para entrar al mundo de los microcontroladores. Tiene 2K de memoria de programa, 224 bytes de ram y 128 bytes de memoria eeprom. 
<p>Los modelos de PICs se distinguen de la siguiente forma:</p>
<ul>
<li>Primer campo: Modelo</li>
<li>Segundo campo: Rango de temperatura y voltaje (I = industrial, E = extendido)</li>
<li>Tercer campo (opcional): Velocidad máxima soportada (4/20/45) - en MHz</li>
<li>Cuarto campo: Formato del encapsulado (ML = QFN, P = PDIP, SO = SOIC, SS = SSOP) </li>
</ul>
<img src="/images/modelospic.png" alt="Descripción códigos microcontroladores PIC" style="width:100%;max-width:279px;"/>
<h3>¿Cómo hacer un programa para un microcontrolador?</h3>
<p>Hay tres formas básicas distintas de 'crear' un programa para un microcontrolador: en C, en Basic y en Assembler.</p>
<p>Para compilar en C el programa más conocido es el CCS, un compilador de c para micros bastante bueno y rápido, el problema es que es pago. El 'Hola mundo!' es un programa de prueba que se hace para verificar que el entorno, el compilador y toda las herramientas funcionen bien. En un microcontrolador, el programa más básico es hacer que un LDC parpadee.</p>
<p>En C el programa es fácil de entender:</p>
<pre><code>
#include &lt;16f628a.h> //Le decimos al compilador que micro tenemos
#use delay(clock=4000000) //Para usar el delay le decimos que corre a 4MHz

void main(){
	while(true){
		output_high(PIN_A0); //Prendemos la línea A0
		delay_ms(500); //Esperamos medio segundo
		output_low(PIN_A0); //Apagamos la línea A0
		delay_ms(500); //Esperamos medio segundo
	}
}
</code></pre>
<p>Este programa compilado ocupó 52 Words (de 14 bits c/u)</p>
<p>Para compilar en basic, hay un simulador que incluye un compilador de basic que se llama PIC SIMULATOR IDE. También es pago. El código del mismo programa en basic es el siguiente:</p>
<pre><code>
main:
	High PORTA.0
	WaitMs 500
	Low PORTA.0
	WaitMs 500
	Goto main
</code></pre>
<p>El programa compilado ocupó 66 Words (de 14 bits nuevamente)</p>

<h3>¿Cómo pasar el compilado HEX al micro?</h3>
<p>Necesitamos un programador (también llamado quemador) de PICs. Es posible construir uno o comprarlo (hay todo un rango de precios). Uno de los más baratos se llama JDM, se conecta a la PC por puerto serie. Es posible que no funcione con notebooks antiguas, ya que algunas suelen tener distintas tensiones. Hay que tener en cuenta que el ciertas configuraciones del microcontrolador (en particular, oscilador interno activado y reset automático) pueden hacer que deje de ser programable.</p>
<p>Hay varios programas para pasar el hex al microcontrolador, como el IC-Prog, Pony Prog, WinPic800, PicPGM. </p>
<p>Las soluciones que usan ZIF (Zócalo en el que no hay que hacer fuerza, sólo girar una palanca para sacar el microcontrolador) permiten evitar problemas de roturas de terminales luego de muchas inserciones.</p>
<p>Además, el microcontrolador permite programación In-Circuit, es decir, sin sacarlo del circuito de aplicación. Ésto se hace mediante cinco conexiones que se comunican al microcontrolador y al programador.</p>
<p>Son las terminales llamadas VPP (Voltaje de programación), Vss, Vdd, Pgd (Programming Data) y Pgc (Programming Clock). Luego de cablear esto no es necesario sacar al integrado del zócalo para programarlo.</p>
<img src="/images/picpinout.jpg" style="width:100%;max-width:442px;"/>
<p>Un esquemático sencillo es el siguiente:</p>
<img src="/images/piccircuit.png" style="width:100%;max-width:400px;"/>
<p>Componentes:
	<ul>
		<li>D1 es un diodo rectificador, evita que se queme el microcontrolador al conectar la tensión al revés.</li>
		<li>IC1 regula la tensión de entrada a 5v, necesarios para que el micro corra bien y no se queme (C1 y C2 hacen de filtro y sacan ruido eléctrico)</li>
		<li>El PIC está conectado a 5v y masa, y de la terminal 17 (Bit 0 del puerto A - RA0) salen un LED y una resistencia en serie. La resistencia está para limitar la corriente que circula por el LED, si no estuviese podría quemar tanto al LED como al PIC.</li>
	</ul>
</p>