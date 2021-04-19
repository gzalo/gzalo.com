---
title: "Listado de software utilizados en electrónica"
tags: ["articles", "electronics"]
summary: "Análisis de algunos programas de electrónica que utilizé en algún momento."
thumbnail: "/thumbs/software.png"
aliases: ["/software/"]
date: "2010-01-01"
---
$descripcionPagina = 'Análisis de algunos programas de electrónica: diseño de esquemáticos, circuitos impresos, simulación, programación.';
	$tituloPagina = 'Listado y análisis de software utilizados en electrónica';
### Software de simulación, esquemáticos e impresos
**Electro Workbench 5.12: **Está lleno de bugs, especialmente con los cables (al agregar una conexión van para cualquier lado), tiene pocos componentes, algunos integrados salen mal, falla el redibujado automático, no tiene botón deshacer. No sirve para hacer circuitos impresos. Está bien para todo lo que sea simulación de puertas lógicas, tiene una sección que permite simplificar ecuaciones lógicas y también hacerla solo con NANDs. No soporta microcontroladores (PICs, AVRs, 8051, etc.)

**NI Multisim 10.0**: Es la versión nueva y mejorada del Electronics Workbench, supuestamente corrigieron varios bugs y es más profesional, le agregaron un software para diseñar circuitos impresos, agregaron pics, microprocesadores y memorias.
	
**Crocodile Technology**: Simula bastante bien, también permite ver en 3d tu circuito y hacer el impreso directamente desde el circuito, sin necesidad de poner tracks manualmente, tiene bastantes componentes (pero no microcontroladores, memorias ni cosas complicadas). Ideal para hacer circuitos sencillos a base de transistores o circuitos integrados de puertas lógicas basicas o 555.

**Cedar logic**:Es un simulador lógico digital que funciona en base a bloques, no hay forma de hacer una analogía a circuitos integrados comerciales, por lo que no sirve para armar un circuito en la realidad, habría que ver que integrado hace cada cosa y agregarlo. Simula memorias, teclados de matriz, micros z80, tiene un oscilloscopio de 6 canales. No sirve para hacer impresos.

**Eagle Layout Editor**: Es un programa de diseño de esquemáticos y creación de circuitos impresos, no tiene simulador, pero sirve para crear impresos muy rápido porque posee una opción de autorouter que la mayoría de las veces funciona bien. Lo bueno es que hay bibliotecas hechas por usuarios con casi todos los componentes. Esta suite es usada por empresas profesionales como SparkFun, Arduino, entre muchas otras.

**Protel 99SE**: Es una suite de diseño de esquemáticos y de circuitos impresos. No soporta simulación. Lleva bastante tiempo acostumbrarse a las combinaciones de teclas que hay que apretar para hacer cosas. Tiene algunos problemas que molestan: Problemas de redibujado, desaparición de componentes, tracks que se mueven mal, tracks que no se mueven al mover los componentes, entre otras cosas.

**Proteus**: Es uno de los mejores. Permite simular una gran cantidad de componentes, posee instrumentos de prueba variados (terminal serie, debugger SPI, debugger I2C, osciloscopio, analizador lógico). Tiene una opción para ver el circuito en 3d, simula en tiempo real microcontroladores, tiene toda la serie 4xxx y 74xxx de integrados disponibles. Permite diseñar impresos basándose en esquemáticos, aunque tiene un autorouter un poco pobre. 

**LTSpice**: Es un simulador de circuitos analógicos, permite hacer análisis precisos de funcionamiento de diversos circuitos en base a RLC, transistores, operacionales, entre otros. Es el ideal para hacer pruebas de funcionamiento de fuentes SMPS y analizar los rendimientos. No tiene una gran cantidad de componentes, pero es posible cambiar parámetros para lograr una gran variedad. No permite hacer circuitos impresos.

### Software de programación (quemado) de microcontroladores, memorias y PALs, CPLD y FPGAs

**Max Loader: **Permite programar una gran cantidad de microcontroladores, memorias y otros dispositivos. Necesita un hardware privativo y caro, por default abre los archivos hex como binarios (lo que da a una mala programación).

**ISP-30a: **Permite programar los microcontroladores de la serie AT89SXX. Necesita un puerto paralelo, para armarlo no hace falta ningún componente, solo el conector db25 y el conector isp.

**AtmelWrite: **Permite programar los microcontroladores de la serie AT89SXX. Necesita un puerto serie, para armarlo hace falta un max232 y sus capacitores, y un par de pasivos más.

**WinPic800: **Permite programar varios microcontroladores PIC, soporta una gran cantidad de tipos de programadores, entre los que está el popular y barato JDM. Programa todo rápido y suele andar bien, no tiene casi ningún bug.

**ICProg: **Permite programar varios microcontroladores de distintas marcas, soporta una gran cantidad de tipos de programadores, entre los que está el popular y barato JDM. Tiene una interfaz un poco vieja, suele programar un poco lento, es más dificil de configurar.

**PonyProg: **La interfaz parece medio antigua, pero tiene una gran variedad de microcontroladores y memorias (memorias 24lc, atmega, attiny, 8052).

**H-JTAG: **Es un programa que permite programar microcontroladores más modernos, via una interfaz JTAG. Muy útil para flashear routers o celulares. Se puede realizar un adaptador simple a puerto paralelo (aunque la velocidad no es muy rápida).

**PicPGM: **Alternativa al WinPic800, no necesita instalación de drivers para funcionar con el programador sencillo de puerto serie JDM.


### Compiladores y ensambladores

**SDCC: **Es un compilador gratuito que permite programar en C para distintos microcontroladores, entre los que están el 8052 (soporte excelente) y los PICs (soporte mediocre, con muchos bugs que pueden llevar horas perdidas). Tiene algunos tipos de optimizaciones, soporta casi todo el estándar C89.

**Keil uVision: **Es una IDE que incluye ensamblador y compilador de C para 8052, es paga, tiene un simulador interno que está interesante, soporta parte del estándar C89.

**PICC: **Es una IDE con compilador que sirve para programar microcontroladores PIC en C, tiene algunas incompatibilidades (no soporta arrays 2d), pero optimiza bastante mejor que SDCC, incluye bibliotecas para manejar LCDs, GLCDs, teclados de matriz, entre otras cosas.

**MPLAB: **Es una IDE que sirve para programar PICs en assembler y PIC18 en C (usando el compilador de HI-TEC. Es un poco confusa y demasiado compleja.

**XC8: **Compilador para PICs de gama baja/media, posee una versión gratuita que no realiza tantas optimizaciones, pero es un compilador interesante.

**WinAVR/AVR-GCC: **Compilador para microcontroladores AVRs. Es un port de GCC así que tiene un muy buen soporte de cosas, cumple mejor con los estándares que los compiladores para micros PIC.
