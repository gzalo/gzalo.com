---
title: "Mini consola de juegos con matriz de LEDs"
summary: "Consola con resolución 8x8, basada en un microcontrolador 8052 microcontroller, desarrollo en C."
thumbnail: "/thumbs/miniconsola.png"
aliases: ["/miniconsola/"]
date: "2009-01-01"
---

Como proyecto final de la materia Electrónica Digital II (2009, Prof: José Salama) había que hacer un proyecto con un microcontrolador 8052. Tenía algunas matrices de LEDs de 8x8, así que decidí hacer una mini consola de juegos. Usando el simulador Proteus pude diseñar el circuito y programarlo sin hacer ningún prototipo físico. Primero comenzé la programación en assembler, pero se fue haciendo cada vez más complejo (especialmente implementar la lógica de los juegos) así que decidí reescribirlo en C (compilando con el compilador SDCC, que es gratuito y open source).

Soporta reproducción de melodías sencillas (el circuito impreso lo hice antes, así que para escuchar las melodías es necesario cablear un parlante). Hice 4 juegos, un tetris (con piezas de un pixel), un juego de esquivar las paredes, un juego de esquivar "helicópteros", una viborita. Los juegos son estilo "retro", la matriz es de solamente 8x8 LEDs y solo un color fue implementado.

El timer0 es usado en modo 16 bits, y se encarga de refrescar el display cada 200 microsegundos. El timer1 es usado en modo 16 bits, y ejecuta la lógica de juego, se encarga de mostrar menúes y puntajes. El timer2 es usado en modo 16 bits con autorecarga, y se encarga de generar ondas cuadradas de frecuencia variable (que se convierten en melodías) y tiene prioridad para evitar glitches (discontinuidades) en el sonido. Algunos botones están conectados como fuentes de interrupciones, y son usados para realimentar el generador de números aleatorios.

[Descargar esquemático, circuito impreso y programación](/downloads/miniconsola.zip)

{{< youtube ic0n-pDeKgQ >}}

![Mini consola de juegos, circuito impreso](/images/consolalyt.png)

![Mini consola de juegos, esquematico AT89S52](/images/consolasch.png)

Lista de componentes:
* Matriz de LEDs 8x8 (modelo: LE-MM103-4)
* 74HCT164 (para manejar las columnas de los LEDs)
* 8 resistencias de 330 ohms (para las filas de los LEDs)
* Microcontrolador AT89S52 (también sirve con el AT89C52, aunque es más dificil de programar)
* Cristal de 12MHz, dos capacitores de 33 pF
* Resistencia de 1 kohm, capacitor de 10 uF (para el circuito de reset)
* 4 tact switchs (de los que tienen 4 terminales)
* 6 capacitores 100 nF (para desacople de la alimentación y antirrebote)
* Sección de alimentación: 1 capacitor 100 uF, 1 diodo 1N4007, 1 regulador de 5V (7805)
